$('#btn-upload').change(function(e){
    var file = this.files[0];
    var imagefile = file.type;
    var url = $(this).attr('data-href');
    var match= ["image/jpeg","image/png","image/jpg"];
    if(!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))){
        alert('ต้องเป็นไฟล์รูปภาพเท่านั้น ไฟล์ที่รองรับคือ jpeg, jpg และ png');
         return false;
    }else{
        e.preventDefault();
        $('.overlay').show();
        console.log(new FormData($('#uploadimage')));
        var form = $('#uploadimage');
        $.ajax({
            url: url,
            type: "POST",             // Type of request to be send, called as method
            dataType: "json",
            data: new FormData(form[0]), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data){   // A function to be called if request succeeds   
                console.log(data);    
                $('#user_image').attr('src',data.path);
                $('.overlay').hide();
            }
        });
    }
});

$('#confirm-remove-btn').click(function(event) {
    event.preventDefault();
    $('#confirm-body form').submit();           
});

$('body').on('click', '.show-confirm-modal', function(event) {
    event.preventDefault();

    var me = $(this),        
        action = me.attr('href');

    $('#confirm-body form').attr('action', action);
    $('#confirm-body p').html("คุณต้องการลบที่อยู่นี้ใช่หรือไม่ ?");
    $('#confirm-modal').modal('show');
});

$('form#form-change-password').submit(function(){
    var lang = $('.selectpicker').val();
    var txt_error = "";
    if(lang === 'en'){
        txt_error = "Passwords did not match.";
    }else{
        txt_error = "กรุณากรอกให้ตรงกับรหัสผ่านใหม่";
    }
    
    var new_password = $('#new_password').val();
    var new_password_confirmation = $('#new_password_confirmation').val();
    if(new_password != "" && new_password_confirmation != ""){
        if(new_password !== new_password_confirmation){
            $main = $('#new_password_confirmation').closest('.form-group');
            $main.find('.help-block').remove();
            $main.addClass('has-error')
            .append('<span class="help-block">'+txt_error+'</span>');
            return false;
        }
    }
    
});