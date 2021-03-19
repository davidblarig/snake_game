<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThematicSG;

class GameSGController extends Controller
{

    public function index()
    {
        $thematicsList=ThematicSG::all();
        if($thematicsList->count())
        foreach($thematicsList as $thematic){
            $bg = $thematic->background;
            $arr_bg[] = $bg;
        };

        $str_bg = implode(',', $arr_bg);

        return view('SG/GameSG/game', [
            'title' => 'Snake Game',
            'thematicsList'=>$thematicsList,
            'background'=>$str_bg
        ]);
    }

    public function show($id)
    {
        $thematics = ThematicSG::find($id);
        $data['title'] = 'Snake Game';
        $data['background'] = $thematics->background;

        return view('SG/GameSG/game',$data);
    }

}