@extends('layouts.standard')

@section('content')
<div class="container m-t-3">
    <div class="row">

        <!-- Content -->
        <div class="col-sm-8 blog-detail-content">
            <div class="title"><span>{{ $blog->blog_name }}</span></div>
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
            <img src="<?= !empty($blog->image_logo->id) ? ImgProduct($blog->image_logo->id, $blog->image_logo->new_name) : "/image/nopicture.png" ?>" alt="Blog Detail" class="img-thumbnail">
            <?= $blog->detail ?>
            <div class="title m-t-3"><span>Share to</span></div>
            <div class="share-button">
                <button type="button" class="btn btn-primary"><i class="fa fa-facebook"></i></button>
                <button type="button" class="btn btn-info"><i class="fa fa-twitter"></i></button>
                <button type="button" class="btn btn-danger"><i class="fa fa-google-plus"></i></button>
                <button type="button" class="btn btn-primary"><i class="fa fa-linkedin"></i></button>
                <button type="button" class="btn btn-warning"><i class="fa fa-envelope"></i></button>
            </div>
        </div>
        <!-- End Content -->

        <!-- Blog Sidebar -->
        @include("blog.right_box")
        <!-- End Blog Sidebar -->

    </div>
</div>
@endsection