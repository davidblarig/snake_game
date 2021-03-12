<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThematicSG;

class MenuSGController extends Controller
{

    public function index()
    {
        //
        $thematicsList=ThematicSG::all();

        return view('SG/menu', [
            'title' => 'Snake Game',
            'thematicsList'=>$thematicsList
            ]);
    }

}