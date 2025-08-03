@php
    $inputName = $inputName ?? 'image';
    $attrName = $attrName ?? 'image';
    $label = $label ?? 'Изображение';
    $required = $required ?? false;
    $dropzoneId = 'dropzone_' . $inputName;
    $image = $image ?? null;
    $fileSize = $fileSize ?? null;
@endphp

<div class="mb-3">
    <label for="{{ $dropzoneId }}">
        {{ $label }}
        @if (isset($resolution))
            <span class="text-secondary">({{ $resolution }})</span>
        @endif
        @if ($required)
            <span class="required">*</span>
        @endif
    </label>

    <div id="{{ $dropzoneId }}" class="dropzone needsclick dz-clickable" style="min-height: 250px; border-radius: 12px;">
        <div class="dz-message needsclick">
            <i data-feather="upload-cloud" class="text-muted" style="width: 3rem; height: 3rem;"></i>
            <h5>Перетащите файлы сюда или нажмите для загрузки</h5>
            <span class="text-muted font-13">(Поддерживаются изображения JPG и PNG)</span>
        </div>
    </div>

    @if ($errors->has($inputName))
        <div class="invalid-feedback d-block">
            {{ $errors->first($inputName) }}
        </div>
    @endif

    <input type="hidden" name="{{ $inputName }}" id="{{ $inputName }}_input" autocomplete="off">
</div>

@push('js')
    <script>
        // Disable Dropzone auto discover
        Dropzone.autoDiscover = false;

        // Wait for document ready
        $(document).ready(function() {
            // Initialize dropzone
            var {{ $dropzoneId }} = new Dropzone("#{{ $dropzoneId }}", {
                paramName: "{{ $inputName }}",
                url: "javascript:void(0)", // Prevent actual upload
                autoProcessQueue: false,
                createImageThumbnails: true,
                maxFiles: 1,
                maxFilesize: 5,
                acceptedFiles: ".jpeg,.jpg,.png",
                addRemoveLinks: false, // Disable default remove link
                previewTemplate: `
                    <div class="dz-preview dz-file-preview">
                        <div class="dz-image">
                            <img style="max-width: 100%; height: auto;" data-dz-thumbnail />
                        </div>
                        <div class="dz-details">
                            <div class="dz-filename"><span data-dz-name></span></div>
                            <div class="dz-size" data-dz-size></div>
                        </div>
                        <div class="dz-error-message"><span data-dz-errormessage></span></div>
                        <div class="dz-success-mark">
                            <i data-feather="check-circle"></i>
                        </div>
                        <div class="dz-error-mark">
                            <i data-feather="x-circle"></i>
                        </div>
                        <a class="dz-remove" href="javascript:void(0);" data-dz-remove>Удалить</a>
                    </div>
                `,
                dictDefaultMessage: "Перетащите файлы сюда или нажмите для загрузки",
                dictFileTooBig: "Файл слишком большой. Максимальный размер: 5MB.",
                dictInvalidFileType: "Этот тип файла не поддерживается",
                dictMaxFilesExceeded: "Нельзя загрузить больше файлов",
                init: function() {
                    var myDropzone = this;

                    this.on("addedfile", function(file) {
                        if (this.files.length > 1) {
                            this.removeFile(this.files[0]);
                        }

                        if (file instanceof File) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $('#{{ $inputName }}_input').val(e.target.result);
                            };
                            reader.readAsDataURL(file);
                        }

                        // Re-initialize feather icons for the preview template
                        if (typeof feather !== 'undefined') {
                            feather.replace();
                        }
                    });

                    this.on("removedfile", function(file) {
                        $('#{{ $inputName }}_input').val('');
                    });

                    // Show existing image if available
                    @if ($image)
                        var existingFile = {
                            name: "{{ basename($image) }}",
                            size: {{ $fileSize ?? 0 }},
                            type: 'image/jpeg',
                            status: Dropzone.ADDED,
                            accepted: true
                        };
                        myDropzone.emit("addedfile", existingFile);
                        myDropzone.emit("thumbnail", existingFile, "{{ $image }}");
                        myDropzone.emit("complete", existingFile);
                        myDropzone.files.push(existingFile);
                        $('#{{ $inputName }}_input').val("{{ $image }}");
                    @endif
                }
            });
        });
    </script>
@endpush
