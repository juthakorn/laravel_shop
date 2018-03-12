
<!-- form start -->

{!! Form::model($code_discount,[
    'route' => $code_discount->exists ? ['code_discount.update', $code_discount->id] : 'code_discount.store',
    'method' => $code_discount->exists ? 'PUT' : 'POST',
    'class'=>'form-horizontal'
]) !!}                   
{!! Form::hidden('id') !!}
<div class="box-body">    
    <div class="form-group">
        <label for="code" class="col-sm-2 control-label">รหัสส่วนลด</label>

        <div class="col-sm-10">
            {!! Form::text('code', null, ['class' => 'form-control','id'=>'code', 'required'=>'true', 'style'=>'width: 70%;display: inline-block;']) !!}   
            <button type="button" onclick="makecode();" class="btn btn-primary" style="margin-top: -4px">สร้างรหัส</button>
        </div>
    </div>
    <div class="form-group">
        <label for="discount" class="col-sm-2 control-label">ส่วนลด (เป็น %)</label>

        <div class="col-sm-10">
            {!! Form::number('discount', null, ['class' => 'form-control','id'=>'discount', 'required'=>'true', 'step' => '0.1']) !!}                                   
        </div>
    </div>   
    
    <div class="form-group">
        <label for="start" class="col-sm-2 control-label">วันที่เริ่ม</label>

        <div class="col-sm-10">
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                {!! Form::text('start', null, ['class' => 'form-control datepicker','id'=>'start', 'required'=>'true']) !!}      
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="end" class="col-sm-2 control-label">วันที่สิ้นสุด</label>

        <div class="col-sm-10">
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
            {!! Form::text('end', null, ['class' => 'form-control datepicker','id'=>'end', 'required'=>'true']) !!}      
            </div>
        </div>
    </div>
    <div class="form-group">                            
        <label for="active" class="col-sm-2 control-label">สถานะ</label>
        <div class="col-sm-10">
            {!! Form::hidden('status',0) !!}
            {!! Form::checkbox('status', 1,null, ['class'=>'', 'data-on-text'=>'เปิดใช้งาน','data-off-text'=>'ปิดใช้งาน']) !!} 
        </div>
    </div>
</div>
<!-- /.box-body -->
<div class="box-footer">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary btn-submit">Create New</button>
        <a href="{{ route('code_discount.create') }}" class="btn btn-default load-form">Cancel</a>
    </div>
</div>  
<!-- /.box-footer -->
{!! Form::close() !!}

