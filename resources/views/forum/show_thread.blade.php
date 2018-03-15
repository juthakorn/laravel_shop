@extends('layouts.standard')

@section('content')
<div class="container m-t-3">
    <div class="row">
        <div class="col-sm-3">
            @include("partials.category-left")
            @include("forum.bast-sell-left") 
        </div>
        <div class="col-sm-9">
            @include("partials.alert-session")
            <div class="title" style="position: relative"><span>{{ $forum->question }}</span>                 
                <div class="btn-add-address">
                    <a href="{{ url(UrlforumReplythread($forum->id)) }}" class="btn btn-theme"><i class="fa fa-reply"></i> {{ trans('common.Reply Thread') }}</a>
                </div>
            </div>
              
            <div class="row row-forum">
                <div class="col-sm-2 info-post-by">
                    <img src="{{ !empty($forum->user->user_image) ? url($forum->user->user_image) : url('/shop/images/demo/user.png') }}" class="img-responsive img-forum">
                    <div class="info-post-user">
                    <?php
                    if($forum->user_id != 0){
                        echo $forum->user->isAdmin() ? "Admin" : $forum->user->name;
                    }else{
                        echo $forum->guest_name . " (Guest)";
                    }                        
                        echo "<p>".DateTimeForum($forum->created_at)."</p>";
                    ?>
                    </div>
                </div>   
                <div class="col-sm-10 detail-forum" style="padding-top: 0px;">
                    <div class="question"><i class="fa fa-fw fa-file-text"></i> {{ $forum->question }}</div>
                    <div class="forum-content"><?=$forum->detail?></div>
                    @if ($forum->modified)                   
                    <div class="after_content">	
			{{ trans('common.Last edited')." ".DateTimeForum($forum->modified) }}		
                    </div>
                    @endif
                    
                    <div class="forum-action">      
                        <a class="btn btn-info reply-quote"><i class="fa fa-reply"></i> {{ trans('common.Reply With Quote') }}</a>   
                        @if (!Auth::guest() && $forum->user_id == Auth::user()->id)
                            <a href="{{  url(UrlforumEditthread($forum->id)) }}" class="btn btn-theme"><i class="fa fa-pencil"></i> {{ trans('common.Edit') }}</a>
                        @endif
                        @if (!Auth::guest() && ($forum->user_id == Auth::user()->id || Auth::user()->isAdmin()))
                            <a href="{{ route('forum.question_remove', $forum->id) }}" class="show-confirm-modal btn btn-danger" data-title="คุณต้องการลบกระทู้นี้ ใช่หรือไม่ ?"><i class="fa fa-trash"></i> {{ trans('common.Delete') }}</a>
                        @endif    
                    </div>
                    
                </div>
                <div class="clearfix"></div>
            </div>
            
            <?php foreach ($data_reply as $key => $value) { ?>
                <div class="row row-forum">
                    <div class="col-sm-2 info-post-by">
                        <img src="{{ !empty($value->user->user_image) ? url($value->user->user_image) : url('/shop/images/demo/user.png') }}" class="img-responsive img-forum">
                        <div class="info-post-user">
                        <?php
                            if($value->user_id != 0){
                                echo $value->user->isAdmin() ? "Admin" : $value->user->name;
                            }else{
                                echo $value->guest_name. " (Guest)";
                            }                            
                            echo "<p>".DateTimeForum($value->created_at)."</p>";
                        ?>
                        </div>
                    </div>   
                    <div class="col-sm-10 detail-forum"> 
                        <div class="forum-content"><?=$value->detail?></div>                        
                        @if ($value->modified)                   
                        <div class="after_content">	
                            {{ trans('common.Last edited')." ".DateTimeForum($value->modified) }}		
                        </div>
                        @endif
                        
                        <div class="forum-action"> 
                            <a class="btn btn-info reply-quote"><i class="fa fa-reply"></i> {{ trans('common.Reply With Quote') }}</a>
                            @if(!Auth::guest() && $value->user_id == Auth::user()->id)
                                <a href="{{ url(UrlforumEditReplythread($value->id)) }}" class="btn btn-theme"><i class="fa fa-pencil"></i> {{ trans('common.Edit') }}</a>
                            @endif
                            @if(!Auth::guest() && ($value->user_id == Auth::user()->id || Auth::user()->isAdmin()))
                                <a href="{{ route('forum.reply_remove', $value->id) }}" class="show-confirm-modal btn btn-danger" data-title="คุณต้องการลบความคิดเห็นนี้ ใช่หรือไม่ ?"><i class="fa fa-trash"></i> {{ trans('common.Delete') }}</a>
                            @endif 
                        </div>
                                               
                    </div>
                    <div class="clearfix"></div>
                </div>      
            <?php } ?>
            <div class="col-xs-12 text-center">
                <nav aria-label="Page navigation">
                    {!! $data_reply->appends( Request::query() )->render() !!}
                </nav>
            </div>
            
            <div class="title"><span>{{ trans('common.Reply Thread') }}</span></div>
            @include("forum.form-reply") 
        </div>

    </div>
</div>
@include("partials.confirm-modal") 
@endsection

@section('script-custom')
<script type="text/javascript">

$('#confirm-remove-btn').click(function(event) {
    event.preventDefault();
    $('#confirm-body form').submit();           
});

$('body').on('click', '.show-confirm-modal', function(event) {
    event.preventDefault();

    var me = $(this),        
        action = me.attr('href'),
        title = me.attr('data-title');

    $('#confirm-body form').attr('action', action);
    $('#confirm-body p').html(title);
    $('#confirm-modal').modal('show');
});

$('.reply-quote').click(function(){
    let content = $(this).closest('.detail-forum').find('.forum-content').html();
//    tinymce.activeEditor.execCommand('mceInsertContent', false,  '<blockquote>'+content+'</blockquote><br />');
    tinyMCE.activeEditor.execCommand('mceInsertContent', true, '<blockquote>'+content+'</blockquote><br />');
});

</script>
@endsection

