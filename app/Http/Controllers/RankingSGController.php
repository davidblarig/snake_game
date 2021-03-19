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
        $rankingList=RankingSG::orderBy('score','DESC')->paginate(10);
        
        return view('SG/Ranking/index', ['rankingList'=>$rankingList]);
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
    public function store(Request $r)
    {
        $ranking = new RankingSG();
        $ranking->name = $r->name;
        $ranking->score = $r->score;
        $ranking->date = $r->date;
        $ranking->mode = $r->mode;
        $ranking->save();
        return redirect()->route('RankingSG.index');
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
        //
        $ranking=RankingSG::find($id);
        return view('SG/Ranking/edit', array('ranking'=>$ranking));
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
        $ranking = RankingSG::find($id);
        $ranking->name = $r->name;
        $ranking->score = $r->score;
        $ranking->date = $r->date;
        $ranking->mode = $r->mode;
        $ranking->save();
        return redirect()->route('RankingSG.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ranking = RankingSG::find($id);
        $ranking->delete();
        return redirect()->route('RankingSG.index');
    }
}
