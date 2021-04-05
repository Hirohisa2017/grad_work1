<?php
session_start();
require('./mini_bbs/db_connect.php');

if(isset($_SESSION['id']) && $_SESSION['time']+3600>time()){
  $_SESSION['time'] = time();
	$members= $db->prepare('SELECT * FROM gs_user_table WHERE id=?');
  $members->execute(array($_SESSION['id']));
  $member = $members ->fetch();
} else {
	header('Location:login.php');
	exit();
}

if(!empty($_POST)){
  if($_POST['message'] !== ''){
    $message = $db->prepare('INSERT INTO posts SET member_id=?, message=?, reply_message_id=?, created= NOW()');
    $message->execute(array(
      $member['id'],
      $_POST['message'],
      $_POST['reply_post_id']
    ));
    header('Location: index.php');
  }
}

$posts = $db->query('SELECT m.name, m.picture, p.* FROM gs_user_table m, posts p WHERE m.id=p.member_id ORDER BY p.created DESC');
//返信の処理
if(isset($_REQUEST['res'])){
      $response= $db->prepare('SELECT m.name, m.picture, p.* FROM gs_user_table m, posts p WHERE m.id=p.member_id AND p.id=?');
      $response->execute(array($_REQUEST['res']));
      $table=$response->fetch();
      $message='@' . $table['name'] . '' . $table['message'];
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>つながる</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="./css/scrolling-nav.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/select.css">
  <!-- Scroll reveal -->
  <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">つながる</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">ようこそ<?php print(htmlspecialchars($member['name'], ENT_QUOTES)) ?>さん</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#system">たてよこ検索</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger " href="../mini_bbs/logout.php">Log out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <section class="bg-light about_img">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<section class="pt-5">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <h5>Search keywords:-</h5>
            <form action="select_act.php" method='POST'>
            <select name="preference[]" multiple>
              <option value="私費" class="btn btn-outline-dark">私費</option>
              <option value="社費・公費" class="btn btn-outline-dark">社費・公費</option>
              <option value="家族連れ" class="btn btn-outline-dark">家族連れ</option>
              <option value="32歳以下" class="btn btn-outline-dark">32歳以下</option>
              <option value="33歳以上" class="btn btn-outline-dark">33歳以上</option>
              <option value="転職" class="btn btn-outline-dark">転職</option>
              <option value="起業" class="btn btn-outline-dark">起業</option>
              <option value="女性" class="btn btn-outline-dark">女性</option>
            </select>
            <p><input type="submit" value="検索" onclick="buttonClick()"></p>
            </form>
        </div>
    </div>
    </div>
</section>

<section id='search_result'>
</section>


<!-- <section class="pt-2">
    <div class="container">
	<div class="row my-3">
		<div class="col-md-12">
		    <h4>Find the New Car details for your search query of Renault</h4>
		</div>
	</div>
	<div class="row mb-3">
	    <div class="col-md-8">
	        <div class="card">
	            <div class="card-body">
	            </div>
	        </div>
	    </div>
	</div> -->


  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white my_footer">Copyright &copy; 株式会社つながる&nbsp;&nbsp;&nbsp;<span><a href="#" class="company_profile">会社概要</a></p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="js/scrolling-nav.js"></script>
  <script>
  ScrollReveal().reveal('.box', { 
    origin:'left',
    dilay:200,
    duration: 2000, // アニメーションの完了にかかる時間
    viewFactor: 0.2, // 0~1,どれくらい見えたら実行するか
    reset: true   // 何回もアニメーション表示するか 
  });

  function buttonClick (){
    document.createElement('search_result').html(<iframe src='select_act.php'>);
  };
  

  </script>

</body>

</html>
