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

            $col = $thematic->snake_color;
            $arr_col[] = $col;
        };

        $str_bg = implode(',', $arr_bg);
        $str_col = implode(',', $arr_col);

        return view('SG/GameSG/game', [
            'title' => 'Snake Game',
            'thematicsList'=>$thematicsList,
            'background'=>$str_bg,
            'snake_color'=>$str_col
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