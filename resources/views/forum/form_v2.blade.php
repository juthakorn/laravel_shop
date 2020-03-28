

          
        
          
        
<div>  
    
    {!! Form::model($forum,[
    'route' => $forum->exists ? ['forum.question_update', $forum->id] : 'forum.question_create',
    'method' => $forum->exists ? 'PUT' : 'POST',
    'id'=>'form-forum', 'class'=> ''
    ]) !!}  
    <div class="form-forum">
        <div class="col-md-12">
            <div class="form-group mb-1 mb-md-3">
                <label class="mb-0 mb-md-2 required_field">{{ trans('common.subject_forum') }}</label>
                {!! Form::text('question', null, ['class' => 'form-control', 'required'=>'true']) !!} 
            </div>
            @if(Auth::guest()) 
            <div class="form-group mb-1 mb-md-3">
                <label class="mb-0 mb-md-2 required_field">{{ trans('common.Name') }}</label>
                {!! Form::text('guest_name', null, ['class' => 'form-control', 'required'=>'true']) !!} 
            </div>
            <div class="form-group mb-1 mb-md-3">
                <label class="mb-0 mb-md-2 required_field">{{ trans('common.Email address') }}</label>
                {!! Form::email('guest_email', null, ['class' => 'form-control', 'required'=>'true']) !!} 
            </div>
            @endif 
            <div class="form-group mb-1 mb-md-3">
                <label class="mb-0 mb-md-2 required_field">{{ trans('common.detail_forum') }}</label>
                {!! Form::textarea('detail', null, ['class' => 'form-control tinymce', 'rows'=>'5', 'id'=>'detail' ]) !!}  
            </div>
            <div class="text-center" style="margin: 10px">
                <button type="submit" class="btn btn-theme text-center">{{ trans('common.save') }}</button>
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
