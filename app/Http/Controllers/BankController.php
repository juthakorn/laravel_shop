<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Model\Bank;
class BankController extends Controller
{
    private $type_bank = [
            '' => '--- เลือกประเภทบัญชี ---',
            'ออมทรัพย์' => 'ออมทรัพย์',
            'สะสมทรัพย์' => 'สะสมทรัพย์',
            'กระแสรายวัน' => 'กระแสรายวัน',
            'ฝากประจำ' => 'ฝากประจำ',
            'เผื่อเรียก' => 'เผื่อเรียก',   
        ];
    private $bank_name = [
            '' => '--- เลือกธนาคาร ---',
            'ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร'=> 'ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร', 
            'ธนาคารกรุงศรีอยุธยา' => 'ธนาคารกรุงศรีอยุธยา',
            'ธนาคารกรุงเทพ' => 'ธนาคารกรุงเทพ',
            'ธนาคารซีไอเอ็มบี' => 'ธนาคารซีไอเอ็มบี',
            'ธนาคารออมสิน' => 'ธนาคารออมสิน',
            'ธนาคารอิสลาม' => 'ธนาคารอิสลาม',
            'ธนาคารกสิกรไทย' => 'ธนาคารกสิกรไทย',
            'ธนาคารเกียรตินาคิน' => 'ธนาคารเกียรตินาคิน',
            'ธนาคารกรุงไทย' => 'ธนาคารกรุงไทย',
            'ธนาคารไทยพาณิชย์' => 'ธนาคารไทยพาณิชย์',
            'ธนาคารธนชาติ' => 'ธนาคารธนชาติ',
            'ทิสโก้แบงค์' => 'ทิสโก้แบงค์',
            'ธนาคารทหารไทย' => 'ธนาคารทหารไทย',
            'ธนาคารยูโอบี' => 'ธนาคารยูโอบี',
            'ธนาคารไอซีบีซี' => 'ธนาคารไอซีบีซี',
        ];
    public function __construct()
    {
        $this->middleware('auth');        
    }
    public function index() {
        $banks = Bank::all(); //all
        $type_bank = $this->type_bank;
        $bank_name = $this->bank_name;
        $bank = new Bank();
        return view('bank.index', compact('banks', 'type_bank', 'bank_name', 'bank'));
    }
    
    public function create(){
        $type_bank = $this->type_bank;
        $bank_name = $this->bank_name;
        $bank = new Bank();
     	return view('bank.form',compact('type_bank','bank_name', 'bank'));
    }
    
         
    public function store(Request $request){

    	
    	//$this->validate($request, $this->rules);

    	//pr($request->all());

//        $data = $this->getRequest($request);

        Bank::create($request->all()); //save 1
//        $request->user()->contacts()->create($data);
        
        
//     	$data = [
//     		'name' => $request->input('name'),
//     		'company' => $request->input('company'),
//     		'email' => $request->input('email'),
//     	];
//     	DB::table('contacts')->insert($data); //save 2 ได้เหมือนกัน

        
        message("success","บันทึกข้อมูลเรียบร้อยแล้วค่ะ");
     	return redirect('admin/bank');
    }
    
    public function edit($id) {
        $type_bank = $this->type_bank;
        $bank_name = $this->bank_name;
        $bank = Bank::findOrFail($id);
        return view('bank.form', compact('type_bank','bank_name', 'bank'));
    }
    
    public function update(Request $request, $id)
    {    
        $request['active'] = !isset($request['active']) ? 0 : $request['active'];
//        pr($request->all());
//        pr($id);exit;
        $Bank = Bank::findOrFail($id);
        $Bank->update($request->all());
        message("success","แก้ไขข้อมูลเรียบร้อยแล้วค่ะ");
        return redirect('admin/bank');
    }
    
    public function destroy($id)
    {
        $Bank = Bank::findOrFail($id);
        $Bank->delete();
        message("success","ลบข้อมูลบัญชีธนาคารเรียบร้อยแล้วค่ะ");
        return redirect('admin/bank');
    }
}
