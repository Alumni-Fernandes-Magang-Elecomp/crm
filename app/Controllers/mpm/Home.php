<?php

namespace App\Controllers\admin;

class Home extends BaseController
{
    public function index()
    {
        return view('user/mpm/dashboard');
    }
}
