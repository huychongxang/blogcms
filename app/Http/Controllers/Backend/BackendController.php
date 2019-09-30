<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BackendController extends Controller
{

    protected $limit = 3;
    protected $uploadPath;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check-permission');
    }
}
