<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\AddressShop;
use DB;
class ProfileController extends Controller
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
        $data['Album']=DB::table('albums')->select('id','album_name')->get();
        $data['province'] = $this->province;
        $data['address_shop'] = AddressShop::findOrFail(1); //fix
        return view('profile.index', $data);
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
//        $request['active'] = !isset($request['active']) ? 0 : $request['active'];
//        prx($request->all());
//        pr($id);exit;
        $request['image_store_id'] = !empty($request['image_store_id']) ? $request['image_store_id'] : 0;
        $AddressShop = AddressShop::findOrFail($id);
        $AddressShop->update($request->all());
        message("success","แก้ไขข้อมูลเรียบร้อยแล้วค่ะ");
        return redirect('admin/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
