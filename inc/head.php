<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
	<meta http-equiv="Cache-Control" content="no-cache">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">
    <title><?=$CONF['title_header'];?></title>
</head>

<?
$start_dowload = microtime(true);
?>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">

<body>
  <div class="download">
        <div class="overlay">
          <i class="fa fa-spinner fa-spin fa-5x "></i>
        </div>      
  
  </div>
  <div class="scrollup">
  <i class="fa fa-chevron-up"></i>
</div>