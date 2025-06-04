<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Auth extends BaseConfig
{
    public $table = 'users';
    public $roleField = 'role';

    public function isAdmin()
    {
        return session()->get('role') === 'admin';
    }

    public function isLoggedIn()
    {
        return session()->get('logged_in') === true;
    }
}
