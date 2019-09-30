<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // crud post
        $crudPost = new Permission();
        $crudPost->name = "crud-post";
        $crudPost->display_name = "CRUD POST";
        $crudPost->save();

        // update others post
        $updateOtherPost = new Permission();
        $updateOtherPost->name = "update-others-post";
        $updateOtherPost->display_name = "UPDATE OTHERS POST";
        $updateOtherPost->save();

        // delete others post
        $deleteOthersPost = new Permission();
        $deleteOthersPost->name = "delete-others-post";
        $deleteOthersPost->display_name = "DELETE OTHERS POST";
        $deleteOthersPost->save();

        // crud category
        $crudCategory = new Permission();
        $crudCategory->name = "crud-category";
        $crudCategory->display_name = "CRUD CATEGORY";
        $crudCategory->save();

        // crud user
        $crudUser = new Permission();
        $crudUser->name = "crud-user";
        $crudUser->display_name = "CRUD USER";
        $crudUser->save();

        // Attach permission to roles
        $admin = Role::whereName('admin')->first();
        $editor = Role::whereName('editor')->first();
        $author = Role::whereName('author')->first();

        $admin->detachPermissions([$crudPost,$updateOtherPost,$deleteOthersPost,$crudCategory,$crudUser]);
        $editor->detachPermissions([$crudPost,$updateOtherPost,$deleteOthersPost,$crudCategory]);
        $author->detachPermissions([$crudPost]);

        $admin->attachPermissions([$crudPost,$updateOtherPost,$deleteOthersPost,$crudCategory,$crudUser]);
        $editor->attachPermissions([$crudPost,$updateOtherPost,$deleteOthersPost,$crudCategory]);
        $author->attachPermissions([$crudPost]);
    }
}
