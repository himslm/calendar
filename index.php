<?php
$now = new dateTime("now");

if(!isset($_REQUEST['month'])){	$_REQUEST['month'] = $now->format("m"); }
if(!isset($_REQUEST['year'])){	$_REQUEST['year'] = $now->format("Y"); }

$cMonth = $_REQUEST["month"];
$cYear = $_REQUEST["year"];
 
$date = new dateTime($cYear . "-" . $cMonth . "-" . 01);

$pYear = $cYear;
$nYear = $cYear;
$pMonth = $cMonth-1;
$nMonth = $cMonth+1;
 
if($pMonth == 0 ){
    $pMonth = 12;
    $pYear = $cYear - 1;
}
if($nMonth == 13 ){
    $nMonth = 1;
    $nYear = $cYear + 1;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>FNB Calendar</title>
<meta http-equiv="X-UA-Compatible" content="ID=EDGE" />
<style type="text/css">
</style>
<link href="/calendar/stylesheets/styles.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="/calendar/javascripts/general.js" type="text/javascript"></script>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" id="calendar-header">
<tr>
<th width="40px"><a href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $pMonth . "&year=" . $pYear; ?>">&lt;</a></th>
<th class="month"><?php echo $date->format("F") .' '.$cYear; ?></th>
<th width="40px"><a href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $nMonth . "&year=" . $nYear; ?>">&gt;</a></th>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" id="calendar">
<tr>
<?php
$days = array("Sun", "Mon", "Tues", "Wed", "Thurs", "Fri", "Sat");
foreach($days AS $day){
	echo '<th>' . $day . '</th>';
}
?>
</tr>
<?php 
function getDayOfYear($cYear, $cMonth, $day){
	$doy = new dateTime($cYear . '-' . $cMonth . '-' . $day);
	return $doy->format("z") + 1;
}
function getRemainingDays($cYear, $cMonth, $day){
	$doy = new dateTime($cYear . '-' . $cMonth . '-' . $day);
	$tDays = new dateTime($cYear . '-' . 12 . '-' . 31);
	return ($tDays->format("z")+ 1) - getDayOfYear($cYear, $cMonth, $day);
}
$maxday = $date->format("t");
$startday = $date->format("w");
for ($i= 0;$i < ($maxday+$startday);$i++) {
	$class = (($now->format("d") == ($i - $startday + 1) AND $now->format("Y") == $cYear AND $now->format("m") == $cMonth) ? 'today' : NULL);
	if(($i % 7) == 0 ){ echo "<tr>"; }
	if($i < $startday){ echo "<td></td>"; }else{ echo "<td class=" . $class . "><div class='day-of-month'>". ($i - $startday + 1) . " <span class='day-of-year'>(" . getDayOfYear($cYear, $cMonth, $i - $startday + 1) . " | " . getRemainingDays($cYear, $cMonth, $i - $startday + 1) . ")</span></div></td>"; }
	if(($i % 7) == 6 ){ echo "</tr>"; }
}
?>
</table>
</body>
</html>
