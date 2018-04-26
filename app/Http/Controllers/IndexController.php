<?php

namespace Updater\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/');
    }

    /**
     * Show the application README.md
     *
     * @return \Illuminate\Http\Response
     */
    public function sobre() {
        $readme = $_SERVER['DOCUMENT_ROOT'] . '/../README.md';
        
        if (file_exists($readme)) {
            $file = fopen($readme, 'r');
        }
        else {
            $file = false;
        }

        return view('sobre', ['file' => $file]);
    }

}
