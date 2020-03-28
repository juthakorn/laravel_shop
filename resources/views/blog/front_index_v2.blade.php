@extends('layouts.standard_v2')

@section('content')

<div class="container-fluid limited mb-5">
    <div class="row">
        <div class="col-md-8 mb-3">
            <div class="title"><span><?= isset($headtext) ? $headtext : trans('common.Latest Article') ?></span></div>
            <div class="row">
                <?php foreach ($blogs as $key => $blog) { ?>  
                <div class="col-lg-6 mb-4">
                    <div class="card hover-style">
                        <a href="{{ url(UrlArticleShow($blog->id,$blog->blog_name))}}" class="p-1"><img class="card-img-top"  src="<?= !empty($blog->image_logo->id) ? ImgProduct($blog->image_logo->id, $blog->image_logo->new_name) : "/image/nopicture.png" ?>" ></a>
                        <div class="card-body pb-0">
                            <div class="card-title"><a class="h5" href="{{ url(UrlArticleShow($blog->id,$blog->blog_name))}}">{{ $blog->blog_name }}</a></div>
                            <p class="card-text">
                                <?php
                                $string = strip_tags($blog->detail);
                                if (strlen($string) > 210) {
                                    $stringCut = substr($string, 0, 210);
                                    $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '...';
                                }
                                echo $string;
                                ?>
                            </p>
                            <a href="{{ url(UrlArticleShow($blog->id,$blog->blog_name))}}" class="btn btn-theme btn-sm float-right">Read more</a>
                        </div>
                        <div class="card-footer bg-transparent border-top-0 text-muted py-0">
                            <ul class="list-inline">
                                <li class="list-inline-item"><small><i class="material-icons md-1 align-text-bottom">access_time</i> <?php echo DateTime($blog->created_at); ?></small></li>
                                <li class="list-inline-item"><small><i class="material-icons md-1 align-text-bottom">person_outline</i> Admin</small></li>
                                <?php
                                    if (!empty($blog->tags)) {
                                        $arr_tags = explode(',', $blog->tags);
                                        $txttag = "";
                                        foreach ($arr_tags as $key_tag => $tag) {

                                            $txttag .= !empty($tag) ? '<a href="' . url(Tagarticle($tag)) . '">' . $tag . '</a>, ' : "";
                                        }
                                        echo '<li class="list-inline-item"><small><i class="material-icons md-1 align-text-bottom">flag</i> ' . substr($txttag, 0, -2) . '</small></li>';
                                    }
                                ?>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
            </div>
            <div class="col">
                <nav aria-label="Product Listing Page" class="d-flex justify-content-center mt-3">
                    {!! $blogs->appends( Request::query() )->render() !!}
                </nav>
            </div>
        </div>
        
        
        <!-- Blog Sidebar -->
        @include("blog.right_box_v2")
        <!-- End Blog Sidebar -->
    </div>
</div>




@endsection