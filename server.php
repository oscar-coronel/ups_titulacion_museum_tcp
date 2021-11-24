<?php

require_once __DIR__.'/servers/SocketTCP.php';

$oSocketTCP = new SocketTCP;

$oSocketTCP->runServer();

?>