<?php
$date=date("j");
echo '<html>
<head><title>Select Car</title>
<style>
#topSearch{
	float:right;
	margin:1% 5% auto;
}
#nav-head{
	display:flex;
	list-style-type:none;
}
#nav-head li{
	color:red;
	background-color:yellow;
	margin-left:10px;
	border:2px solid black;
}
</style>
</head>
<body>
<section id="block">
<form name="searchForm" id="topSearch" action="product1.php">
<input type="text" name="search" id="search" placeholder="search! by fare"/>
<input type="submit" name="go" value="search"/>
</form>
</section>
<section id="block">
	<artticle>
		<ul id="nav-head">
			<li>
				<a href="agent.php">Agent Zone</a>
			</li>
			<li>
				<a href="product1.php">Book car</a>
			</li>
			<li>
				<a href="#">status of booked car</a>
			</li>
			<li>
				<a href="#">Transaction History</a>
			</li>
			<li>
				<a href="product1.php?offer=' . (($date%3)+1) . '">Offer</a>
			</li>
			<li>
				<a href="index.php">logout</a>
			</li>
		</ul>
	</article>
</section>
</body>
</html>'
?>