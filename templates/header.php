<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title><?php echo htmlspecialchars($result->getTitle())?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<p class="colorline"></p>
<div id="contain">
<div id="header"><div>
  <h1><?php echo htmlspecialchars($result->getTitle())?></h1>
  <h3><?php echo htmlspecialchars($result->getSummary())?></h3>
</div></div>
<nav>
  <p><a href="<?php echo $_SERVER["PHP_SELF"]. '?action=home'?>">Home</a>&nbsp&nbsp
  <a href="<?php echo $_SERVER["PHP_SELF"]. '?action=view&shortName=about'?>">About</a>
  </p>
</nav>
<div id="left">
<h1><?php echo htmlspecialchars($result->getTitle())?></h1>
<p><?php echo $result->getContent()?></p>
</div>
