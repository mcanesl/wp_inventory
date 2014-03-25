<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
        <head>
                <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="js/Datatables/media/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link href="css/normalize.css" rel="stylesheet" type="text/css" />
    <script src="js/Datatables/media/js/jquery.js"></script>
    <script src="js/Datatables/media/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="css/wp_inventory.css" />
                <script type="text/javascript" charset="utf-8">
                        $(document).ready(function() {
                                $('.list_items_table').dataTable( {
                                        "bProcessing": true,
                                        "bServerSide": true,
                                        "sAjaxSource": "scripts/server_processing_asignations.php",
                                        "iDisplayLength": 10
                                } );
                        } );
                </script>
        </head>
        <body>
        
<table class="list_items_table" class="display" width="100%">
        <thead>
                <tr>
                        <th>id_asignation</th>
                        <th>user</th>
                        <th>id_item</th>
                        <th>asignation_date</th>
                        <th>Operations</th>

                </tr>
        </thead>
        <tbody>
                <tr>
                        <td class="dataTables_empty">Loading data from server</td>
                </tr>
        </tbody>

</table>

</html>



