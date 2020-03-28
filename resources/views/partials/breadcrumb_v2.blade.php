<?php if (!empty($navigator)) { ?>
    <div class="breadcrumb-container">
        <div class="container-fluid limited">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <?php
                    foreach ($navigator as $key => $value) {
                        if (isset($value['url'])) {
                            ?>
                            <li class="breadcrumb-item"><a href="{{ url($value['url']) }}">{{ $value['text'] }}</a></li>
                        <?php } else { ?>
                            <li class="breadcrumb-item active" aria-current="page">{{ $value['text'] }}</li>
                        <?php }
                    }
                    ?>
                </ol>
            </nav>
        </div>
    </div>
<?php } ?>