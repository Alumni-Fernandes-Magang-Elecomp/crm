<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $userModel = new \App\Models\UserModel();

        // Check if user is logged in
        if (!$session->has('username')) {
            return redirect()->to('/login');
        }

        // Check menu access if in admin area
        if (strpos($request->uri->getPath(), 'admin') !== false) {
            $menu = $userModel->getMenu();
            $currentPath = $request->uri->getSegment(2) ?? 'dashboard';

            if (!in_array($currentPath, $menu)) {
                return redirect()->to('/admin')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here if needed
    }
}
