<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.17/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.6/css/select.dataTables.min.css">
<style type="text/css" class="init">
    table {
        direction: rtl;
    }

    /* Ensure that the demo table scrolls */
    th, td { white-space: nowrap; text-align: center }
</style>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.17/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.2.6/js/dataTables.select.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            dom: "Bfrtip",
            ajax: "/cms/session/category/show",
            stateSave: true,
            columns: [
                { data: "id" },
                { data: "title" },
                { data: "lang" }
            ],
            select: true,
            buttons: [
                {
                    text: "Add",
                    action: function ( e, dt, node, config ) {
                        window.location.href = '{{ url.get('session/category/add') }}';
                        return false;
                    }
                },
                {
                    text: "Edit",
                    action: function ( e, dt, node, config ) {
                        var id = dt.row( { selected: true } ).data().id;
                        window.location.href = '{{ url.get('session/category/edit/') }}'+id;
                        return false;
                    }
                },
                {
                    text: "Delete",
                    action: function ( e, dt, node, config ) {
                        var id = dt.row( { selected: true } ).data().id;
                        window.location.href = '{{ url.get('session/category/delete/') }}'+id;
                        return false;
                    }
                }
            ]
        });
    });
</script>

{{ flash.output() }}
<table id="example">
    <thead>
        <th>Id</th>
        <th>Title</th>
        <th>Lang</th>
    </thead>
    <tbody>
    </tbody>
</table>
