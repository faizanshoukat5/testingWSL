<b><?php echo ucwords($row['client_name']);?> </b> <br><a href="https://web.whatsapp.com/send?phone=+<?php echo $row['client_whatapp'];?>" target="_blank"><?php echo $row['client_whatapp']; ?></a> <br><?php echo $row['client_email'];?>
<br>
<?php if ($row['client_convert_status']=='New Client') {
	echo "<b class='text-success'>New Client</b>";
}elseif ($row['client_convert_status']=='Old Client') {
	echo "<b class='text-info'>Old Client</b>";
}elseif($row['client_convert_status']=='Old Converted Client'){
	echo "<b class='text-warning'>Old Converted Client</b>";
}elseif ($row['client_convert_status']=='Italy Old Client 2024') {
	echo "<b class='text-primary'>Italy Old Client 2024</b>";
}elseif($row['client_convert_status']=='Austria Converted Client'){
	echo "<b class='text-purple'>Austria Converted Client</b>";
}elseif($row['client_convert_status']=='Italy Converted Client'){
	echo "<b class='text-secondary'>Italy Converted Client</b>";
}elseif($row['client_convert_status']=='Czech Republic Converted Client'){
	echo "<b class='text-pink'>Czech Republic Converted Client</b>";
}elseif($row['client_convert_status']=='Canada Converted Client'){
	echo "<b class='text-danger'>Canada Converted Client</b>";
}elseif($row['client_convert_status']=='USA Converted Client'){
	echo "<b class='text-dark'>USA Converted Client</b>";
}elseif($row['client_convert_status']=='France Converted Client'){
	echo "<b class='text-dark'>France Converted Client</b>";
} ?>