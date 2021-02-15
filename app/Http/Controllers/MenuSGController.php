<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuSGController extends Controller
{
    public function index()
    {

        return view('menu', [
            'title' => 'Snake Game'
        ]);
    }

}