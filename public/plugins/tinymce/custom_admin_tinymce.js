var editor_config = {
    
    path_absolute: ServerName+"/",
    selector: "textarea.tinymce",
    font_formats: 'Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats',
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | fontselect | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | code",
    relative_urls: false,
     file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
//     file_picker_callback: function(callback, value, meta) {
//      if (meta.filetype == 'image') {
//        $('#upload').trigger('click');
//        $('#upload').on('change', function() {
//          var file = this.files[0];
//            var imagefile = file.type;
//            var match= ["image/jpeg","image/png","image/jpg"];
//            if(!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))){
//                alert('ต้องเป็นไฟล์รูปภาพเท่านั้น ไฟล์ที่รองรับคือ jpeg, jpg และ png');
//                 return false;
//            }
//            var form = $('#uploadmedia');
//          
//            $.ajax({
//                url: ServerName + '/forums/upload_media',
//                type: 'POST',
//                dataType: "json",
//                data: new FormData(form[0]),
//                cache: false,  
//                processData: false, // Don't process the files
//                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
//                success: function(data, textStatus, jqXHR) {
////                    console.log(data.path);
//                    callback(data.path);
//                    $('#upload').val('');
//
//                },
//                error: function(jqXHR, textStatus, errorThrown) {
//                    $('#upload').val('');
//                }
//            });
//            
//          
//          
//        });
//      }
//      
//      tinyMCE.activeEditor.windowManager.open({
//          file : cmsURL,
//          title : 'Filemanager',
//          width : x * 0.8,
//          height : y * 0.8,
//          resizable : "yes",
//          close_previous : "no"
//        });
//    },
};

tinymce.init(editor_config);