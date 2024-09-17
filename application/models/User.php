<?php 
	class User extends CI_Model {

		public $USERNAME;
		public $FULL_NAME;
		public $IS_ADMIN;
		public $LAST_LOGIN;
		public $PASSWORD;
		
		public function loadfromquery($queryData){
			$this->USERNAME = $queryData->USERNAME;
			$this->FULL_NAME = $queryData->FULL_NAME;
			$this->IS_ADMIN = $queryData->IS_ADMIN;
			$this->LAST_LOGIN = $queryData->LAST_LOGIN;
			$this->PASSWORD = $queryData->PASSWORD;
		}
		
		
		public function loadinput_entry()
        {
			$this->USERNAME = $_POST['USERNAME'];
			$this->FULL_NAME = $_POST['FULL_NAME'];
			$this->LAST_LOGIN = $_POST['LAST_LOGIN'];
			$this->PASSWORD = $_POST['PASSWORD'];
			
			if(!isset($_POST['IS_ADMIN'])) $this->IS_ADMIN = "0";
			else $this->IS_ADMIN = $_POST['IS_ADMIN'];
        }


        public function insert_entry()
        {
			$this->USERNAME = $_POST['USERNAME'];
			$this->FULL_NAME = $_POST['FULL_NAME'];
			$this->LAST_LOGIN = $_POST['LAST_LOGIN'];
			if(isset($_POST['NEW_PASSWORD'])) $this->PASSWORD = md5($_POST['NEW_PASSWORD']);
			else unset($this->PASSWORD);
			
			if(!isset($_POST['IS_ADMIN'])) $this->IS_ADMIN = "0";
			else $this->IS_ADMIN = $_POST['IS_ADMIN'];
			
			$this->db->insert('hd_users', $this);
        }

        public function update_entry()
        {
			unset($this->USERNAME);
			$this->FULL_NAME = $_POST['FULL_NAME'];
			$this->LAST_LOGIN = $_POST['LAST_LOGIN'];
			if(isset($_POST['NEW_PASSWORD'])) $this->PASSWORD = md5($_POST['NEW_PASSWORD']);
			else unset($this->PASSWORD);
			
			if(!isset($_POST['IS_ADMIN'])) $this->IS_ADMIN = "0";
			else $this->IS_ADMIN = $_POST['IS_ADMIN'];

			$this->db->update('hd_users', $this, array('USERNAME' => $_POST['USERNAME']));
        }

	}
?>