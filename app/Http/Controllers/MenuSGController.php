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
        if($thematicsList->count())
        foreach($thematicsList as $thematic){
            $bg = $thematic->background;
            $arr_bg[] = $bg;
        };

        $str_bg = implode(',', $arr_bg);

        return view('SG/menu', [
            'title' => 'Snake Game',
            'thematicsList'=>$thematicsList,
            'bg'=>$str_bg
        ]);
    }

}