if (typeof Dropzone !== 'undefined') {
    Dropzone.autoDiscover = false;
}
(function ($) {
    if (typeof Dropzone == 'undefined') {
        return false;
    }
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
                if (uploaded_files[i].name == file.name) {
                    var id = uploaded_files[i].id;
                    $.ajax({
                        type: 'POST',
                        url: baseUrl + '/delete',
                        data: {id: id, _token: token},
                        indexValue: i,
                        dataType: 'html',
                        success: function(data){
                            uploaded_files.splice(this.indexValue, 1);
                            genereateFilesList();
                        }
                    });
                }
            }
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
        success: function(file, response){
            uploaded_files.push({
                id: response.id,
                name: file.name
            });
            //$('.sortable_img li:last-of-type').data('file', file);
            genereateFilesList();
        }
    });
    Dropzone.options.uploadWidget = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 10, // MB
        accept: function(file, done) {
        },
    };

    // files variable is set from server side.
    if (uploaded_files.length == 0 && files.length) {
        for (var i=0; i < files.length; i++) {
            // Create the mock file:
            var mockFile = { name: files[i].filename, size: files[i].size };
            // Call the default addedfile event handler
            myDropzone.emit("addedfile", mockFile);
            // And optionally show the thumbnail of the file:
            //myDropzone.emit("thumbnail", mockFile, files[i].url);
            myDropzone.createThumbnailFromUrl(mockFile, files[i].url);
            // Make sure that there is no progress bar, etc...
            myDropzone.emit("complete", mockFile);

            uploaded_files.push({
                id: files[i].id,
                name: files[i].filename
            });
            genereateFilesList();
        }
    }

    $(document).ready(function() {
      $("#upload-widget").sortable({
        items:'.dz-preview',
        cursor: 'move',
        opacity: 0.5,
        containment: "parent",
        distance: 20,
        tolerance: 'pointer',
        update: function(e, ui){
          genereateFilesList();
        }
      });
    });

    function genereateFilesList() {
        var list = [];
        $('#upload-widget .dz-preview').each(function() {
            var filename = $(this).find('.dz-filename').text();
            for (var i=0; i < uploaded_files.length; i++) {
                if (uploaded_files[i].name == filename) {
                    list.push(uploaded_files[i].id);
                    break;
                }
            }
        });
        $('input[name="files"]').val(list.join());
    }
})(jQuery);

(function ($) {
  if ($('.masonry').length) {
    $('.masonry').imagesLoaded(function() {
      $('.masonry').masonry({
        itemSelector: '.grid-item',
        percentPosition: true,
        gutter: 10
      });
    });
  }
})(jQuery);

(function($) {
  if ($('.carousel').length) {
    $(document).ready(function(){
      $('.carousel').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        speed: 500,
        autoplay: true
      });
    });
  }
})(jQuery);

//# sourceMappingURL=all.js.map
