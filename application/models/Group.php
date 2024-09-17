<?php 
	class Group extends CI_Model {

		public $ID_MODULE;
		public $NAME_GR;
		public $ID_GR;
		public $DESC_GR;
		public $SORT_INDEX;
		public $VISIBLE_GR;
		public $LANGUAGE;
		
		public function loadfromquery($queryData){
			$this->ID_GR = $queryData->ID_GR;
			$this->ID_MODULE = $queryData->ID_MODULE;
			$this->NAME_GR = $queryData->NAME_GR;
			$this->DESC_GR = $queryData->DESC_GR;
			$this->SORT_INDEX = $queryData->SORT_INDEX;
			
			
			if(!isset($_POST['VISIBLE_GR'])) $this->VISIBLE_GR = "0";
			else $this->VISIBLE_GR = $_POST['VISIBLE_GR'];
		}
		
		
		public function loadinput_entry()
        {
			$this->ID_MODULE = $_POST['ID_MODULE'];
			$this->NAME_GR = $_POST['NAME_GR'];
			$this->DESC_GR = $_POST['DESC_GR'];
			$this->SORT_INDEX = $_POST['SORT_INDEX'];
			$this->LANGUAGE = $_POST['langQuery'];
			
			if(!isset($_POST['VISIBLE_GR'])) $this->VISIBLE_GR = "0";
			else $this->VISIBLE_GR = $_POST['VISIBLE_GR'];
        }


        public function insert_entry()
        {
			$this->ID_MODULE = $_POST['ID_MODULE'];
			$this->NAME_GR = $_POST['NAME_GR'];
			$this->DESC_GR = $_POST['DESC_GR'];
			$this->SORT_INDEX = $_POST['SORT_INDEX'];
			$this->LANGUAGE = $_POST['langQuery'];
			if(!isset($_POST['VISIBLE_GR'])) $this->VISIBLE_GR = "0";
			else $this->VISIBLE_GR = $_POST['VISIBLE_GR'];
			$this->db->insert('hd_groups', $this);
        }

        public function update_entry()
        {
			unset($this->ID_GR);
			$this->ID_MODULE = $_POST['ID_MODULE'];
			$this->NAME_GR = $_POST['NAME_GR'];
			$this->DESC_GR = $_POST['DESC_GR'];
			$this->SORT_INDEX = $_POST['SORT_INDEX'];
			$this->LANGUAGE = $_POST['langQuery'];
			if(!isset($_POST['VISIBLE_GR'])) $this->VISIBLE_GR = "0";
			else $this->VISIBLE_GR = $_POST['VISIBLE_GR'];

			$this->db->update('hd_groups', $this, array('ID_GR' => $_POST['ID_GR']));
        }

	}
?>