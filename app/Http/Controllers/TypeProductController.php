<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\TypeProduct;
use App\Model\Category;
use DB;
class TypeProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
//        $type_products = DB::table('type_products')
//            ->select('type_products.*','type_products_chai.id as ddd')
//            ->leftJoin('type_products as type_products_chai', 'type_products.id', '=', 'type_products_chai.parent_id')
//            //->where('contacts.user_id', $userId)
//           // ->groupBy('contacts.group_id')
//            ->get();
//        pr($type_products);
//        prx(\DB::getQueryLog());
        
//        $TypeProduct = TypeProduct::where('active','=', 1)->TypeProductchild()->get();
        
        
//        $TypeProduct = TypeProduct::all();
//        foreach ($TypeProduct as $key => $value) {
//            $rr = $value->TypeProductchild;            
//        }
        $type_products = TypeProduct::orderBy('position')->get();

        return view('type_product.index',compact('type_products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $return['Album']=DB::table('albums')->select('id','album_name')->get();
        $return['type_product'] = ['active'=>1];
        $return['categorys'] = Category::where('active', 1)->orderBy('position')->pluck('cat_name', 'id')->prepend('--- Please Select ---','');
        return view('type_product.create',$return);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        
        $request['image_store_id'] = !empty($request['image_store_id']) ? $request['image_store_id'] : 0;
         TypeProduct::create($request->all());
         message("success","บันทึกข้อมูลเรียบร้อยแล้วค่ะ");
     	return redirect('admin/type_product/create');
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
        $return['categorys'] = Category::where('active', 1)->orderBy('position')->pluck('cat_name', 'id')->prepend('--- Please Select ---','');
      
        $type_product = TypeProduct::findOrFail($id);
        
        
        $return['type_product'] = $type_product;
        $return['Album']=DB::table('albums')->select('id','album_name')->get();
        return view('type_product.edit', $return);
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
        
        $request['active'] = !isset($request['active']) ? 0 : $request['active'];
        $request['image_store_id'] = !empty($request['image_store_id']) ? $request['image_store_id'] : 0;
        //prx($request->all());
//        pr($id);exit;
        $type_product = TypeProduct::findOrFail($id);
        $type_product->update($request->all());
        message("success","แก้ไขข้อมูลเรียบร้อยแล้วค่ะ");
        return redirect('admin/type_product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $check_product = DB::table('products')->where('type_product_id', $id)->select('id')->take(1)->get();
        
        
        $TypeProduct = TypeProduct::findOrFail($id);
                   
        if($check_product->isEmpty()){    
            $TypeProduct->delete();
            message("success","ลบข้อมูลเรียบร้อยแล้วค่ะ");
        }else{
            message("warning","ไม่สามารถลบข้อมูลได้ เพราะมีสินค้าในประเภท ".$TypeProduct['type_name']." อยู่");
        }        
        
        return redirect('admin/type_product');
    }
    
    
    public function position(Request $request) {
        if ($request->ajax())
        {
//            pr($request['data']);
//            pr($request->all());
            $positions = explode(",", $request['data']);
//            pr($positions);
            if(!empty($positions)){
                foreach ($positions as $key => $value) {
                    $type_product = TypeProduct::findOrFail($value);
                    
                    $type_product->update(['position' => $key+1]);
                }
            }
            
            
            
        }
    }
}
