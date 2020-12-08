<?php
include_once("./../private/config.php");
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>INVETOTRACK</title>
  <!-- MDB icon -->
  <link rel="icon" href="./../node_modules/mdbootstrap/img/italicious.ico" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="node_modules/mdbootstrap/css/bootstrap.min.css">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="node_modules/mdbootstrap/css/mdb.min.css">
  <!-- Your custom styles (optional) -->
  <!-- <link rel="stylesheet" href="node_modules/mdbootstrap/css/style.css"> -->
</head>

<?php
include("navbar.php");
if (isset($_SESSION['msg'])) {
  echo $_SESSION['msg'];
  unset($_SESSION['msg']);
}
?>