<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Model\Product;
class FrontController extends Controller
{
    public function index()
    {
        
        $data['best_sell'] = $this->get_group_product("best_sell");
        $data['p_new'] = $this->get_group_product("p_new");
        $data['recommend'] = $this->get_group_product("recommend");
        $data['slide'] = true;
        
        return view('front.index',$data);
    }
    
    public function product_all() {
        $products = Product::where('p_active' , 1)
            ->orderBy('id', 'desc')
            ->paginate(20);
        
        return view('front.product_all',compact('products'));
    }
    
    public function product($id,$name=NULL){
        
        $product = Product::findOrFail($id);
        
        if($product->slug_url != $name ){
            
            return redirect(UrlProduct($product->id, $product->slug_url));
        }
        $teturn['relate_product'] = Product::where('category_id',$product->category_id)->inRandomOrder()->take(10)->get();
        $teturn['product'] = $product;
        
        $temp_pro = $product->toArray();
        $temp['product_attr'] = Product::findOrFail($id)->product_attr()->get();   
        $temp['product'] = [
            'name_option1' => $temp_pro['name_option1'],
            'name_option2' => $temp_pro['name_option2'],
        ];   
        
        $teturn['temp'] = json_encode($temp);
        
        
        //navigator
        $teturn['navigator'] = [
            ['url' => '/','text' => trans('common.home')],
            ['url' => UrlCategoryProduct($product->category_product->id, $product->category_product->cat_name),'text' => $product->category_product->cat_name],
            ['text' => $product->p_name ],
        ];
        
        return view('front.product_detail',$teturn);
    }
    
    public function urlp() {
        $pp = Product::all();
        foreach ($pp as $key => $value) {
             Product::where('id', $value['id'])
                    ->update(['slug_url' => create_slug($value['p_name'])]);
             pr(create_slug($value['p_name']));
        }
        
        
    }
    
    
    public function get_stock(Request $request, $id) { 
        if($request->ajax()){
            $result['product'] = Product::findOrFail($id); 
            $result['product_attr'] = Product::findOrFail($id)->product_attr()->get(); 
            
            echo json_encode($result);
        }
    }
    
}
