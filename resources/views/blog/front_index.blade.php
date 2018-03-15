@extends('layouts.standard')

@section('content')
<div class="container m-t-3">
    <div class="row">

        <!-- Content -->
        <div class="col-sm-8">
            <div class="title m-b-2"><span><?= isset($headtext) ? $headtext : trans('common.Latest Article') ?></span></div>
            <div class="row">
                <?php foreach ($blogs as $key => $blog) { ?>  
                    <div class="col-md-6">
                        <div class="thumbnail blog-list">
                            <a href="{{ url(UrlArticleShow($blog->id,$blog->blog_name))}}"><img src="<?= !empty($blog->image_logo->id) ? ImgProduct($blog->image_logo->id, $blog->image_logo->new_name) : "/image/nopicture.png" ?>" ></a>
                            <div class="caption">
                                <h4>{{ $blog->blog_name }}</h4>
                                <small>
                                    <span><i class="fa fa-clock-o"></i> 
                                        <?php echo DateTime($blog->created_at); ?></span>
                                    <span><i class="fa fa-user"></i> Admin</span>
                                    <?php if (!empty($blog->tags)) {
                                        $arr_tags = explode(',', $blog->tags);
                                        $txttag = "";
                                        foreach ($arr_tags as $key_tag => $tag) {

                                            $txttag .= !empty($tag) ? '<a href="'.Tagarticle($tag).'">'.$tag.'</a>, ' : "";
                                        }  
                                        echo '<span><i class="fa fa-tag"></i> ' . substr($txttag, 0,-2) .'</span>';
                                     } ?>
                                </small>
                                <?php
                                $string = strip_tags($blog->detail);
                                if (strlen($string) > 210) {
                                    $stringCut = substr($string, 0, 210);
                                    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
                                }
                                echo $string;
                                ?>
                                <div class="text-right"><a href="{{ url(UrlArticleShow($blog->id,$blog->blog_name))}}" class="btn btn-theme btn-sm"><i class="fa fa-long-arrow-right"></i> Read More</a></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="col-xs-12 text-center">
                    <nav aria-label="Page navigation">
                        {!! $blogs->appends( Request::query() )->render() !!}
                    </nav>
                </div>
            </div>
        </div>
        <!-- End Content -->

        <!-- Blog Sidebar -->
        @include("blog.right_box")
        <!-- End Blog Sidebar -->

    </div>
</div>
@endsection