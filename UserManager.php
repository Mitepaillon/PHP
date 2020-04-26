<?php
//dao = data acces object
//dal = data access layer
class UserManager {
    private $table;
    private $connection;
    private $user_list;
    
    function __construct() {
        $this->table = 'users';
        $this->connection = new PDO('mysql:host=localhost;dbname=demo', 'root', '');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $this->user_list = array();
    }
    
    function save($data) {
        $data['pk'] = -1;
        $user = $this->create([
            'pk' => $data['pk'],
            'username' => $data['username'],
            'password' => $data['password'],
        ]);
        
        if ($user) {
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (username, password) VALUES (?, ?)"
                );
                $statement->execute([
                    $user->__get('username'),
                    $user->__get('password'),
                ]);
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        } 
    }
	
	function update($username,$password,$pk){
        $statement = $this->connection->prepare("UPDATE users SET username = ?, password = ? WHERE pk = ?");
        $statement->execute(([$username,$password,$pk]));
    }
    
    function fetchAll() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($results as $user) {
                array_push($this->user_list, $this->create($user));
            }
            return $this->user_list;
            
        } catch (PDOException $e) {
            print $e->getMessage();
        }    
    }
    
    function create($data) {
        return new user(
            $data['pk'],
            $data['username'],
            $data['password']
        );
    }
	
	function supprimer($pk){
		var_dump('on est là');
            try {
                $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE pk = ?");
                $statement->execute([$pk]);
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        
	}    
    
}
