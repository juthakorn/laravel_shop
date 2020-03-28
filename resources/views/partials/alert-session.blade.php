@if(session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif
<?php  if(session('message-custom')){ ?>
    <div id="message" class="callout callout-<?= @session()->get('message-custom')['type'] ?> alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="$('#message').hide()">×</button>
        <?= @session()->get('message-custom')['text'] ?>
    </div>

@section('script-custom2')
<script>
    $(document).ready(function(){
        setTimeout(function () {
            $('#message').fadeOut('slow');
        }, 5000);
    });
</script>
@endsection
<?php
session()->forget('message-custom');
} 
?>


@if (count($errors))
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif