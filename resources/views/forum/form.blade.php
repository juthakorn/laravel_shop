
 
<div class="form-horizontal">  
    
    {!! Form::model($forum,[
    'route' => $forum->exists ? ['forum.question_update', $forum->id] : 'forum.question_create',
    'method' => $forum->exists ? 'PUT' : 'POST',
    'id'=>'form-forum'
    ]) !!}  
    <div class="row form-forum">
        <div class="form-group col-sm-12">
            <label  class="col-sm-2 control-label required_field">{{ trans('common.subject_forum') }}</label>
            <div class="col-sm-10">
                {!! Form::text('question', null, ['class' => 'form-control', 'required'=>'true']) !!} 
            </div>
        </div> 
        
        @if( !Auth::guest()) 
        <div class="form-group col-sm-12">
            <label  class="col-sm-2 control-label" style="padding-top: 0;">{{ trans('common.contact_name') }}</label>
            <div class="col-sm-10">
                {{ Auth::user()->name." ".Auth::user()->lastname }} 
            </div>
        </div>
        
        @else
        <div class="form-group col-sm-12">
            <label  class="col-sm-2 control-label required_field">{{ trans('common.Name') }}</label>
            <div class="col-sm-10">
                {!! Form::text('guest_name', null, ['class' => 'form-control', 'required'=>'true']) !!} 
            </div>
        </div> 
        <div class="form-group col-sm-12">
            <label  class="col-sm-2 control-label required_field">{{ trans('common.Email address') }}</label>
            <div class="col-sm-10">
                {!! Form::email('guest_email', null, ['class' => 'form-control', 'required'=>'true']) !!} 
            </div>
        </div>    
        @endif 
        <div class="form-group col-sm-12">
            <label  class="col-sm-2 control-label required_field">{{ trans('common.detail_forum') }}</label>
            <div class="col-sm-10">
                {!! Form::textarea('detail', null, ['class' => 'form-control tinymce', 'rows'=>'5', 'id'=>'detail' ]) !!}  
                <div class="text-center" style="margin-top: 10px">
                    <button type="submit" class="btn btn-theme text-center">{{ trans('common.save') }}</button>
                </div>
            </div>
        </div>
    </div>
    
    {!! Form::close() !!}        
    <form id="uploadmedia" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
         <input name="media" type="file" id="upload" class="hidden" onchange="">
    </form>
</div>




@section('script')
<!-- tinymce -->
<script src="{{ URL::asset('plugins/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('plugins/tinymce/custom_tinymce.js') }}"></script>
<script type="text/javascript">
    $(window).load(function () {
        $('#detail_ifr').css("height", "250px");
    });
   $('#form-forum').submit(function(){
        var editorContent = tinyMCE.get('detail').getContent();
        if (editorContent == '')
        {
            alert("{{ trans('common.Please enter text here') }}");
            return false;
        }
   });
    
</script>
@endsection
