<?php
$data=<<<DATA
<html>
<head>
<title>Welcome @ CaRental.com</title>
</head>
<body>
	<section>
	<article>
	<header>
	<h3>One place to build up your carreir with us..</h3>
	</header>
	<div>
		<ul>
		<li><a href="agent_page.php?control=1">Register more Vehicle</a></li>
		<li><a href="agent_page.php?control=2">Remove vehicle</a></li>
		<li><a href="agent_page.php?control=3">Update vehicle info</a></li>
		<li><a href="agent_page.php?control=4">View your vehicle list</a></li>
		</ul>
	</div>
	</article>
	<article>
	<p>View deleted Vehicle <a href="history.php" target="_blank">history</a></p>
	</article>
	</section>
</body>
</html>
DATA;
echo $data;
?>