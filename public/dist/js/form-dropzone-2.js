var FormDropzone = function () {


    return {
        //main function to initiate the module
        init: function () {  

            Dropzone.options.myDropzone = {
                
                maxFilesize: 2, // MB
                acceptedFiles: 'image/*',
                init: function() {
                    this.on("addedfile", function(file) {
                     
                    });
                    this.on("success", function(file,response) { 
                        file.previewElement.id = response;
                        file.previewElement.classList.add("select"); 
                        
//                        console.log(file.previewElement);
                        // Create the remove button
                        var removeButton = Dropzone.createElement("<button class='btn btn-sm btn-block'>Remove file</button>");
                        
                        
                        // Capture the Dropzone instance as closure.
                        var _this = this;

                        // Listen to the click event
                        removeButton.addEventListener("click", function(e) {
                          // Make sure the button click doesn't submit the form:
                          e.preventDefault();
                          e.stopPropagation();

                          // Remove the file preview.
                          _this.removeFile(file);
                          removeimg(response);
                          // If you want to the delete the file on the server as well,
                          // you can do the AJAX request here.
                        });

                        // Add the button to the file preview element.
                        file.previewElement.appendChild(removeButton);
                    });
                    this.on("error", function(file,response) { 
                        // Create the remove button
                        var removeButton1 = Dropzone.createElement("<button class='btn btn-sm btn-block'>Remove file</button>");
                        
                        // Capture the Dropzone instance as closure.
                        var _this = this;

                        // Listen to the click event
                        removeButton1.addEventListener("click", function(e) {
                          // Make sure the button click doesn't submit the form:
                          e.preventDefault();
                          e.stopPropagation();

                          // Remove the file preview.
                          _this.removeFile(file);
                          // If you want to the delete the file on the server as well,
                          // you can do the AJAX request here.
                        });

                        // Add the button to the file preview element.
                        file.previewElement.appendChild(removeButton1);
                    });
                }            
            }
        }
    };
}();

//fix text message
//Dropzone.prototype.defaultOptions.dictDefaultMessage = "Drop files here to upload";
//Dropzone.prototype.defaultOptions.dictFallbackMessage = "Your browser does not support drag'n'drop file uploads.";
//Dropzone.prototype.defaultOptions.dictFallbackText = "Please use the fallback form below to upload your files like in the olden days.";
//Dropzone.prototype.defaultOptions.dictFileTooBig = "File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.";
//Dropzone.prototype.defaultOptions.dictInvalidFileType = "You can't upload files of this type.";
//Dropzone.prototype.defaultOptions.dictResponseError = "Server responded with {{statusCode}} code.";
//Dropzone.prototype.defaultOptions.dictCancelUpload = "Cancel upload";
//Dropzone.prototype.defaultOptions.dictCancelUploadConfirmation = "Are you sure you want to cancel this upload?";
//Dropzone.prototype.defaultOptions.dictRemoveFile = "Remove file";
//Dropzone.prototype.defaultOptions.dictMaxFilesExceeded = "You can not upload any more files.";



function removeimg(filename){
    var data = {'filename':filename};
    
        $.ajax({
            url: ServerName + "/admin/image/removeimg",
            method: "POST",
            dataType:'json',
            data: {'data':data,'_token':$('form#my-dropzone input[name="_token"]').val() },
            success: function(response) {

            }
        });
}

