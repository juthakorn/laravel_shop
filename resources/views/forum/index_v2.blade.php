@extends('layouts.standard_v2')

@section('content')
<div class="container-fluid limited mb-5">
    <div class="row">


        <!-- Filter Widget -->
        <div class="col-lg-3 mb-3">
            @include("partials.category-left_v2")
        </div>
        <!-- /Filter Widget -->


        <div class="col-lg-9">
            <!--<div class="title"><span>{{ trans('cart.Payment') }}</span></div>-->    
            <div class="title" style="position: relative;"><span>{{ trans('common.Forum') }}</span>
                <div class="btn-add-address">
                    <a href="{{ url(UrlforumNewthread()) }}" class="btn btn-theme"><i class="fa fa-plus-circle"></i> {{ trans('common.Post New Thread') }}</a>
                </div>
            </div>

            @include("partials.alert-session")
            <div class="table-responsive">
                <table class="table table-bordered table-gray table-hover text-center">
                    <thead>
                        <tr class="color-theme text-center">
                            <th>{{ trans('common.forum_title') }}</th>
                            <th style="width: 149px">{{ trans('common.Post By') }}</th>
                            <th style="width: 110px;padding-right: 0;padding-left: 0" >{{ trans('common.Reply_View') }}</th>
                            <th style="width: 149px">{{ trans('common.Last Post By') }}</th>
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
                            <td style="">
                                <?php
                                if($value->user_id !== 0){
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
                               if($value->user_id !== 0){
//                                pr($value->user);
                                   echo $value->user->isAdmin() ? "Admin" : $value->user->name;
                               } else {
                                   echo $value->guest_name. " (Guest)";
                               }                               
                               echo "<p>".DateTimeForum($value->created_at)."</p>";
                           }else{

                               if($last_reply[0]->user_id !== 0){
                                $last_reply_user = $last_reply[0]->user;
                                  echo @$last_reply[0]->user->role_id === 1 ? "Admin" : @$last_reply[0]->user->name;
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
            @include("forum.form_v2") 
            
        </div>
    </div>
</div>



@endsection
