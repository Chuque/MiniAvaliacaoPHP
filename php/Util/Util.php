<?php
class Util {
	public static function debug($var){
		echo "<pre>";
		print_r($var);
		echo "</pre>";		
	}
	public static function alert($var){
		echo "<script>alert('".$var."');</script>";		
	}
	public static function consoleLog($var){
		echo "<script>console.log(".$var.");</script>";		
	}
}