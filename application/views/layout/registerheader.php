<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SISPAS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=asset_url("bootstrap/css/bootstrap.min.css")?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=asset_url("dist/css/AdminLTE.min.css")?>">
  <!--  Select2 -->
  <link rel="stylesheet" href="<?=asset_url("plugins/select2/select2.min.css")?>">

  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>

  <!-- FastClick -->
  <script src="<?php echo base_url();?>assets/plugins/select2/select2.full.min.js"></script>
  <!-- Page script -->
  <script>
   $(function () {
      //Initialize Select2 Elements
      $(".select2").select2();
    });
  </script>
</head>