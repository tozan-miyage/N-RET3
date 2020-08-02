<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material;
use App\Group;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Material $material,Group $group)
    {
        $groups = $group->get();
       
        return view('materials.index',compact('groups'));
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
    
    public function group_create()
    {                          
        return view('materials.group_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }
    
    public function group_store(Request $request)
    {
        // 新しいグループテーブルを作成します。
        $group = new Group();
        // group_nameは、inputされてきたgroup_nameです。
        $group->group_name = $request->input('group_name');
        //保存します。
        $group->save();
        //Groups一覧へ戻る
        return redirect()->route('material.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($material)
    {  
        $materials = Material::where('group_id',$material)->groupBy('main_word')->get();
        // これだと、できない。なぜ・・・$materials = $group->materials()->groupBy('main_word')->get();
        return view('materials.show',compact('materials'));
    }

    public function show_all(Request $request,Material $material)
    {
        $main_word = $request->input('main_word');
        $materials = $material -> where('main_word',$main_word)->get();
        
        return view('materials.show_all',compact('materials','main_word'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        //
    }
    
    public function group_edit(Group $group)
    {
        return view('materials.group_edit',compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        //
    }

    public function group_update(Request $request, Group $group)
    {
        
        $group->group_name = $request->input('group_name');
        
        $group->update();
        
        return redirect()->route('material.index');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        
    }
    
    public function group_destroy(Group $group)
    {
        $group->delete();
        
        return redirect()->route('material.index');
    }
}
