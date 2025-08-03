<script>
    // Refence from Products index page scripts
    $(function() {
        const dataTable = $('#administratorsTable').DataTable({
            "language": {
                "paginate": {
                    "previous": "Назад",
                    "next": "Вперед",
                },
                "search": "",
                "infoFiltered": "",
                "emptyTable": "Пользователи не найдены",
                "zeroRecords": "Пользователи не найдены",
                "searchPlaceholder": "Поиск...",
                "lengthMenu": "Показать _MENU_",
                "infoEmpty": "0 из 0",
                "info": "_START_ - _END_ из _TOTAL_ пользователей",
                "processing": "<div class=\"spinner-border spinner-border-sm text-success\" role=\"status\">" +
                    "<span class=\"sr-only\">Loading...</span>" +
                    "</div>" +
                    "<span class=\"d-block mt-1\">Пожалуйста, подождите...</span>"
            },
            ordering: false,
            serverSide: true,
            processing: true,
            stateSave: true,
            stateSaveParams: function(settings, data) {
                data.name = $('#name').val();
                data.surname = $('#surname').val();
                data.middle_name = $('#middle_name').val();
            },
            stateLoadParams: function(settings, data) {
                $('#name').val(data.name);
                $('#surname').val(data.surname);
                $('#middle_name').val(data.middle_name);
            },
            ajax: {
                url: "{{ route('users.list') }}",
                data: function(d) {
                    d.name = $('#name').val();
                    d.surname = $('#surname').val();
                    d.middle_name = $('#middle_name').val();
                    return d;
                }
            }
        });

        dataTable.on('draw.dt', function() {
            $('[data-toggle="tooltip"]').tooltip();
        });



        $('#administratorsTable').on('draw.dt', function() {
            $('[data-toggle="tooltip"]').tooltip();
            feather.replace();
        });

        var timer = null;
        $('#name').on('input', function() {
            if (timer) clearTimeout(timer);
            timer = setTimeout(function() {
                dataTable.ajax.reload();
            }, 300);
        });
        $('#surname').on('input', function() {
            if (timer) clearTimeout(timer);
            timer = setTimeout(function() {
                dataTable.ajax.reload();
            }, 300);
        });

        $('#middle_name').on('input', function() {
            if (timer) clearTimeout(timer);
            timer = setTimeout(function() {
                dataTable.ajax.reload();
            }, 300);
        });


    });


    $('#deleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var administratorId = button.data('administrator')
        var administratorName = button.data('name')
        var modal = $(this)
        modal.find('.modal-title').text('Уволить пользователя ' + administratorName)
        let url = "{{ route('users.destroy', ':id') }}".replace(":id", administratorId)
        $('#deleteForm').attr('action', url)
    })
</script>
