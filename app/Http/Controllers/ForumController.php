<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Forum;
use App\Model\Reply;
use DB;

class ForumController extends Controller
{
   
    public function __construct()
    {       
    }
    
    public function index(Request $request) {        
        
        $teturn['forums'] = Forum::withCount('reply')->orderBy('id', 'desc')->paginate(15);                
        $teturn['forum'] = new Forum();       
        
        //navigator
        $teturn['navigator'] = [
            ['url' => '/','text' => trans('common.home')],
            ['text' => trans('common.Forum') ],
        ];
        
        return view('forum.index_v2',$teturn);
    }
    
    public function new_thread(){
        $teturn['forum'] = new Forum();  
        //navigator
        $teturn['navigator'] = [
            ['url' => '/','text' => trans('common.home')],
            ['url' => Urlforums(),'text' => trans('common.Forum')],
            ['text' => trans('common.Post New Thread') ],
        ];        
        return view('forum.new_thread',$teturn);
    }
    
    public function edit_thread($id) {
        $teturn['forum'] = Forum::findOrFail($id);
        //ตรวจสอบสิทธิ์
        $this->authorize('modify', $teturn['forum']);
        //navigator
        $teturn['navigator'] = [
            ['url' => '/','text' => trans('common.home')],
            ['url' => Urlforums(),'text' => trans('common.Forum')],
            ['url' => UrlforumShowthread($teturn['forum']->id),'text' => $teturn['forum']->question],
            ['text' => trans('common.Edit forum') ],
        ];        
        return view('forum.edit_thread',$teturn);
    }
    public function question_create(Request $request)
    {          
        if( !Auth::guest()) {
            $this->validate($request, $this->validate_input());
            $request->user()->Forum()->create($request->all());
        }else{
            $this->validate($request, $this->validate_input_no_user());
            Forum::create($request->all());
        }
        message("success","ตั้งกระทู้ใหม่เรียบร้อยแล้วค่ะ");
        return redirect(url(Urlforums()));
    }
    
    public function question_update(Request $request, $id)
    {          
        $this->middleware('auth');
        $this->validate($request, $this->validate_input());  
        $Forum = Forum::findOrFail($id);
        //ตรวจสอบสิทธิ์
        $this->authorize('modify', $Forum);
        $request['modified'] = date('Y-m-d h:i:s');
        $Forum->update($request->all());
        
        message("success","แก้ไขกระทู้เรียบร้อยแล้วค่ะ");
        return redirect(url(UrlforumShowthread($id)));
    }
    
    public function question_remove($id) {
        if(Forum::destroy($id)){
            message("success","ลบข้อมูลเรียบร้อยแล้วค่ะ");
        }else{
            message("warning","ไม่สามารถลบข้อมูลได้");
        }    
        return redirect(url(Urlforums()));
    }
    
    function validate_input(){
        return  [
            'question' => ['required'],
            'detail' => ['required'],
        ];
    }
    function validate_input_no_user(){
        return  [
            'question' => ['guest_name'],
            'question' => ['guest_email'],
            'question' => ['required'],
            'detail' => ['required'],
        ];
    }
    public function show_thread($id){
        $teturn['forum'] = Forum::findOrFail($id);
        $teturn['forum']->update(['view' => $teturn['forum']->view + 1]);
        $teturn['data_reply'] = $teturn['forum']->Reply()->orderBy('reply.id', "asc")->paginate(15);
        $teturn['reply'] = new Reply();  
        //navigator
        $teturn['navigator'] = [
            ['url' => '/','text' => trans('common.home')],
            ['url' => Urlforums(),'text' => trans('common.Forum')],
            ['text' => $teturn['forum']->question ],
        ];        
        return view('forum.show_thread',$teturn);
    }
    
    public function reply_create($id, Request $request)
    {
        if( !Auth::guest()) {
            $this->validate($request, ['detail' => ['required']]);
            $request['forum_id'] = $id;
            $request->user()->Reply()->create($request->all());
        }else{
            $this->validate($request, ['detail' => ['required'],'guest_name'=>['required'],'guest_email'=>['required']]);
            $request['forum_id'] = $id;
            Reply::create($request->all());
        }
        
        message("success","ตอบกระทู้เรียบร้อยแล้วค่ะ");
        return redirect(url(UrlforumShowthread($id)));
    }
    
    public function reply_update(Request $request, $id)
    {          
        $this->middleware('auth');
        $this->validate($request, ['detail' => ['required']]);
        $Reply = Reply::findOrFail($id);
        //ตรวจสอบสิทธิ์
        $this->authorize('modify', $Reply);
        $request['modified'] = date('Y-m-d h:i:s');
        $Reply->update($request->all());
        
        message("success","แก้ไขความคิดเห็นเรียบร้อยแล้วค่ะ");
        return redirect(url(UrlforumShowthread($Reply->forum_id)));
    }
    
    public function reply_remove($id) {
        $Reply = Reply::findOrFail($id);
        $forum_id = $Reply->forum_id;
        if(Reply::destroy($id)){
            message("success","ลบข้อมูลเรียบร้อยแล้วค่ะ");
        }else{
            message("warning","ไม่สามารถลบข้อมูลได้");
        }    
        return redirect(url(UrlforumShowthread($forum_id)));
    }
    public function new_reply($id){
        $teturn['forum'] = Forum::findOrFail($id);
        $teturn['reply'] = new Reply();  
        //navigator
        $teturn['navigator'] = [
            ['url' => '/','text' => trans('common.home')],
            ['url' => Urlforums(),'text' => trans('common.Forum')],
            ['url' => url(UrlforumShowthread($teturn['forum']->id)),'text' => $teturn['forum']->question ],
            ['text' => trans('common.Reply Thread') ],
        ];        
        return view('forum.new_reply',$teturn);
    }
    
    public function edit_reply($id) {
        $teturn['reply'] = Reply::findOrFail($id);
        //ตรวจสอบสิทธิ์
        $this->authorize('modify', $teturn['reply']);
        $teturn['forum'] = $teturn['reply']->forum;
        //navigator
        $teturn['navigator'] = [
            ['url' => '/','text' => trans('common.home')],
            ['url' => Urlforums(),'text' => trans('common.Forum')],
            ['url' => UrlforumShowthread($teturn['forum']->id),'text' => $teturn['forum']->question],
            ['text' => trans('common.Edit comment') ],
        ];        
        return view('forum.edit_reply',$teturn);
    }
    
    public function upload_media(Request $request){        
        
        $path = base_path() . '/public/photos/public';
        $path_sub = '/photos/public';
        if ($request->hasFile('media'))
        {
            $photo = $request->file('media');  
            $rand = time().rand(1000, 9999);
            $new_name = $rand.".".$photo->getClientOriginalExtension();
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            if($photo->move( $path, $new_name)){
                echo json_encode(array('path'=> url($path_sub."/".$new_name)));
                
            }
        }
    }
    
    
    
   
}
