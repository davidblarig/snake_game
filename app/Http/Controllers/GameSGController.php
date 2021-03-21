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
            $id = $thematic->id;
            $arr_id[] = $id;

            $name = $thematic->name;
            $arr_name[] = $name;

            $bg = $thematic->background;
            $arr_bg[] = $bg;

            $col = $thematic->snake_color;
            $arr_col[] = $col;
        };

        $str_id = implode(',', $arr_id);
        $str_nm = implode(',', $arr_name);
        $str_bg = implode(',', $arr_bg);
        $str_col = implode(',', $arr_col);

        return view('SG/GameSG/game', [
            'title' => 'Snake Game',
            'thematicsList'=>$thematicsList,
            'id'=>$str_id,
            'name'=>$str_nm,
            'background'=>$str_bg,
            'snake_color'=>$str_col
        ]);
    }

    public function show($id)
    {
        $thematics = ThematicSG::find($id);
        $data['title'] = 'Snake Game';
        $data['id'] = $thematics->id;
        $data['name'] = $thematics->name;
        $data['background'] = $thematics->background;
        $data['snake_color'] = $thematics->snake_color;

        return view('SG/GameSG/game',$data);
    }

}