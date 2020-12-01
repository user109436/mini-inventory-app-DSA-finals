<?php include("../../private/config.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>ABC Industries</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="../node_modules/mdbootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../node_modules/mdbootstrap/DataTables/datatables.min.css" rel="stylesheet">
  <link href="../node_modules/mdbootstrap/css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="../node_modules/mdbootstrap/css/style.css" rel="stylesheet">

  <!-- <script type="text.javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text.javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script> -->

  <script type="text/javascript">
    function del(loc, id) {
      let x = confirm(`Delete ID: ${id}?`);
      if (x) {
        window.location = `${loc}${id}`;
      }
    }
  </script>
</head>
<?php include("navbar.php") ?>