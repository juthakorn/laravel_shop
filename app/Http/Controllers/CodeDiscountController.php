<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\CodeDiscount;

class CodeDiscountController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth');        
    }
    public function index() {
        $code_discounts = CodeDiscount::orderBy('id', 'desc')->paginate(20); 
        $code_discount = new CodeDiscount();
        return view('code_discount.index', compact('code_discounts','code_discount'));
    }
    
    public function create(){
        $code_discount = new CodeDiscount();
     	return view('code_discount.form',compact('code_discount'));
    }
    
         
    public function store(Request $request){

//    	prx($request->all());s
    	$request['start'] = Dateformate($request['start']);
        $request['end'] = Dateformate($request['end']);
        CodeDiscount::create($request->all()); //save 1
        
        message("success","บันทึกข้อมูลเรียบร้อยแล้วค่ะ");
     	return redirect('admin/code_discount');
    }
    
    public function edit($id) {
        $code_discount = CodeDiscount::findOrFail($id);
        return view('code_discount.form', compact('code_discount'));
    }
    
    public function update(Request $request, $id)
    {    
        $request['start'] = Dateformate($request['start']);
        $request['end'] = Dateformate($request['end']);
        $CodeDiscount = CodeDiscount::findOrFail($id);
        $CodeDiscount->update($request->all());
        message("success","แก้ไขข้อมูลเรียบร้อยแล้วค่ะ");
        return redirect('admin/code_discount');
    }
    
    public function destroy($id)
    {
        $CodeDiscount = CodeDiscount::findOrFail($id);
        $CodeDiscount->delete();
        message("success","ลบข้อมูลบัญชีธนาคารเรียบร้อยแล้วค่ะ");
        return redirect('admin/code_discount');
    }
}
