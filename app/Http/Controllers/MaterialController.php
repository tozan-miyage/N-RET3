<?php
namespace App\Http\Controllers;
// include composer autoload
// require 'vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Material;
use App\Group;
use Validator;
use Intervention\Image\ImageManager;
// use \InterventionImage;
use Intervention\Image\Facades\Image;



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
       
    //   $materials = Material::orderBy('created_at','DESC')->get();
        return view('materials.index',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->input('id');
        // $group = Group::find($group_id);
        
        $group = Group::find($id);
        
        // return view('materials.create',compact('group'));
        return view('materials.create',compact('group'));
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
    public function store(Request $request,Material $material)
    {
        
        // configure with favored image driver (gd by default)
        Image::configure(array('driver' => 'imagick'));

        $material = new Material();
        
        if ($request->hasFile('photo')) {
            //  Let's do everything here
            if ($request->file('photo')->isValid()) {
                //
                $validated = $request->validate([
                    'image' => 'mimes:jpeg,png',
                ]);
                
                //拡張子を返すextension（）関数
                $extension = $request->photo->extension();
                //photoを保存する名前を決める
                $name = "group-image-".time().".".$extension;
                //リサイズする。
                Image::make($request->photo)->resize(300, 200)->crop(300,200);
                //画像を/public/storage/に保存
                $request->photo->storeAs('/public', $name);
                
                //URLは$nameにする。
                $url = Storage::url($name);
                
                //photoカラムには$urlだけ保存
                $material->photo =  $url;
            }
        }
        
        $material->group_id = $request->input('group_id');
        
        $material->main_word = $request->input('main_word');
        
        $material->english = $request->input('english');
        
        $material->japanese = $request->input('japanese');
        
        // $material->photo = $request->input('photo');
        
        $material->save();
        
        // $group = Group::find($material -> group_id);
        $id = $material -> id;
        
        // return redirect()->route('material.show',$group);
        return redirect()->route('material.show_all',$material);
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
    public function show($id)
    {   
        
        $materials = Material::where('group_id',$id)->get();
        $materials = $materials->unique('main_word');

        $group = Group::find($id);
        // $materials = $group->materials()->groupBy('main_word')->get();
        return view('materials.show',compact('materials','group'));
    }

    public function show_all($id)
    {
        // $group_id = $request->input('group_id');
        $material = Material::find($id);
        
        $group_id = $material->group_id;
        // $main_word = $request->input('main_word');
        $main_word = $material -> main_word;
        
        $materials = Material::where('group_id',$group_id)->where('main_word',$main_word)->get();
        
        return view('materials.show_all',compact('materials','material'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group,Material $material)
    {
        $groups = $group->get();
        return view('materials.edit',compact('material','groups'));
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
        
        Image::configure(array('driver' => 'imagick'));
        
        if ($request->hasFile('photo')) {
            //  Let's do everything here
            if ($request->file('photo')->isValid()) {
                //
                $validated = $request->validate([
                    'image' => 'mimes:jpeg,png',
                ]);//拡張子extension
                $extension = $request->photo->extension();
                
                $name = "group-image-".time().".".$extension;
                
                Image::make($request->photo)->resize(300, 200);
                
                $request->photo->storeAs('/public', $name);
                
                $url = Storage::url($name);
                // $file = File::create([
                //   'name' => $name,
                //     'url' => $url,
                // ]);
                $material->photo =  $url;
              
               
            }
        }
        
        $material->group_id = $request->input('group_id');
        
        $material->main_word = $request->input('main_word');
        
        $material->english = $request->input('english');
        
        $material->japanese = $request->input('japanese');
        
        // $material->photo = $request->input('photo');
        
        $material->update();
        
        // $main_word = $material->main_word;
        
        // $materials = Material::where('main_word',$main_word)->get();
        
        // return redirect()->route('material_show_all',['id'=>$material->id]);
        return redirect() -> route('material.show_all',$material);
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
    public function destroy($id)
    {
        $material = Material::find($id);
        
        // $main_word = $material->main_word;
        // $materials = Material::where('main_word',$main_word)->get();
        $group_id = $material->group_id;
        $material->delete();
        
        return redirect()->route('material.show',$group_id);
        // return redirect()->route('material.index');
    }
    
    public function group_destroy(Group $group)
    {
        $group->delete();
        $group->materials()->delete();
        
        return redirect()->route('material.index');
    }
}
