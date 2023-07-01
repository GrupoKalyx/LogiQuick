<?php


function createGUID()
{
if (function_exists('com_create_guid'))
{
return com_create_guid();
}
else
{
mt_srand((double)microtime()*10000);
//optional for php 4.2.0 and up.
$set_charid = strtoupper(md5(uniqid(rand(), true)));
$set_hyphen = chr(45);
// "-"
$set_uuid = chr(123)
.substr($set_charid, 0, 8).$set_hyphen
.substr($set_charid, 8, 4).$set_hyphen
.substr($set_charid,12, 4).$set_hyphen
.substr($set_charid,16, 4).$set_hyphen
.substr($set_charid,20,12)
.chr(125);
// "}"
return $set_uuid;
}
}
$new_GUID = createGUID();
//echo "GUID :: ".$new_GUID;

require "dbconection.php";
$sql1="SELECT username FROM typeuser WHERE type = 'user'";

$sql2 = "INSERT INTO sessiontoken VALUES UserT = '$sql1' , userToken = '$new_GUID'  ";

echo "GUID :: ".$new_GUID;
?>