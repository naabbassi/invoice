<html>
<head>
	<title>TECHNO PRINT</title>
    <meta charset="utf-8" lang="en">
    <meta name="description" content="techno print company">
    <meta name="author" content="Naser Abbasi">
    <link rel="stylesheet" type="text/css" href="asset/css.css">
  <script src="asset/jquery-1.4.4.min.js" type="text/javascript"></script>
</head>
<body>
	<div class="container">
  <?php
  include 'head.php';
  if (file_exists($page.".php")) {
  include $page.'.php';
  } else {
    include '404.php';
  }
  include 'footer.php';
  ?>
  </div>
</body>
</html>