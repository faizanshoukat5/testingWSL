<?php
echo ucwords($row['client_country'])." <br>";
foreach ($appliedChanging as $appRow){
	echo "<b>".ucwords($appRow)."</b> ";
}?>
<br>
<input type="hidden" name="" value="<?php echo $appRow;?>" id="appliedDegree">
<span data-toggle="tooltip" data-placement="top" title="Country"><?php echo ucwords($row['client_countryfrom']);?></span>
<br>
<?php
$embassyTooltips = [
	'Islamabad Embassy' => 'Islamabad Embassy (Punjab, KPK, and northern areas)',
	'Karachi Embassy' => 'Karachi Embassy (Sindh and Balochistan)',
	'Dubai Embassy' => 'Dubai Embassy (Except for Sharjah and Abu Dhabi, students from all other states of the UAE will select the Dubai embassy.)',
	'Abu Dhabi Embassy' => 'Abu Dhabi Embassy (Abu Dhabi, Sharjah)'
];
?>
<span data-toggle="tooltip" data-placement="top" title="<?php echo $row['client_embassy'] ?? '';?>"> <i><?php echo ucwords($row['client_embassy'] ?? ''); ?></i> </span>