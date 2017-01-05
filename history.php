<?php
require 'connect.php';
$result=mysql_query('SELECT vid,age,name,regnum,fee,image FROM vehicle_record') or die(mysql_error($db));
$num=mysql_num_rows($result);
$i=0;
echo '<html><head><title>Result</title>
	 <script src="script/product1.js"></script>
	 </head><body><table name="response" border="1">';
	 echo '<tr><th>Index </th><th>Name </th><th> fee  </th><th>Age</th><th>Number</th><th> Images</th><tr>';
	 while($row=mysql_fetch_array($result))
	 {
		 extract($row);
		 echo '<tr><td>'.++$i . '</td><td><p>'.$name. '</p></td><td>' . $fee . ' </td><td > ' . $age . '  </td><td id="event'.$i.'reg'.'">' . $regnum . ' </td><td><img src="' . $image .  '" /></td></tr>';
	 }
	 echo '</table>
	 <p>Number of records found :'.$num. '</p>
	 </body></html>';
?>