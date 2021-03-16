<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RankingSG;

class RankingSGController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rankings=RankingSG::orderBy('score','DESC')->paginate(10);
        //$rankings=RankingSG::all();
        return view('SG/Ranking/index', ['rankings'=>$rankings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('SG/Ranking/create');
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
        $this->validate($request,['score'=>'required','date'=>'required','mode'=>'required']);
        RankingSG::create($request->all());
        return redirect()->route('ranking.index')->with('success','Registro creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rankings=RankingSG::find($id);
        return view('ranking.show',compact('rankings'));
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
        $ranking=RankingSG::find($id);
        return view('SG/Ranking/edit',compact('ranking'));
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
        $this->validate($request,['score'=>'required','date'=>'required','mode'=>'required']);

        RankingSG::find($id)->update($request->all());
        return redirect()->route('ranking.index')->with('success','Registro actualizado satisfactoriamente');
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
        RankingSG::find($id)->delete();
        return redirect()->route('RankingSG.index')->with('success','Registro eliminado satisfactoriamente');
    }
}
