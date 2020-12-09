<!-- SCRIPTS -->

<script type="text/javascript" src="../node_modules/mdbootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="../node_modules/mdbootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../node_modules/mdbootstrap/js/mdb.min.js"></script>
<script type="text/javascript" src="../node_modules/mdbootstrap/DataTables/datatables.min.js"></script>
<script type="text/javascript" src="../node_modules/mdbootstrap/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="../node_modules/mdbootstrap/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="../node_modules/mdbootstrap/js/jszip.min.js"></script>
<script type="text/javascript" src="../node_modules/mdbootstrap/js/pdfmake.min.js"></script>
<script type="text/javascript" src="../node_modules/mdbootstrap/js/vfs_fonts.js"></script>
<script type="text/javascript" src="../node_modules/mdbootstrap/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="../node_modules/mdbootstrap/js/buttons.print.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        console.log("Start");
        var table = $('#dtMaterialDesignExample').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
        $('.dt-button').addClass("btn btn-elegant waves-effect btn-sm"); // add styling
        const btnContainer = document.querySelectorAll('.dt-button'); //copy parent
        $('.dt-buttons').detach(); //remove  parent
        $('.actions').append(btnContainer);
        console.log("Success");
    });
</script>



</html>
<?php
ob_end_flush();
?>