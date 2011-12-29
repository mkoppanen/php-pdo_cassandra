--TEST--
Test quoting values
--SKIPIF--
<?php require_once(dirname(__FILE__) . '/skipif.inc'); ?>
--FILE--
<?php

require_once(dirname(__FILE__) . '/config.inc');

$db = new PDO($dsn);

var_dump ($db->quote ("'hello' 'world'"));
var_dump ($db->quote ("Co'mpl''ex \"st'\"ring"));
var_dump ($db->quote ("test " . chr(0) . " value"));
var_dump ($db->quote ("return false", PDO::PARAM_INT));
var_dump ($db->quote (1234, PDO::PARAM_INT));
var_dump ($db->quote ("4321", PDO::PARAM_INT)); // string represents an integer should be fine
var_dump ($db->quote ("'''''''''", PDO::PARAM_LOB));
var_dump ($db->quote ('true'));
var_dump ($db->quote ('false'));
//var_dump ($db->quote (true, PDO::PARAM_BOOL)); // broken
//var_dump ($db->quote (false, PDO::PARAM_BOOL));

echo "OK";
?>
--EXPECT--
string(21) "'''hello'' ''world'''"
string(26) "'Co''mpl''''ex "st''"ring'"
string(7) "'test '"
bool(false)
string(4) "1234"
string(4) "4321"
string(20) "''''''''''''''''''''"
string(6) "'true'"
string(7) "'false'"
OK
