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
                                $('#example').dataTable( {
                                        "bProcessing": true,
                                        "bServerSide": true,
                                        "sAjaxSource": "scripts/server_processing_asignations.php",
                                        "iDisplayLength": 10
                                } );
                        } );
                </script>
        </head>
        <body>
        
        
        

            
        
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
        <thead>
                <tr>
                        <th width="20%">wordid</th>
                        <th width="25%">lemma</th>
                        <th width="25%">synsetid</th>
                        <th width="15%">sensekey</th>
                </tr>
        </thead>
        <tbody>
                <tr>
                        <td colspan="5" class="dataTables_empty">Loading data from server</td>
                </tr>
        </tbody>
        <tfoot>
                <tr>
                        <th>wordid</th>
                        <th>lemma</th>
			<th>synsetid</th>
                        <th>sensekey</th>
                </tr>
        </tfoot>
</table>


</html>



