<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       medals.php                                                  ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
#################################################################################

include_once("../../Account.php");

mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);

if ($session->access < ADMIN) die("Access Denied: You are not Admin!");

$medalid = $_POST['medalid'];
$uid = $_POST['uid'];

mysql_query("DELETE FROM ".TB_PREFIX."medal WHERE id = ".$medalid."");

$name = mysql_query("SELECT name FROM ".TB_PREFIX."users WHERE id= ".$uid."");
$name = mysql_result($name, 0);

mysql_query("Insert into ".TB_PREFIX."admin_log values (0,$admid,'Deleted medal id [#".$medalid."] from the user <a href=\'admin.php?p=player&uid=$uid\'>$name</a> ',".time().")");


$deleteweek = $_POST['medalweek'];
mysql_query("DELETE FROM ".TB_PREFIX."medal WHERE week = ".$deleteweek."");

header("Location: ../../../Admin/admin.php?p=player&uid=".$uid."");
?>