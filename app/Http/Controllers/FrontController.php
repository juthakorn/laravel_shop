<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Model\Product;
use App\Model\Category;
class FrontController extends Controller
{
    public function index()
    {
        
        $data['best_sell'] = $this->get_group_product("best_sell");
        $data['p_new'] = $this->get_group_product("p_new");
        $data['recommend'] = $this->get_group_product("recommend");
        $data['slide'] = true;
        
        
//        $category = Category::where([['active', '=', '1'] , ['parent_id', '=', '0']])->select('id', 'cat_name')->with('SubCategory')->orderBy('position', 'asc')->get();
    
//        $return = Product::where('p_best_sell',1)->inRandomOrder()->take(5)->get();
        return view('front.index_v2',$data);
    }
    
    public function product_all() {
        
//        \DB::enableQueryLog();
        $products = Product::where('p_active' , 1)
                ->with(['image_stores' => function($query){
                    $query->orderBy('product_images.position', "asc");//->first();
                }])
            ->orderBy('id', 'desc')
            ->paginate(20);
//        pr(\DB::getQueryLog());
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
        
        return view('front.product_detail_v2',$teturn);
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
