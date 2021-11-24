<?php

require_once __DIR__.'/../traits/ProcessPetition.php';

class SocketTCP
{

	use ProcessPetition;

	private $PROTOCOL = 'tcp';
	private $HOST = 'localhost';
	private $PORT = 1110;

	private $oSocket;
	private $errno;
	private $errstr;

	public function __construct()
	{
		$this->oSocket = stream_socket_server("$this->PROTOCOL://$this->HOST:$this->PORT", $this->errno, $this->errstr);
	}

	public function runServer()
	{
		if (!$this->oSocket) {
			echo "$this->errstr ($this->errno)<br />\n";
		} else {
			while (true) {
				try{
					$conn = stream_socket_accept($this->oSocket);
					$oPeticion = stream_socket_recvfrom($conn, 1024, 0, $peer);
					$oResponse = $this->process($oPeticion);
					fwrite($conn, $oResponse);
					fclose($conn);
				} catch (Exception $Ex){
					//echo $Ex->getMessage();
				}
			}
			fclose($this->oSocket);
		}
	}

}


?>