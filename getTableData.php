<?php
include 'models/make-handshake.php';
$con = mysqli_connect($host, $uname, $pass,$db);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}
date_default_timezone_set('Asia/Kolkata');
$now = date('H:i:s ', time());
// echo $now;
$slot="";
if ($now>"00:00:00" && $now< "00:14:59") {
  # code...
  $slot = "1";
}
if ($now>"00:15:00" && $now<= "00:29:59") {
  # code...
  $slot = "2";
}
if ($now>"00:30:00" && $now<= "00:44:59") {
  # code...
  $slot = "3";
}
if ($now>"00:45:00" && $now<= "00:59:59") {
  # code...
  $slot = "4";
}
if ($now>"01:00:00" && $now<= "01:14:59") {
  # code...
  $slot = "5";
}
if ($now>"01:15:00" && $now<= "01:29:59") {
  # code...
  $slot = "6";
}
if ($now>"01:30:00" && $now<= "01:44:59") {
  # code...
  $slot = "7";
}
if ($now>"01:45:00" && $now<= "01:59:59") {
  # code...
  $slot = "8";
}
if ($now>"02:00:00" && $now<= "02:14:59") {
  # code...
  $slot = "9";
}if ($now>"02:15:00" && $now<= "02:29:59") {
  # code...
  $slot = "10";
}
if ($now>"02:30:00" && $now<= "02:44:59") {
  # code...
  $slot = "11";
}
if ($now>"02:45:00" && $now<= "02:59:59") {
  # code...
  $slot = "12";
}
if ($now>"03:00:00" && $now<= "03:14:59") {
  # code...
  $slot = "13";
}if ($now>"03:15:00" && $now<= "03:29:59") {
  # code...
  $slot = "14";
}
if ($now>"03:30:00" && $now<= "03:44:59") {
  # code...
  $slot = "15";
}
if ($now>"03:45:00" && $now<= "03:59:59") {
  # code...
  $slot = "16";
}
if ($now>"04:00:00" && $now<= "04:14:59") {
  # code...
  $slot = "17";
}if ($now>"04:15:00" && $now<= "04:29:59") {
  # code...
  $slot = "18";
}
if ($now>"04:30:00" && $now<= "04:44:59") {
  # code...
  $slot = "19";
}
if ($now>"04:45:00" && $now<= "04:59:59") {
  # code...
  $slot = "20";
}
if ($now>"05:00:00" && $now<= "05:14:59") {
  # code...
  $slot = "21";
}if ($now>"05:15:00" && $now<= "05:29:59") {
  # code...
  $slot = "22";
}
if ($now>"05:30:00" && $now<= "05:44:59") {
  # code...
  $slot = "23";
}
if ($now>"05:45:00" && $now<= "05:59:59") {
  # code...
  $slot = "24";
}
if ($now>"06:00:00" && $now<= "06:14:59") {
  # code...
  $slot = "25";
}if ($now>"06:15:00" && $now<= "06:29:59") {
  # code...
  $slot = "26";
}
if ($now>"06:30:00" && $now<= "06:44:59") {
  # code...
  $slot = "27";
}
if ($now>"06:45:00" && $now<= "06:59:59") {
  # code...
  $slot = "28";
}
if ($now>"07:00:00" && $now<= "07:14:59") {
  # code..
  $slot = "29";
}if ($now>"07:15:00" && $now<= "07:29:59") {
  # code...
  $slot = "30";
}
if ($now>"07:30:00" && $now<= "07:44:59") {
  # code...
  $slot = "31";
}
if ($now>"07:45:00" && $now<= "07:59:59") {
  # code...
  $slot = "32";
}
if ($now>"08:00:00" && $now<= "08:14:59") {
  # code...
  $slot = "33";
}if ($now>"08:15:00" && $now<= "08:29:59") {
  # code...
  $slot = "34";
}
if ($now>"08:30:00" && $now<= "08:44:59") {
  # code...
  $slot = "35";
}
if ($now>"08:45:00" && $now<= "08:59:59") {
  # code...
  $slot = "36";
}
if ($now>"09:00:00" && $now<= "09:14:59") {
  # code...
  $slot = "37";
}if ($now>"09:15:00" && $now<= "09:29:59") {
  # code...
  $slot = "38";
}
if ($now>"09:30:00" && $now<= "09:44:59") {
  # code...
  $slot = "39";
}
if ($now>"09:45:00" && $now<= "09:59:59") {
  # code...
  $slot = "40";
}
if ($now>"10:00:00" && $now<= "10:14:59") {
  # code...
  $slot = "41";
}if ($now>"10:15:00" && $now<= "10:29:59") {
  # code...
  $slot = "42";
}
if ($now>"10:30:00" && $now<= "10:44:59") {
  # code...
  $slot = "43";
}
if ($now>"10:45:00" && $now<= "10:59:59") {
  # code...
  $slot = "44";
}
if ($now>"11:00:00" && $now<= "11:14:59") {
  # code...
  $slot = "45";
}if ($now>"11:15:00" && $now<= "11:29:59") {
  # code...
  $slot = "46";
}
if ($now>"11:30:00" && $now<= "11:44:59") {
  # code...
  $slot = "47";
}
if ($now>"11:45:00" && $now<= "11:59:59") {
  # code...
  $slot = "48";
}
if ($now>"12:00:00" && $now<= "12:14:59") {
  # code...
  $slot = "49";
}if ($now>"12:15:00" && $now<= "12:29:59") {
  # code...
  $slot = "50";
}
if ($now>"12:30:00" && $now<= "12:44:59") {
  # code...
  $slot = "51";
}
if ($now>"12:45:00" && $now<= "12:59:59") {
  # code...
  $slot = "52";
}
if ($now>"13:00:00" && $now<= "13:14:59") {
  # code...
  $slot = "53";
}if ($now>"13:15:00" && $now<= "13:29:59") {
  # code...
  $slot = "54";
}
if ($now>"13:30:00" && $now<= "13:44:59") {
  # code...
  $slot = "55";
}
if ($now>"13:45:00" && $now<= "13:59:59") {
  # code...
  $slot = "56";
}
if ($now>"14:00:00" && $now<= "14:14:59") {
  # code...
  $slot = "57";
}if ($now>"14:15:00" && $now<= "14:29:59") {
  # code...
  $slot = "58";
}
if ($now>"14:30:00" && $now<= "14:44:59") {
  # code...
  $slot = "59";
}
if ($now>"14:45:00" && $now<= "14:59:59") {
  # code...
  $slot = "60";
}
if ($now>"15:00:00" && $now<= "15:14:59") {
  # code...
  $slot = "61";
}if ($now>"15:15:00" && $now<= "15:29:59") {
  # code...
  $slot = "62";
}
if ($now>"15:30:00" && $now<= "15:44:59") {
  # code...
  $slot = "63";
}
if ($now>"15:45:00" && $now<= "15:59:59") {
  # code...
  $slot = "64";
}
if ($now>"16:00:00" && $now<= "16:14:59") {
  # code...
  $slot = "65";
}if ($now>"16:15:00" && $now<= "16:29:59") {
  # code...
  $slot = "66";
}
if ($now>"16:30:00" && $now<= "16:44:59") {
  # code...
  $slot = "67";
}
if ($now>"16:45:00" && $now<= "16:59:59") {
  # code...
  $slot = "68";
}
if ($now>"17:00:00" && $now<= "17:14:59") {
  # code...
  $slot = "69";
}if ($now>"17:15:00" && $now<= "17:29:59") {
  # code...
  $slot = "70";
}
if ($now > "17:30:00" && $now < "17:44:59") {
  # code...
  $slot = "71";
}
if ($now>"17:45:00" && $now<= "17:59:59") {
  # code...
  $slot = "72";
}
if ($now>"18:00:00" && $now<= "18:14:59") {
  # code...
  $slot = "73";
}if ($now>"18:15:00" && $now<= "18:29:59") {
  # code...
  $slot = "74";
}
if ($now>"18:30:00" && $now<= "18:44:59") {
  # code...
  $slot = "75";
}
if ($now>"18:45:00" && $now<= "18:59:59") {
  # code...
  $slot = "76";
}
if ($now>"19:00:00" && $now<= "19:14:59") {
  # code...
  $slot = "77";
}if ($now>"19:15:00" && $now<= "19:29:59") {
  # code...
  $slot = "78";
}
if ($now>"19:30:00" && $now<= "19:44:59") {
  # code...
  $slot = "79";
}
if ($now>"19:45:00" && $now<= "19:59:59") {
  # code...
  $slot = "80";
}
if ($now>"20:00:00" && $now<= "20:14:59") {
  # code...
  $slot = "81";
}if ($now>"20:15:00" && $now<= "20:29:59") {
  # code...
  $slot = "82";
}
if ($now>"20:30:00" && $now<= "20:44:59") {
  # code...
  $slot = "83";
}
if ($now>"20:45:00" && $now<= "20:59:59") {
  # code...
  $slot = "84";
}
if ($now>"21:00:00" && $now<= "21:14:59") {
  # code...
  $slot = "85";
}if ($now>"21:15:00" && $now<= "21:29:59") {
  # code...
  $slot = "86";
}
if ($now>"21:30:00" && $now<= "81:44:59") {
  # code...
  $slot = "87";
}
if ($now>"21:45:00" && $now<= "21:59:59") {
  # code...
  $slot = "88";
}
if ($now>"22:00:00" && $now<= "22:14:59") {
  # code...
  $slot = "89";
}if ($now>"22:15:00" && $now<= "22:29:59") {
  # code..
  $slot = "90";
}
if ($now>"22:30:00" && $now<= "22:44:59") {
  # code...
  $slot = "91";
}
if ($now>"22:45:00" && $now<= "22:59:59") {
  # code...
  $slot = "92";
}
if ($now>"23:00:00" && $now<= "23:14:59") {
  # code...
  $slot = "93";
}if ($now>"23:15:00" && $now<= "23:29:59") {
  # code...
  $slot = "94";
}
if ($now>"23:30:00" && $now<= "23:44:59") {
  # code...
  $slot = "95";
}
if ($now>"23:45:00" && $now<= "23:59:59") {
  # code...
  $slot = "96";
}
// echo $slot;


$today = date("Y-m-d");
// echo $today;

$sel = mysqli_query($con,"SELECT DISTINCT * FROM `incoming_parameters` WHERE `slot_number` = '".$slot."' AND `insert_date` = '".$today."' ORDER BY `meter_serial_number`  ASC LIMIT 5");
$data = array();

while ($row = mysqli_fetch_array($sel)) {
 $rtc = date('d-m-y h:i', strtotime($row['rtc']));
 $data[] = array("incoming_id"=>$row['incoming_id'],"meter_serial_number"=>$row['meter_serial_number'],"rtc"=>$rtc,"current_a"=>$row['current_a'],"voltage_v"=>$row['voltage_v'],"kw"=>$row['kw'],"pf"=>$row['pf'],"frequency_hz"=>$row['frequency_hz'],"cumulative_active_energy_kwh"=>$row['cumulative_active_energy_kwh'],"apparent_energy_kvah"=>$row['apparent_energy_kvah']);
}
echo json_encode($data);

 ?>
