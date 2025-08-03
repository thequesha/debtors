<script>
    // Refence from Products index page scripts
    $(function() {
        const dataTable = $('#rolesTable').DataTable({
            "language": {
                "paginate": {
                    "previous": "Yza",
                    "next": "Öňe",
                },
                "search": "",
                "infoFiltered": "",
                "emptyTable": "Rol tapylmady",
                "zeroRecords": "Rol tapylmady",
                "searchPlaceholder": "Gözleg...",
                "lengthMenu": " _MENU_ sany görkez",
                "infoEmpty": "0 - 0 aralygy görkezilýär, jemi 0 sany",
                "info": "_START_ - _END_ aralygy görkezilýär, jemi _TOTAL_ sany",
                "processing": "<div class=\"spinner-border spinner-border-sm text-success\" role=\"status\">" +
                    "<span class=\"sr-only\">Loading...</span>" +
                    "</div>" +
                    "<span class=\"d-block mt-1\">Ýüklenýär...</span>"
            },
            ordering: false,
            serverSide: true,
            processing: true,
            stateSave: true,
            stateSaveParams: function(settings, data) {},
            stateLoadParams: function(settings, data) {},
            ajax: {
                url: "{{ route('roles.list') }}",
                data: function(d) {
                    return d;
                }
            }
        });

        dataTable.on('draw.dt', function() {
            $('[data-toggle="tooltip"]').tooltip();
        });



        $('#rolesTable').on('draw.dt', function() {
            $('[data-toggle="tooltip"]').tooltip();
            feather.replace();
        });


    });


    $('#deleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var roleId = button.data('role')
        var roleName = button.data('name')
        var modal = $(this)
        modal.find('.modal-title').text(roleName + ' Roly  pozmakçymy?')
        let url = "{{ route('roles.destroy', ':id') }}".replace(":id", roleId)
        $('#deleteForm').attr('action', url)
    })
</script>
