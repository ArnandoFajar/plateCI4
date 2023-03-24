<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'bulan' => convertBulan(12)
        ];
        return view('welcome_message', $data);
    }
}
