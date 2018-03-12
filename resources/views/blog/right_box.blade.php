<div class="col-sm-4">            
    <div class="title"><span>Archives</span></div>
    <ul class="list-group list-group-nav">
        <?php
        $list_group_blog = DB::table('blogs')->select('blog_name', 'created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, \"%Y-%m\")"))
                ->orderBy('created_at', 'desc')
                ->get();
        foreach ($list_group_blog as $key => $value) {
            echo "<li class=\"list-group-item\">» <a href=\"" . grouparticle(date("F-Y", strtotime($value->created_at))) . "\">" . date("F Y", strtotime($value->created_at)) . "</a></li>";
        }
        ?>

    </ul>
</div>