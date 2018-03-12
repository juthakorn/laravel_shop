@extends('layouts.standard')

@section('content')
<div class="container m-t-3">
    <div class="row">
        <div class="col-sm-3">            
            @include("partials.category-left")
            @include("forum.bast-sell-left")            
        </div>
        <div class="col-sm-9">
            <div class="title" style="position: relative;"><span>{{ trans('common.Forum') }}</span>
                <div class="btn-add-address">
                    <a href="{{ url(UrlforumNewthread()) }}" class="btn btn-theme"><i class="fa fa-plus-circle"></i> {{ trans('common.Post New Thread') }}</a>
                </div>
            </div>

            @include("partials.alert-session")
            <div class="table-responsive">
                <table class="table table-bordered table-cart table-hover text-center">
                    <thead>
                        <tr class="color-theme text-center">
                            <th>{{ trans('common.forum_title') }}</th>
                            <th style="width: 140px">{{ trans('common.Post By') }}</th>
                            <th style="width: 110px">{{ trans('common.Reply_View') }}</th>
                            <th style="width: 140px">{{ trans('common.Last Post By') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($forums as $key => $value) {  ?>  
                        <tr>
                            <td class="forum-title">
                                <a href="{{ url(UrlforumShowthread($value->id)) }}" class="d-block"><?=$value->question;?></a>
                                <?= "<p>".DateTimeForum($value->created_at)."</p>";?>
                            </td>
                            <td>
                                <?php
                                if($value->user_id != 0){
                                    echo $value->user->isAdmin() ? "Admin" : $value->user->name;
                                }else{
                                    echo $value->guest_name. " (Guest)";
                                }
                                ?>
                            </td>
                            <td><?= $value->reply_count." / ".$value->view;?> </td>
                            <td class="post_last">
                           <?php
                           $last_reply = $value->Reply()->orderBy('reply.id', "desc")->take(1)->get();
                           
                           if($last_reply->isEmpty()){
                               if($value->user_id != 0){
                                   echo $value->user->isAdmin() ? "Admin" : $value->user->name;
                               } else {
                                   echo $value->guest_name. " (Guest)";
                               }                               
                               echo "<p>".DateTimeForum($value->created_at)."</p>";
                           }else{
                               
                               if($last_reply[0]->user_id != 0){
                                   echo $last_reply[0]->user->isAdmin() ? "Admin" : $last_reply[0]->user->name;
                               }else{
                                   echo $last_reply[0]->guest_name. " (Guest)";
                               }                               
                               echo "<p>".DateTimeForum($last_reply[0]->created_at)."</p>";
                           }
                           
                           ?>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
            
            <div class="col-xs-12 text-center">
                <nav aria-label="Page navigation">
                    {!! $forums->appends( Request::query() )->render() !!}
                </nav>
            </div>
            
            <div class="title"><span>{{ trans('common.Post New Thread') }}</span></div> 
            @include("forum.form") 
            
        </div>

    </div>
</div>

@endsection



