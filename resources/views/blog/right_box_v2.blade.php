<div class="col-md-4">
    
    <div class="title"><span>Archives</span></div>
    <div class="list-group">
        <?php
        $list_group_blog = DB::table('blogs')->select('blog_name', 'created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, \"%Y-%m\")"))
                ->orderBy('created_at', 'desc')
                ->get();
        foreach ($list_group_blog as $key => $value) {
            echo "<a href=\"" . url(grouparticle(date("F-Y", strtotime($value->created_at)))) . "\" class=\"list-group-item list-group-item-action pl-2 border-left-0 border-right-0". ($key === 0 ? " border-top-0" : ""). "\">&raquo; " . date("F Y", strtotime($value->created_at)) . "</a></li>";
        }
        ?>
        
       
    </div>
</div>