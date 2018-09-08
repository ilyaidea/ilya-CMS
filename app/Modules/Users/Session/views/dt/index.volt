<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, user-scalable=no">
    <title>Editor example - Basic initialisation</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.17/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.6/css/select.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url.path() }}assets/datatable/css/editor.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url.path() }}assets/datatable/resources/syntax/shCore.css">
    <link rel="stylesheet" type="text/css" href="{{ url.path() }}assets/datatable/resources/demo.css">
    <style type="text/css" class="init">

    </style>
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.17/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.2.6/js/dataTables.select.min.js"></script>
    <script type="text/javascript" language="javascript" src="{{ url.path() }}assets/datatable/js/dataTables.editor.min.js"></script>
    <script type="text/javascript" language="javascript" src="{{ url.path() }}assets/datatable/resources/syntax/shCore.js"></script>
    <script type="text/javascript" language="javascript" src="{{ url.path() }}assets/datatable/resources/demo.js"></script>
    <script type="text/javascript" language="javascript" src="{{ url.path() }}assets/datatable/resources/editor-demo.js"></script>
    <script type="text/javascript" language="javascript" class="init">



        var editor; // use a global for the submit and return data rendering in the examples

        $(document).ready(function() {
            editor = new $.fn.dataTable.Editor( {
                ajax: "/cms/session/dt/index",
                table: "#example",
                fields: [ {
                    label: "First name:",
                    name: "first_name"
                }, {
                    label: "Last name:",
                    name: "last_name"
                }, {
                    label: "Position:",
                    name: "position"
                }, {
                    label: "Office:",
                    name: "office"
                }, {
                    label: "Extension:",
                    name: "extn"
                }, {
                    label: "Start date:",
                    name: "start_date",
                    type: "datetime"
                }, {
                    label: "Salary:",
                    name: "salary"
                }
                ]
            } );

            $('#example').DataTable( {
                dom: "frtip",
                ajax: "/cms/session/dt/index",
                columns: [
                    { data: null, render: function ( data, type, row ) {
                            // Combine the first and last names into a single table field
                            return data.first_name+' '+data.last_name;
                        } },
                    { data: "position" },
                    { data: "office" },
                    { data: "extn" },
                    { data: "start_date" },
                    { data: "salary", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) }
                ],
                select: true
            } );
        } );



    </script>
</head>
<body class="dt-example">

{{ form() }}

    {{ form.render('first_name') }}
    {{ form.render('last_name') }}
    {{ form.render('position') }}

    {{ dump(form.getUserOptions()) }}

</form>
<div class="container">
    <section>
        <table id="example" class="display" style="width:100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Extn.</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Extn.</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
            </tfoot>
        </table>
    </section>
</div>
</body>
</html>


