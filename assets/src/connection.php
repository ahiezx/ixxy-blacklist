<?php

class Sessions {

	public function client_ip() {
		if(!isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
			$ip = $_SERVER['REMOTE_ADDR'];
			return $ip;
		}
		else {
			$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
			return $ip;
		}
		return $ip;
	}
}

class MySQL {

    public function session(){
        $mysql = mysqli_connect(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASSWORD, Config::MYSQL_DB);
        return $mysql;
    }

    public function exit() {

    	mysqli_close(self::session());

    }

    public function parse($query) {

    }

}

?>