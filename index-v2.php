<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<!-- Bootstrap Start -->
<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/cerulean/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/cerulean/bootstrap-theme.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> 
<!-- Bootstrap Finish -->

<!-- Meta Start -->
<meta charset="UTF-8">
<meta name="description" content="Download Instagram Picture or Video, Support Instagram Multi Media Post">
<meta name="keywords" content="Instagram Multi Downloader, Instagram Downloader, Instagram, Download, Post Downloader, Video Downloader, Picture Download, Multi Picture Downloader, Multi Instagram, Instagram Multi, Video Multi, Multi Downloader">
<meta name="author" content="YOUR_NAME">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Meta Finish -->

<title>Instagram Multi Downloader</title>
</head>
<style>
.container {
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
  padding-top: 15px;
  width:65%;
}
</style>
<body>
<div class="container">
<div class="alert alert-success" role="alert">
<center>
Instagram Multi Downloader
</center>
</div>
<!-- Info -->
<div class="panel panel-success">
  <div class="panel-heading"><center><b>Instagram Multi Downloader</b></center></div>
  <div class="panel-body">
    <!-- Form Start -->
<form method="POST" action="./index-v2.php">
  <div class="form-group">
    <label for="email">Instagram Post URL :</label>
    <input type="text" class="form-control" name="post" placeholder="https://www.instagram.com/p/BaWWXmGAJKa/?taken-by=f.ahmad480">
  </div>
  <center><button type="submit" class="btn btn-success">Submit</button><br/><br/>Copyright &copy; 2018 - YOUR_NAME</center>
</form>
   <!-- Form end -->
  </div>
</div>
<!-- Info -->
<?php
if($_POST['post']) {
$uri = file_get_contents("http://example.com/IGPost.php?id=".$_POST['post']);
$json = json_decode($uri, TRUE);
?>
<div class="panel panel-success">
  <div class="panel-heading"><center><b>Result</b></center></div>
  <div class="panel-body">
    <!-- Form Start -->
<center>
<?
if($json['pict_url']['0']) {
for($i=0; $i < count($json['pict_url']); $i++) {
if($json['video_url'][$i]) {
$result = '<video width="320" height="320" controls><source src="'.$json['video_url'][$i].'" type="video/mp4"></video>';
} elseif(!$json['video_url'][$i]) {
$result = '<img width="320" height="320" src="'.$json['pict_url'][$i].'">';
}
echo $result;
echo "<br/><br/>";
}
} elseif(!$json['pict_url']['0'] && $json['first_video']) {
echo '<video width="320" height="320" controls><source src="'.$json['first_video'].'" type="video/mp4"></video>';
} elseif(!$json['pict_url']['0'] && !$json['first_video']) {
echo '<img width="320" height="320" src="'.$json['first_pict'].'">';
}
?>
<? } ?>
</center>
  </div>
</div>
<!-- Info End -->
</div>


</body>
</html>