<?php
class Session{

	public static function init(){
		session_start();
	}

	public static function set($key, $val){
		$_SESSION[$key] = $val;
	}

	public static function get($key){
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		}else{
			return false;
		}
	}

	public static function checkSession(){
		self::init();
		if (self::get("login")==false) {
			self::destory();
			header("Location:login.php");
		}
	}

	public static function checkLogin(){
		self::init();
		if (self::get("login")==true) {
			header("Location:index.php");
		}
	}

	public static function destory(){
		session_destroy();
		header("Location:login.php");
	}

	public static function autodestroy(){
		self::init();
		// set time-out period (in seconds)
		$inactive = 15;
		 
		// check to see if $_SESSION["timeout"] is set
		if (isset($_SESSION["timeout"])) {
		    // calculate the session's "time to live"
		    $sessionTTL = time() - $_SESSION["timeout"];
		    if ($sessionTTL > $inactive) {
		        session_destroy();
		        header("Location: /login.php");
		    }
		}
		$_SESSION["timeout"] = time();

	}
}
?>