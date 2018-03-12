<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Model\Category;
use App\Model\Product;
use DB;
class CategoryController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');        
    }
    public function index() {
        $categorys = Category::orderBy('position')->get();        
        return view('category.index', compact('categorys'));
    }
    
    public function create(){
        $return['Album']=DB::table('albums')->select('id','album_name')->get();
        $return['category'] = ['active'=>1];        
        $return['MainCategory'] = Category::where([['active', '=', '1'] , ['parent_id', '=', '0']])->orderBy('position')->pluck('cat_name', 'id')->prepend('--- Please Select ---','');
        
     	return view('category.create',$return);
    }
    
         
    public function store(Request $request){

    	
        
        
        $request['image_store_id'] = !empty($request['image_store_id']) ? $request['image_store_id'] : 0;
//        prx($request->all());
        Category::create($request->all()); //save 1
//        $request->user()->contacts()->create($data);
        
        
//     	$data = [
//     		'name' => $request->input('name'),
//     		'company' => $request->input('company'),
//     		'email' => $request->input('email'),
//     	];
//     	DB::table('contacts')->insert($data); //save 2 ได้เหมือนกัน

        
        message("success","บันทึกข้อมูลเรียบร้อยแล้วค่ะ");
     	return redirect('admin/category');
    }
    
    public function edit($id) {
        $return['Album']=DB::table('albums')->select('id','album_name')->get();
        $category = Category::findOrFail($id);

        $return['MainCategory'] = Category::where([['active', '=', '1'] , ['parent_id', '=', '0'], ['id', '!=' ,$id]])->orderBy('position')->pluck('cat_name', 'id')->prepend('--- Please Select ---','');
        
        $return['category'] = $category;
        return view('category.edit', $return);
    }
    
    public function update(Request $request, $id)
    {    
        $request['active'] = !isset($request['active']) ? 0 : $request['active'];
        
        
        
        $request['image_store_id'] = !empty($request['image_store_id']) ? $request['image_store_id'] : 0;
//        pr($request->parent_id);
//        prx($request->all());

        $Category = Category::findOrFail($id);
        $SubCategory = $Category->SubCategory;
        if(!empty($request->parent_id) && !$SubCategory->isEmpty()){
            message("warning","ไม่สามารถแก้ไขข้อมูลได้ เพราะมีหมวดหมู่ย่อย อยู่ในหมวดหมู่หลักนี้ !!");  
            return back()->withInput();
        }else{
            $Category->update($request->all());
            message("success","แก้ไขข้อมูลเรียบร้อยแล้วค่ะ");
            return redirect('admin/category');
        }
        
        
    }
    
    public function destroy($id)
    {

        $Category = Category::findOrFail($id);
        $SubCategory = $Category->SubCategory;
        if($SubCategory->isEmpty()){
            
            $check_product = Product::where('category_id', $id)->select('id')->take(1)->get();
            if($check_product->isEmpty()){
                $Category->delete();
                message("success","ลบข้อมูลเรียบร้อยแล้วค่ะ");
            }else{
                message("warning","ไม่สามารถลบข้อมูลได้ เพราะมีสินค้าในหมวดหมู่นี้");
            }
        }else{
            message("warning","ไม่สามารถลบข้อมูลได้ เพราะเป็นหมวดหมู่หลักของหมวดย่อย");
        }        
        
        return redirect('admin/category');
    }
    
    
    public function position(Request $request) {
        
        
        if ($request->isMethod('post')) {
            
            if ($request->ajax())
            {
//                pr($request->list);
                $i = 1;
                if(!empty($request->list)){
                    foreach ($request->list as $key => $value) {
                        
                        $Category = Category::findOrFail($value['id']);
                        $Category->update(['position' => $i, 'parent_id' => 0]);
                        if(!empty($value['children'])){
                            foreach ($value['children'] as $key1 => $value1) {
                                $i++;
                                $Category = Category::findOrFail($value1['id']);
                                $Category->update(['position' => $i, 'parent_id' => $value['id']]);
                            }
                        }
                        
                        $i++;
                    }
                }
            }
        }else{
            //retrun view
            $categorys = Category::where('parent_id', 0)->orderBy('position')->get();        
            return view('category.position', compact('categorys'));
            
        }
        
    }
    
}
