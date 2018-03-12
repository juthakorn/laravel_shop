
<!-- form start -->

{!! Form::model($bank,[
    'route' => $bank->exists ? ['bank.update', $bank->id] : 'bank.store',
    'method' => $bank->exists ? 'PUT' : 'POST',
    'class'=>'form-horizontal'
]) !!}                   

<div class="box-body">
    <div class="form-group">
        <label for="bank_name" class="col-sm-2 control-label">ธนาคาร</label>

        <div class="col-sm-10">
            {!! Form::select('bank_name',$bank_name, null, ['class' => 'form-control','id'=>'bank_name', 'required'=>'true']) !!}
        </div>
    </div>
    <div class="form-group">
        <label for="ac_name" class="col-sm-2 control-label">ชื่อบัญชี</label>

        <div class="col-sm-10">
            {!! Form::text('ac_name', null, ['class' => 'form-control','id'=>'ac_name', 'required'=>'true']) !!}                                   
        </div>
    </div>
    <div class="form-group">
        <label for="bank_number" class="col-sm-2 control-label">เลขบัญชี</label>

        <div class="col-sm-10">
            {!! Form::text('bank_number', null, ['class' => 'form-control','id'=>'bank_number', 'required'=>'true']) !!}                                   
        </div>
    </div>
    <div class="form-group">
        <label for="branch" class="col-sm-2 control-label">สาขา</label>

        <div class="col-sm-10">
            {!! Form::text('branch', null, ['class' => 'form-control','id'=>'branch', 'required'=>'true']) !!}      
            {!! Form::hidden('id') !!}
        </div>
    </div>
    <div class="form-group">
        <label for="bank_type" class="col-sm-2 control-label">ประเภท</label>

        <div class="col-sm-10">
            {!! Form::select('bank_type',$type_bank, null, ['class' => 'form-control','id'=>'bank_type', 'required'=>'true']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox icheck">
                <label>
                    {!! Form::checkbox('active', 1,null) !!} แสดง
                    <!--<input type="checkbox"> Remember me-->
                </label>
            </div>
        </div>
    </div>
</div>
<!-- /.box-body -->
<div class="box-footer">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary btn-submit">Create New</button>
        <a href="{{ route('bank.create') }}" class="btn btn-default load-form">Cancel</a>
    </div>
</div>  
<!-- /.box-footer -->
{!! Form::close() !!}
