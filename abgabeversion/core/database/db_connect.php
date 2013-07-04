<?php
        require_once __DIR__ . '/db_config.php';
      	mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());
        mysql_select_db(DB_DATABASE) or die(mysql_error()) or die(mysql_error());
?> 