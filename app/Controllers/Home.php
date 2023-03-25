<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (session('magicLogin')) {
            return redirect()->route('customer');
        }

        $data = [
            'bulan' => convertBulan(12)
        ];
        return view('welcome_message', $data);
    }
}
