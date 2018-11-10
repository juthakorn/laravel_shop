<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Model\TypeProduct;
use App\Model\Product;
use App\Model\ProductImage;
use App\Model\ProductAttribute;
use App\Model\Category;
use App\Model\Size;

class ProductController extends Controller
{
    private $upload_dir = 'public/uploads';
    
    public function __construct()
    {
        $this->middleware("auth");
        $this->upload_dir = base_path() . '/' . $this->upload_dir;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['products'] = Product::where(function($query) use ($request) {
//                    $query->where('user_id', $request->user()->id);
//                    if ($group_id = ($request->get('group_id'))) {
//                        $query->where('group_id', $group_id);
//                    }

                    if (!empty($request->get("keyword")))
                    {
                        $keywords = '%' . $keyword . '%';
                        $query->orWhere("p_name", 'LIKE', $keywords);
                        $query->orWhere("p_detail", 'LIKE', $keywords);
                    }
                })
                ->with(['image_stores' => function($query){
                    $query->orderBy('product_images.position', "asc");//->first();
                }])
                ->orderBy('id', 'desc')
                ->paginate(10);
        return view('product.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $Album=DB::table('albums')->select('id','album_name')->get();
  
        $arr_cat = $this->get_category();
        
        $return['sell_status_source'] = [1=>'พร้อมส่ง',2=>'สินค้าหมด',3=>'เร็วๆนี้',4=>'เลิกจำหน่าย'];
        $return['categorys']=$arr_cat;
        $return['Album']=$Album;
        //set default value
        $return['product'] = ['p_active'=>1, 'p_new'=>1];
        $return['size'] = Size::pluck('name', 'id')->prepend('--- Please Select ---','');
        return view('product.create',$return);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
//        $request['p_active'] = !isset($request['p_active']) ? 0 : $request['p_active'];
//        $request['p_sell_status'] = !isset($request['p_sell_status']) ? 0 : $request['p_sell_status'];
//        $request['p_recommend'] = !isset($request['p_recommend']) ? 0 : $request['p_recommend'];
//        $request['p_best_sell'] = !isset($request['p_best_sell']) ? 0 : $request['p_best_sell'];
//        $request['p_new'] = !isset($request['p_new']) ? 0 : $request['p_new'];
//        pr($request->all());exit;
        
       
        
        $request['slug_url'] = create_slug($request['p_name']);
        $request['p_tags'] = ",".$request['p_tags'].",";
       
        $product = Product::create($request->all());
        $product_id = $product->id;
        if(!empty($request['product_image'])){
            $data_image = [];
            $position = 1;
            foreach ($request['product_image'] as $key => $value) {
//                $data_image[$key]['image_store_id'] = $value;
//                $data_image[$key]['product_id'] = $product_id; //array 1
                
                $data_image[] =  new ProductImage([
                    'image_store_id' => $value['image_store_id'],
                    'position' => $position,
                    'product_id' => $product_id,
                ]);
                $position++;
            }
//             DB::table('product_images')->insert($data_image);   //ใช้ save ของ array 1

            $product->product_images()->saveMany($data_image);
        }
        
        
        
        $data_attr = [];
        if(isset($request['product_attribute'])){
            
            foreach ($request['product_attribute'] as $key => $value) {
                $data_attr[] = new ProductAttribute([
                    'product_id' => $product_id,
                    'p_price' => $value['p_price'],
                    'option1' => $value['option1'],
                    'option2' => !empty($value['option2']) ? $value['option2'] : "",
                    'p_quantity' => $value['p_quantity'],                    
                ]);
            }
            
        }else{
            $data_attr[] = new ProductAttribute([
                'product_id' => $product_id,
                'p_price' => $request['p_price'],
                'p_quantity' => $request['p_quantity'], 
            ]);
        }

        $product->product_attr()->saveMany($data_attr);
        
        message("success","บันทึกข้อมูลเรียบร้อยแล้วค่ะ");
     	return redirect('admin/product/create');
        
        
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
        $Album=DB::table('albums')->select('id','album_name')->get();
        $arr_cat = $this->get_category();
        
        $return['sell_status_source'] = [1=>'พร้อมส่ง',2=>'สินค้าหมด',3=>'เร็วๆนี้',4=>'เลิกจำหน่าย'];
        $return['categorys']=$arr_cat;
        $return['Album']=$Album;
        $return['product'] = Product::findOrFail($id);
        $return['size'] = Size::pluck('name', 'id')->prepend('--- Please Select ---','');
        return view('product.edit', $return);
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
//        pr($request->all());
        $product = Product::findOrFail($id);
        
        
        
        $request['slug_url'] = create_slug($request['p_name']);
        $request['p_active'] = !isset($request['p_active']) ? 0 : $request['p_active'];
        $request['p_recommend'] = !isset($request['p_recommend']) ? 0 : $request['p_recommend'];
        $request['p_best_sell'] = !isset($request['p_best_sell']) ? 0 : $request['p_best_sell'];
        $request['p_new'] = !isset($request['p_new']) ? 0 : $request['p_new'];
        $request['p_tags'] = ",".$request['p_tags'].",";
        
        
        
       
        $product->update($request->all());
        
        
        //-------------------- manger image ----------------- start
        if(!empty($request['product_image'])){
            
            $id_img_old = [];
            foreach ($product->image_stores()->get() as $key => $value_img) {
                $id_img_old[] = $value_img->pivot->id;
            }
            $id_img = [];
            foreach ($request['product_image'] as $key => $value) {
                if(!empty($value['id'])){
                    $id_img[] = $value['id'];
                }
            }
            
            $arr_del_img = array_merge(array_diff($id_img_old, $id_img), array_diff($id_img, $id_img_old));
            DB::table('product_images')->whereIn('id', $arr_del_img)->delete();

            $data_image = [];
            $position = 1;
            foreach ($request['product_image'] as $key => $value) {
//                $data_image[$key]['image_store_id'] = $value;
//                $data_image[$key]['product_id'] = $value['product_id']; //array 1
                if(empty($value['id'])){
                    $data_image[] =  new ProductImage([
                        'image_store_id' => $value['image_store_id'],
                        'position' => $position,
                        'product_id' => $value['product_id'],                        
                    ]);
                    
                }else{
                    ProductImage::where('id', $value['id'])
                    ->update(['position' => $position]);
                }
                $position++;
            }
            if(!empty($data_image)){
                $product->product_images()->saveMany($data_image);
            }
//             DB::table('product_images')->insert($data_image);   //ใช้ save ของ array 1
            
        }else{
            $product->image_stores()->delete();
//            DB::table('product_images')->whereIn('id', $arr_del_img)->delete();
        }
         //-------------------- manger image ----------------- End
        
        
        
        
        
         //-------------------- manger product_attribute ----------------- start
        $data_attr = [];
        $id_attr_old = [];
        foreach ($product->product_attr as $key => $value_attr) {
            $id_attr_old[] = $value_attr->id;
        }
        $arr_del_attr = $id_attr_old;
        
        if(isset($request['product_attribute'])){  
            $id_attr = [];
            foreach ($request['product_attribute'] as $key => $value) {
                if(!empty($value['id'])){
                    $id_attr[] = $value['id'];
                }
            }
            
            $arr_del_attr = array_merge(array_diff($id_attr_old, $id_attr), array_diff($id_attr, $id_attr_old));
            
            foreach ($request['product_attribute'] as $key => $value) {
                if(empty($value['id'])){
                    $data_attr[] = new ProductAttribute([
                        'product_id' => $value['product_id'],
                        'p_price' => $value['p_price'],
                        'option1' => $value['option1'],
                        'option2' => !empty($value['option2']) ? $value['option2'] : "",
                        'p_quantity' => $value['p_quantity'],                    
                    ]);
                }else{
                    DB::table('product_attributes')->where('id', $value['id'])->update([
                        'p_price' => $value['p_price'],
                        'option1' => $value['option1'],
                        'option2' => !empty($value['option2']) ? $value['option2'] : "",
                        'p_quantity' => $value['p_quantity'],
                        ]);
                    
                }
            }
            
        }else{
            $data_attr[] = new ProductAttribute([
                'product_id' => $id,
                'p_price' => $request['p_price'],
                'p_quantity' => $request['p_quantity'], 
            ]);
        }    
        
        if(!empty($arr_del_attr)){
            DB::table('product_attributes')->whereIn('id', $arr_del_attr)->delete();
        }
        
        if(!empty($data_attr)){
            $product->product_attr()->saveMany($data_attr);
        }
        //-------------------- manger product_attribute ----------------- start
        
        
        
        message("success","บันทึกข้อมูลเรียบร้อยแล้วค่ะ");
     	return redirect('admin/product');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo 'ยังไม่ทำ';   
        
    
    }
    
    function get_category() {
        $categorys = Category::where('parent_id', 0)->orderBy('position')->get(); 
        $arr_cat = [];
        $arr_cat[] = "--- Please Select ---";
        foreach ($categorys as $key => $value) {
            $arr_cat[$value['id']] = $value['cat_name'];
            $subcat = $value->SubCategory;
            if(!$subcat->isEmpty()){
                foreach ($subcat as $keysub => $valuesub) {
                    $arr_cat[$valuesub['id']] = "--- ".$valuesub['cat_name'];
                }
                
            }
        }
        return $arr_cat;
    }
    
}
