
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');
import DetailsTable from "./modules/DetailsTable";

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
    }
});

if ($(".details-table").length) {
    let detailsTable = new DetailsTable();
}

let isAdvancedUpload = function() {
    let div = document.createElement("div");
    return (('draggable' in div) ||
            ('ondragstart' in div && 'ondrop' in div))
            && 'FormData' in window
            && 'FileReader' in window;
}();

$("#file-input").fileinput({
    theme: "fas",
    uploadUrl: "/upload",
    showUploadedThumbs: false,
    showPreview: false,
    showAjaxErrorDetails: true,
    elErrorContainer: ".file-upload-errors",
    maxFileCount: 1
});

$("audio").mediaelementplayer({
    alwaysShowControls: true,
    audioVolume: 'horizontal',
    audioHeight: 40,
    audioWidth: "40%"
});

$("video").mediaelementplayer({
    stretching: "fill"
});

$("#remove").click(function(){
var url = $(this).data('href');
    $.ajax(
        {
            url: url,
            type: 'DELETE',
            success: function (response)
            {
                console.log(response);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
});
