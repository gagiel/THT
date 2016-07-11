<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $heading; ?></title>
<link href="/css/style.css" rel="stylesheet" type="text/css" />
<link href="/css/index.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="light" class="white_content" style="display:block; height: 300px; ">
  <h3><?php echo $heading; ?></h3>  
  <div class="cwnr1"><p id='errmsg'><?php echo $message; ?></p></div>
  <input type="button" class="log_bnt" value="确 定" onclick="location.href='/index.php/contact/index';"/>
</div>
</body>
</html>