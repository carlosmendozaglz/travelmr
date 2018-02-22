<?php
require_once './src/com/ctss/controller/Util.php';
header("Content-Type: utf-8");
$util=new Util();
$message="";

session_start();
print_r($_SESSION);

exit();
$resultexec = shell_exec("ipconfig /all");

$location = `which arp`;
// Execute the arp command and store the output in $arpTable
$arpTable = `$location`;

print_r($arpTable);

//preg_match('/(?:[[:xdigit:]]{2}([-:]))(?:[[:xdigit:]]{2}\1){4}[[:xdigit:]]{2}/', $resultexec, $matches, PREG_OFFSET_CAPTURE);
//print_r($matches);
//echo $resultexec;


/*
  echo "<br/><br/>";
  echo "<br/><br/>";
  echo "<br/><br/>";
  echo "<br/><br/>";
  echo "<br/><br/>";
  print_r($_SERVER);
  echo "<br/><br/>";
  print_r($_COOKIE);
  echo "<br/><br/>";
  print_r($_);
 */

$ip  = $_SERVER['REMOTE_ADDR'];
// don't miss to use escapeshellarg(). Make it impossible to inject shell code
$mac = shell_exec('arp -a ' . escapeshellarg($ip));

// can be that the IP doesn't exist or the host isn't up (spoofed?)
// check if we found an address
if(empty($mac)) {
    die("No mac address for $ip not found");
}

// having it
echo "mac address for $ip: $mac";