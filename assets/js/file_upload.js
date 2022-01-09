var file_name = null;

/* preview file, image,.. before upload file */
function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
    var pdf = 0, doc = 0, xls = 0;
    var p = 0, d = 0, x = 0;

    for (var k = 0; k < files.length; k++) {//Preview only file extension
        var extension = files[k]['name'].substr(files[k]['name'].length - 4, 3);
        var url = global_base_url;
        var span = document.createElement('span');
        if (extension == 'doc') {//preview file word
            span.innerHTML = ['<div class="img-wrap" id="' + file_name + "-doc-" + doc++ + '"><span  class="close" title="Delete" onclick="remove_file(' + "'" + file_name + "-doc-" + d++ + "'" + ',' + "'" + escape(files[k]['name']) + "'" + ')">&times;</span><img class="thumb" style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;" src="', url + 'images/word.png',
                '" title="', escape(files[k]['name']), '"/></div>'].join('');
        } else if (extension == 'xls') {//preview file excel
            span.innerHTML = ['<div class="img-wrap" id="' + file_name + "-xls-" + xls++ + '"><span  class="close" title="Delete" onclick="remove_file(' + "'" + file_name + "-xls-" + x++ + "'" + ',' + "'" + escape(files[k]['name']) + "'" + ')">&times;</span><img class="thumb" style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;" src="', url + 'images/excel.ico',
                '" title="', escape(files[k]['name']), '"/></div>'].join('');
        } else if (extension == '.pd') {//preview file pdf
            span.innerHTML = ['<div class="img-wrap" id="' + file_name + "-pdf-" + pdf++ + '"><span  class="close" title="Delete" onclick="remove_file(' + "'" + file_name + "-pdf-" + p++ + "'" + ',' + "'" + escape(files[k]['name']) + "'" + ')">&times;</span><img class="thumb" style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;" src="', url + 'images/pdf.png',
                '" title="', escape(files[k]['name']), '"/></div>'].join('');
        }
        document.getElementById('list_'+file_name).insertBefore(span, null);
    }

    // Loop through the FileList and render image files as thumbnails.
    var kk = 0;
    var jj = 0;
    for (var i = 0, f; f = files[i]; i++) {//Preview only Image extension
        // Only process image files.
        if (!f.type.match('image.*')) {
            continue;
        }

        var reader = new FileReader();
        // Closure to capture the file information.
        reader.onload = (function (theFile) {
            return function (e) {
                // Render thumbnail.
                var span = document.createElement('span');
                span.innerHTML = ['<div class="img-wrap" id="' + file_name + "-pic-" + kk++ + '"><span  class="close" title="Delete" onclick="remove_file(' + "'" + file_name + "-pic-" + jj++ + "'" + ',' + "'" + escape(theFile.name) + "'" + ')">&times;</span><img class="thumb" style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;" src="', e.target.result,
                    '" title="', escape(theFile.name), '"/></div>'].join('');
                document.getElementById('list_'+file_name).insertBefore(span, null);
            };
        })(f);

        // Read in the image file as a data URL.
        reader.readAsDataURL(f);
    }
}

/* append multiple input type file */
function files_input(divname, num) {
    file_name = divname;
    $('#' + divname + num).hide();
    var sum = num + 1;
    var file_id = file_name + sum;
    $('.cover_'+file_name).append('<input type="file" placeholder="Attached Name" id="' + file_id + '"' +
        'name="' + file_name + '[]" class="form-control files" onchange="files_input(' + "'" + file_name + "'" + ',' + sum + ')" autocomplete="off" multiple="multiple">');
    document.getElementById(file_id).addEventListener('change', handleFileSelect, false);
}

/* remove specifig file while upload */
var data_num = 0;
var allfilesname;
var idname = null;
var filename = null;
function remove_file(id, file) {
    idname = id;
    filename = file;
    $('#confirm_delete').modal('show');
}
$('#delete').on('click', function () {
    var num = data_num += 1;
    $('.thumb').attr('data' + num, filename);
    var allfiles = new Array();
    var no = 1;
    for (var i = 0; i < num; i++) {
        allfiles[i] = $('.thumb').attr('data' + no++);
    }

    var file_deleted = "";
    for (var ss in allfiles) {
        file_deleted += allfiles[ss] + "___";
    }

    $('#' + idname + '_deleted').val(file_deleted);
    $('#' + idname).remove();

    // reset value
    idname = null;
    filename = null;
});

/* delete existing attachment files */
function removeAttachmentFile(num, fileID, path){
    if(confirm('Do you want to delete this file?'))
    {
        $('#list_attachment_file'+num).remove();
        if(fileID != null){
            var file_removed = $('#attachment_file_deleted').val();
            file_removed += "___"+fileID;
            $('#attachment_file_deleted').val(file_removed);
        }
        if(path != null){
            var file_path = $('#attachment_file_path').val();
            file_path += "___"+path;
            $('#attachment_file_path').val(file_path);
        }
    }
}