<?php

use App\Post;
use Illuminate\Support\Facades\Auth;

/**
 * Created by PhpStorm.
 * User: huy
 * Date: 23/04/2019
 * Time: 16:15
 */
function checkUserPermissions($request, $actionName = NULL, $post = NUll)
{
    // get current user
    $currentUser = Auth::user();
    // get current action name
    if ($actionName) {
        $currentActionName = $actionName;
    } else {
        $currentActionName = $request->route()->getActionName();
    }

    list($controller, $method) = explode("@", $currentActionName);
    $controller = str_replace(["App\\Http\\Controllers\\Backend\\", "Controller"], "", $controller);

    $crudPermissionsMap = [
        'crud' => ['create', 'store', 'edit', 'update', 'destroy', 'restore', 'forceDestroy', 'index', 'view'],
    ];

    $classesMap = [
        'Blog' => 'post',
        'Category' => 'category',
        'User' => 'user',
    ];

    foreach ($crudPermissionsMap as $permission => $methods) :
        // if the current method exist in methods list
        if (in_array($method, $methods) && isset($classesMap[$controller])):

            $className = $classesMap[$controller];
            $thePermission = "{$permission}-{$className}";

            // Check permission to access Post/Category/User....
            if (!$currentUser->can($thePermission)) :
                return false;
                break;
            endif;

            // Check permission delete or edit other post
            if ($className == "post" && in_array($method, ['edit', 'update', 'restore', 'destroy', 'forceDestroy'])) :
                $post = !is_null($post) ? $post : (Post::withTrashed()->find($request->route("blog")));
                if ($post && (!$currentUser->can('update-others-post') || !$currentUser->can('delete-others-post'))) :
                    if (!$currentUser->owns($post)) :
                        return false;
                    endif;
                endif;
            endif;

        endif;
    endforeach;

    return true;
}
