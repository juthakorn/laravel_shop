<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Image; 
use App\Model\Album;
use App\Model\ImageStore;
use DB;
class ImageController extends Controller
{
    private $upload_dir = 'public/uploads/image_store';
   
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
    public function index()
    {       
        
        $return['Album']=DB::table('albums')->select('id','album_name')->get(); 
        return view('image.index', $return);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( ! empty($id))
        {

            //echo $id;
            $txt_error = "";
            if(empty($txt_error)){
                $AddressShop = \App\Model\AddressShop::where('image_store_id',$id)->take(1)->get();            
                if(!$AddressShop->isEmpty()){
                    $txt_error = "รูปนี้มีเชื่อมกับข้อมูลร้านค้าค่ะ";
                }
            }
            if(empty($txt_error)){
                $Blog = \App\Model\Blog::where('image_store_id',$id)->take(1)->get();            
                if(!$Blog->isEmpty()){
                    $txt_error = "รูปนี้มีเชื่อมกับบทความค่ะ";
                }
            }
            if(empty($txt_error)){
                $Category = \App\Model\Category::where('image_store_id',$id)->take(1)->get();            
                if(!$Category->isEmpty()){
                    $txt_error = "รูปนี้มีเชื่อมกับข้อมูลหมวดหมู่สินค้าค่ะ";
                }
            }
            if(empty($txt_error)){
                $OrderDetail = \App\Model\OrderDetail::where('image_store_id',$id)->take(1)->get();            
                if(!$OrderDetail->isEmpty()){
                    $txt_error = "รูปนี้มีเชื่อมกับข้อมูลรายการสั่งซื้อค่ะ";
                }
            }
            if(empty($txt_error)){
                $ProductImage = \App\Model\ProductImage::where('image_store_id',$id)->take(1)->get();            
                if(!$ProductImage->isEmpty()){
                    $txt_error = "รูปนี้มีเชื่อมกับข้อมูลสินค้าค่ะ";
                }
            }
            
            if(empty($txt_error)){
                folder_delete($this->upload_dir . '/'. $id);
                ImageStore::destroy($id);
            }
            return response()->json([
                'id' => $id, 
                'status' => !empty($txt_error) ? "error" : "success",
//                'status' => 'success'
                'txt_error' => $txt_error
            ]);
        }
    }
    
    public function save_album(Request $request) {
        $this->validate($request, [
            'album_name' => 'required|unique:albums'
        ]);

        return Album::create($request->all());   
    }
    
     public function saveimg(Request $request)
    {
//         pr($request->all());
         
        if ($request->hasFile('file'))
        {
//            pr($request->file('file'));
//            pr($request->file('file')->getClientoriginalName());
            $photo       = $request->file('file');   
//            pr($photo);
            $rand = time().rand(1000, 9999);
            $new_name = $rand.".".$photo->getClientOriginalExtension();
            $new_name150 = $rand."150px.".$photo->getClientOriginalExtension();
            $new_name350 = $rand."350px.".$photo->getClientOriginalExtension();
            
            $temp = explode(".", $request->file('file')->getClientoriginalName());

            $arrImage = [
                'new_name' => $new_name,
                'new_name150' => $new_name150,
                'new_name350' => $new_name350,
                'name' => $request->file('file')->getClientoriginalName(),
                'size' => filesize_format($request->file('file')->getClientsize()),
                'album_id' => $request['album_id'],
                'alt' => str_replace(".".end($temp), "", $request->file('file')->getClientoriginalName()),
            ];
            //    
//            pr(ImageStore::all());
            $ImageStore = ImageStore::create($arrImage);     
            
            if(!is_dir($this->upload_dir.'/'.$ImageStore->id)){
                mkdir($this->upload_dir.'/'.$ImageStore->id, 0777, true);
            }
            //resize
            
            
//            $img->resize(150, 150);
//            $img->resizeCanvas(150, 150, 'center', 'fff');
            $img = Image::make($photo->getRealPath());
//            $img->resize(100, 140);
//            $img->crop(100, 140, 100, 100);
            $img->fit(100, 100);
//            $img->fit(100, 100, function ($constraint) {
//                $constraint->upsize();
//            });
//            $img->resize(null, 150, function ($constraint) {
//                $constraint->aspectRatio();
//            });
            $img->save($this->upload_dir.'/'.$ImageStore->id.'/'.$new_name150);
            
            
            
            $img2 = Image::make($photo->getRealPath());
//            $img2->resize(350, null, function ($constraint) {
//                $constraint->aspectRatio();
//            });
            //ตัวหน้า กวาง ตัวหลัง สูง
            $img2->fit(300, 300);
//            $img2->resize(300, 350, function ($constraint) {
//                $constraint->aspectRatio();
//            });
//            $img2->resizeCanvas(300,350, 'center', FALSE, 'fffff');
            $img2->save($this->upload_dir.'/'.$ImageStore->id.'/'.$new_name350);
         
            
            
            if($photo->move( $this->upload_dir.'/'.$ImageStore->id, $new_name)){
                
                
                return $ImageStore->id."/".$new_name150;
            }
            
        }
//
        
    }

    public function removeimg()
    {
//        prx($_POST['data']['filename']);
        if ( ! empty($_POST['data']['filename']))
        {
            $arr = explode("/", $_POST['data']['filename']);
            folder_delete($this->upload_dir . '/'. $arr[0]);
            ImageStore::destroy($arr[0]);
           
        }
    }
    
    public function load_album($album_id,Request $request) {
//        pr($request->all());
//       prx($album_id);

        $images=DB::table('image_stores')->where('album_id','=',$album_id)->orderBy('id', 'desc')->paginate(48);
       
        
        return view('product.load_image',['images'=>$images]);
    }

    public function load_album_image($album_id,Request $request) {
//        pr($request->all());
//       prx($album_id);

        $images=DB::table('image_stores')->where('album_id','=',$album_id)->orderBy('id', 'desc')->paginate(48);
       
        
        return view('image.load_image',['images'=>$images]);
    }

}
