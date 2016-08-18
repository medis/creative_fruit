Dropzone.autoDiscover = false;
$(function() {
    var baseUrl = "/fileentry";
    var token = $('.token').val();
    var myDropzone = new Dropzone("div#dropzoneFileUpload", {
        url: baseUrl+"/upload",
        params: {
            _token: token
        }
    });
    console.log(myDropzone);
    Dropzone.options.myAwesomeDropzone = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 10, // MB
        addRemoveLinks: true,
        accept: function(file, done) {
        },
    };
})

//# sourceMappingURL=all.js.map
