<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThematicSG;

class ThematicSGController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $thematicsList=ThematicSG::all();

        return view('SG/Thematic/index', ['thematicsList'=>$thematicsList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('SG/Thematic/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {

        if($r->hasFile('background')){
            $file = $r->file('background');
            $name_bg = $file->getClientOriginalName();
            $file->move(public_path().'/images/imagesSG', $name_bg);
        }

        $thematic = new ThematicSG();
        $thematic->type = $r->type;
        $thematic->name = $r->name;
        $thematic->description = $r->description;
        $thematic->background = $name_bg;
        $thematic->snake_color = $r->snake_color;
        $thematic->save();
        return redirect()->route('ThematicSG.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thematics = ThematicSG::find($id);
        return view('SG/Thematic/edit', array('thematic'=>$thematics));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        /*$this->validate($request,['type'=>'required','name'=>'required','description'=>'required','background'=>'required','snake_color'=>'required']);

        ThematicSG::find($id)->update($request->all());
        return redirect()->route('thematic.index')->with('success','Registro actualizado satisfactoriamente');*/
        $thematic = ThematicSG::find($id);
        
        if($r->hasFile('background')){
            $file = $r->file('background');
            $name_bg = $file->getClientOriginalName();
            $file->move(public_path().'/images/imagesSG', $name_bg);
        }
        
        
        $thematic->type = $r->type;
        $thematic->name = $r->name;
        $thematic->description = $r->description;
        if ($r->hasFile('background')) {
                $thematic->background = $name_bg;
        }
        $thematic->snake_color = $r->snake_color;
        $thematic->save();
        return redirect()->route('ThematicSG.index');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*ThematicSG::find($id)->delete();
        return redirect()->route('thematic.index')->with('success','Registro eliminado satisfactoriamente');
        */
        $thematic = ThematicSG::find($id);
        $thematic->delete();
        return redirect()->route('ThematicSG.index');

    }
}
