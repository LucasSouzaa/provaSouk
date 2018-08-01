$('input[name=imageUploader]').change(function(){
    var data = new FormData();
    data.append('image', $('input[name=imageUploader]')[0].files[0]);

    $.ajax({
        url: 'http://localhost:8001/api/upload',
        '_token': $('meta[name=csrf-token]').attr('content'),
        data: data,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data)
        {
            $('img[name=imgUploaded]').attr('src', "http://localhost:8001/storage/"+data.path);
            $('input[name=image]').val("http://localhost:8001/storage/"+data.path)
        }
    });
})
