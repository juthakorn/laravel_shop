
<!-- form start -->

{!! Form::model($size,[
    'route' => $size->exists ? ['size.update', $size->id] : 'size.store',
    'method' => $size->exists ? 'PUT' : 'POST',
    'class'=>'form-horizontal'
]) !!}                   
{!! Form::hidden('id') !!}
<div class="box-body">
    
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">ชื่อรายละเอียด Size</label>
        <div class="col-sm-10">
            {!! Form::text('name', null, ['class' => 'form-control','id'=>'name', 'required'=>'true']) !!}                                   
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">รายละเอียด Size</label>
        <div class="col-sm-10">
            {!! Form::textarea('detail', null, ['class'=>'tinymce']) !!}                                  
        </div>
    </div>
    

    
</div>
<!-- /.box-body -->
<div class="box-footer">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary btn-submit">Create New</button>
        <a href="{{ route('size.create') }}" class="btn btn-default load-form">Cancel</a>
    </div>
</div>  
<!-- /.box-footer -->
{!! Form::close() !!}
