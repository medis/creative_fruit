Dropzone.autoDiscover = false;

$(function() {
    var uploaded_files = [];
    var baseUrl = "/fileentry";
    var token = $('.token').val();
    var myDropzone = new Dropzone("div#upload-widget", {
        url: baseUrl+"/upload",
        addRemoveLinks: true,
        params: {
            _token: token
        },
        removedfile: function(file) {
            for (var i=0; i < uploaded_files.length; i++) {
                if (uploaded_files[i].file == file) {
                    var id = uploaded_files[i].id;
                    $.ajax({
                        type: 'POST',
                        url: baseUrl + '/delete',
                        data: {id: id, _token: token},
                        dataType: 'html',
                        success: function(data){}
                    });
                }
            }
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
        success: function(file, response){
            uploaded_files.push({
                file: file,
                id: response.id
            })
        }
    });
    Dropzone.options.uploadWidget = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 10, // MB
        accept: function(file, done) {
        },
    };
})
