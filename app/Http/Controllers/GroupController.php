<?php

namespace App\Http\Controllers;

use App\Group;
use App\Material;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Group $group)
    {
        $groups = $group->get();
        return view('group.index',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Group $group)
    {
        // $materials = $group->materials()->groupBy('main_word')->get();
        $materials = $group->materials()->get();
        return view('group.play',compact('materials'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
    }
    
    public function list(Request $request)
    {
        //リクエストのidと同じデータをMaterialモデルから取得
        $material = Material::find($request->material_id);
        //main_wordを格納
        $main_word = $material->main_word;
        //main_wordが同じレコードを取得して格納
        $materials = Material::where('main_word',$main_word)->get();
        // json形式で返す※dataobjectに格納される
        return response()->json($materials);
        
        //500エラー
        // return response()->json($request->inputs());
    }
}
