<?php
$db=mysql_connect('localhost','bp6am','bp6ampass') or die('Check your connection Parameter');
mysql_select_db('carental',$db) or die(mysql_error($db));
?>