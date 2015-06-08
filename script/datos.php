<?php 
require_once "db.php";

class datos extends db
{    
    public function __construct()
    {
        parent::__construct();
    }

    public function get_users()
    {
        $result = $this->_db->query('SELECT * FROM usuarios');
        
        $users = $result->fetch_all(MYSQLI_ASSOC);
        parent::close();
        return $users;
    }
}
  ?> 