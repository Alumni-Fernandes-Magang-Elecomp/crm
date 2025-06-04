<?php

namespace App\Controllers\user;

use App\Controllers\user\BaseController;
use App\Models\DataBuyersModel;
use App\Models\UserModel;


class DataBuyersctrl extends BaseController
{

    private $DataBuyersModel;
    private $UserModel;
    


    public function __construct()
    {
        $this->DataBuyersModel = new DataBuyersModel();
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        // Your code to retrieve data goes here
            if (!session()->get('logged_in')) {
                return redirect()->to(base_url('login')); 
                // Ubah 'login' sesuai dengan halaman login Anda
        }
        
        $data = [
            'data_buyers' => $this->DataBuyersModel->getDataBuyers(),
            'menu' => $this->UserModel->getMenu(),
        ];

    
        return view('user/data_buyers/index', $data);
    }
    
    

}
