<?php

// This line is SUPER important! Without it SS will die a long and painful death (painful for you, not SS).
global $databaseConfig; 

$databaseConfig = array(
	"type"     => '<dbtype>',
	"server"   => '<dbhost>',
	"username" => '<dbuser>',
	"password" => '<dbpass>',
	"database" => '<dbname>'
);