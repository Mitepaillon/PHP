<?php 
class User {
    private $pk;
    private $username;
    private $password;
	
	function __construct($pk, $username, $password) {
        $this->pk = $pk;
        $this->username = $username;
        $this->password = $password;
    }

	
	function __get($property) {
        if (property_exists($this, $property)) {
			return $this->$property;
		}
    }
    
    function __set($property, $value) {
        if (property_exists($this, $property)) {
			$this->$property = $value;
		}
    }
	
}