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
        $thematics=ThematicSG::all();

        return view('Thematic.index', ['thematics'=>$thematics]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Thematic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,['type'=>'required','name'=>'required','description'=>'required','background'=>'required','snake_color'=>'required']);
        ThematicSG::create($request->all());
        return redirect()->route('thematic.index')->with('success','Registro creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $thematics=ThematicSG::find($id);
        return view('Thematic.show',compact('thematics'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $thematic=ThematicSG::find($id);
        return view('thematic.edit',compact('thematic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,['type'=>'required','name'=>'required','description'=>'required','background'=>'required','snake_color'=>'required']);

        ThematicSG::find($id)->update($request->all());
        return redirect()->route('thematic.index')->with('success','Registro actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        ThematicSG::find($id)->delete();
        return redirect()->route('thematic.index')->with('success','Registro eliminado satisfactoriamente');
    }
}
