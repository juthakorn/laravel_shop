<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Model\Blog;
use DB;
class BlogController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $teturn['blogs'] = Blog::where(function($query) use ($request) {
                    if (!empty($request->get("keyword")))
                    {
                        $keywords = '%' . $keyword . '%';
                        $query->orWhere("blog_name", 'LIKE', $keywords);
                        $query->orWhere("detail", 'LIKE', $keywords);
                    }
                })
                ->orderBy('id', 'desc')
                ->paginate(10);
                     
        return view('blog.index', $teturn);
        
    }

    public function front_index()
    {
        //navigator
        $teturn['navigator'] = [
            ['url' => '/','text' => trans('common.home')],
            ['text' => trans('common.Article') ],
        ];
        $teturn['blogs'] = Blog::orderBy('id', 'desc')->with('image_logo')
                ->paginate(6);
        return view('blog.front_index_v2',$teturn);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $return['Album']=DB::table('albums')->select('id','album_name')->get();
        $return['blog'] = ['active'=>1];        
     	return view('blog.create',$return);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['tags'] = ",".$request['tags'].",";
        $request['image_store_id'] = !empty($request['image_store_id']) ? $request['image_store_id'] : 0;
        $request['slug_url'] = create_slug($request['blog_name']);
//        prx($request->all());
        Blog::create($request->all()); 
        message("success","บันทึกข้อมูลเรียบร้อยแล้วค่ะ");
     	return redirect('admin/blog');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$slug)
    {
        $blog = Blog::findOrFail($id);
        if($blog->slug_url != $slug ){            
            return redirect(UrlArticleShow($blog->id, $blog->slug_url));
        }
        $teturn['blog'] = $blog;
        //navigator
        $teturn['navigator'] = [
            ['url' => '/','text' => trans('common.home')],
            ['url' => UrlArticle(),'text' => trans('common.Article') ],
            ['text' =>$blog->blog_name ],
        ];
        return view('blog.show_v2',$teturn);
    }
    
    public function show_tag($tag)
    {
        //navigator
        $teturn['navigator'] = [
            ['url' => '/','text' => trans('common.home')],
            ['text' => trans('common.Article') ],
        ];
        $teturn['headtext'] = trans('common.Tags')." : ".$tag;
        $teturn['blogs'] = Blog::where("tags", 'LIKE', '%,'.$tag.',%')->orderBy('id', 'desc')
                ->paginate(6);
        return view('blog.front_index_v2',$teturn);
    }
    
    public function show_date($date)
    {
        //navigator
        $teturn['navigator'] = [
            ['url' => '/','text' => trans('common.home')],
            ['text' => trans('common.Article') ],
        ];
        $teturn['headtext'] = "Archives : ".date("F Y", strtotime($date));
        $teturn['blogs'] = Blog::where("created_at", 'LIKE', date("Y-m", strtotime($date)).'%')->orderBy('id', 'desc')
                ->paginate(6);
        return view('blog.front_index_v2',$teturn);
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $return['Album']=DB::table('albums')->select('id','album_name')->get();
        $return['blog'] = Blog::findOrFail($id);
        return view('blog.edit', $return);
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
        $request['tags'] = ",".$request['tags'].","; 
        $request['image_store_id'] = !empty($request['image_store_id']) ? $request['image_store_id'] : 0;
        $request['slug_url'] = create_slug($request['blog_name']);
        $Category = Blog::findOrFail($id);
        $Category->update($request->all());
        message("success","แก้ไขข้อมูลเรียบร้อยแล้วค่ะ");
        return redirect('admin/blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Blog = Blog::findOrFail($id)->delete();
        message("success","ลบข้อมูลเรียบร้อยแล้วค่ะ");
        return redirect('admin/blog');
    }
}
