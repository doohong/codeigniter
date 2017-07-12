<?php
class User_m extends CI_Model {
 
    function __construct()
    {       
        parent::__construct();
    }

    function insert($user) 
    {
    	$this->db->query("INSERT INTO `data` (`num`, `name`, `id`, `pwd`, `mail`,`nickname`) VALUES ('', '$user[m_name]', '$user[m_id]', password('$user[m_pwd]'), '$user[m_email]','$user[m_nickname]');");

    	
    }

 	function overlap($id)
 	{
 		return $this->db->query("SELECT id from data where id='$id'")->num_rows();
 	}

    function login($logininfo)
    {
    	//$pwd = password($logininfo['login_pwd']);
    	return $this->db->query("SELECT * FROM data WHERE id = '$logininfo[login_id]' AND pwd =  password('$logininfo[login_pwd]')")->num_rows();
    }
    function sessioninfo($logininfo)
    {
        //$pwd = password($logininfo['login_pwd']);
        return $this->db->query("SELECT num,nickname FROM data WHERE id = '$logininfo[login_id]' AND pwd =  password('$logininfo[login_pwd]')")->result_array();
    }
}
?>
