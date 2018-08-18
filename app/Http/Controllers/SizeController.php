<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Model\Size;
class SizeController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');        
    }
    
    public function index() {
        $sizes = Size::all(); //all
        $size = new Size();
        return view('size.index', compact('sizes', 'size'));
    }
    
    public function create(){       
        $size = new Size();
     	return view('size.form',compact('size'));
    }
    
         
    public function store(Request $request){    	
        Size::create($request->all()); //save 1
        message("success","บันทึกข้อมูลเรียบร้อยแล้วค่ะ");
     	return redirect('admin/size');
    }
    
    public function edit($id) {
        $size = Size::findOrFail($id);
        return view('size.form', compact('size'));
    }
    
    public function update(Request $request, $id)
    {    
        
        $size = Size::findOrFail($id);
        $size->update($request->all());
        message("success","แก้ไขข้อมูลเรียบร้อยแล้วค่ะ");
        return redirect('admin/size');
    }
    
    public function destroy($id)
    {
        $size = Size::findOrFail($id);
        $product = \App\Model\Product::where('size_id',$id)->select('id')->take(1)->get();            
        if(!$product->isEmpty()){
             message("warning","รายละเอียดสินค้านี้ มีการเชื่อมกับสินค้าค่ะ");
        } else {
            $size->delete();
            message("success","ลบข้อมูลรายละเอียดสินค้าเรียบร้อยแล้วค่ะ");
        }

        return redirect('admin/size');
        
        
    }
}
