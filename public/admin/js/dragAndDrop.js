$.fn.extend({
    dragAndDrop: function (config) {

        let uploadUrl = config.url;
        let deleteUrl = config.deleteUrl;

        var fileIndex = 0;

        // let $elem = $(this);
        let $elem = $('#image-container');
        let $form = $(this).find('#draggable');
        let $multipleChoose = $('#multiple-choose');
        let clone = $('#clone-dropped-image-container').clone(true);

        clone.removeClass('d-none');

        $(this).find('#draggable').click(function () {
            $multipleChoose.click();
        });

        $multipleChoose.change(function () {
            let files = $(this)[0].files;

            uploadFiles($elem, files, uploadUrl)
        });

        $form.on('drag dragstart dragend dragover dragenter dragleave drop', function (e) {
            e.preventDefault();
            e.stopPropagation();
        })
            .on('dragover dragenter', function () {
                $form.addClass('is-dragover');
            })
            .on('dragleave dragend drop', function () {
                $form.removeClass('is-dragover');
            })
            .on('drop', function (e) {
                let droppedFiles = e.originalEvent.dataTransfer.files;
                console.log(droppedFiles);

                uploadFiles($elem, droppedFiles, uploadUrl)
            });

        function uploadFiles($element, files, uploadUrl) {
            $.each(files, function (i, file) {

                clone.attr('id', 'file' + fileIndex);

                $element.append(clone.clone(true));

                feather.replace();

                let $fileProgressDiv = $('#file' + fileIndex);

                var req;

                $fileProgressDiv.on('click', function () {
                    let imageId = $(this).data('image-id');

                    console.log(deleteUrl.replace(":image-id", imageId));

                    if (imageId) {
                        if (!confirm('Siz hakykatdan hem suraty pozmakçymy?')) {
                            return;
                        }

                        $.ajax({
                            url: deleteUrl.replace(":image-id", imageId),
                            type: "DELETE",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: () => {
                                $fileProgressDiv.remove();
                            },
                            error: () => {
                                alert('something went wrong')
                            }
                        });
                        return;
                    }

                    req.abort();

                    $fileProgressDiv.remove();
                });

                let formData = new FormData();
                formData.append('image', file);

                console.log($('meta[name="csrf-token"]').attr('content'));

                req = $.ajax({
                    url: uploadUrl,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        console.log(data);

                        $fileProgressDiv.find('img').attr('src', data.url);
                        $fileProgressDiv.find('input[form=reorder]').val(data.id);
                        $fileProgressDiv.attr('data-image-id', data.id);
                    },
                    error: function () {
                        $fileProgressDiv.addClass('upload-error');
                    },
                    xhr: function () {
                        let xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function (evt) {
                            if (evt.lengthComputable) {
                                let percentComplete = Math.trunc((evt.loaded / evt.total) * 100);
                                //Do something with upload progress here
                                console.log(file.name + " -- " + percentComplete);
                                $fileProgressDiv.children('.percentage').html(percentComplete + "%");
                                $fileProgressDiv.find('.progress-bar').css('width', percentComplete + '%');
                            }
                        }, false);
                        return xhr;
                    },
                });

                fileIndex += 1;
            })
        }
    }
});
