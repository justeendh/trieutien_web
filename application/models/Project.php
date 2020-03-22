<?php 
	class Project extends CI_Model {

		public $ID_PRJ;
		public $ID_MODULE;
		public $GROUP_ID;
		public $IMAGE_PRJ;
		public $NAME_PRJ;
		public $VISIBLE_PRJ;
		public $DESC_PRJ;
		public $CONTENT_PRJ;
		public $HOST_PRJ;
		public $LOCATION_PRJ;
		public $YEAR_PRJ;
		public $DATE_CREATED;
		public $USER_CREATED;
		public $DATE_MODIFIED;
		public $USER_MODIFIED;
		
		public function loadfromquery($queryData){
			$this->ID_PRJ = $queryData->ID_PRJ;
			$this->ID_MODULE = $queryData->ID_MODULE;
			$this->GROUP_ID = $queryData->GROUP_ID;
			$this->IMAGE_PRJ = $queryData->IMAGE_PRJ;
			$this->NAME_PRJ = $queryData->NAME_PRJ;
			$this->VISIBLE_PRJ = $queryData->VISIBLE_PRJ;
			$this->DESC_PRJ = $queryData->DESC_PRJ;
			$this->CONTENT_PRJ = $queryData->CONTENT_PRJ;
			
			$this->HOST_PRJ = $queryData->HOST_PRJ;
			$this->LOCATION_PRJ = $queryData->LOCATION_PRJ;
			$this->YEAR_PRJ = $queryData->YEAR_PRJ;
			
			$this->DATE_CREATED = $queryData->DATE_CREATED;
			$this->USER_CREATED = $queryData->USER_CREATED;
			$this->DATE_MODIFIED = $queryData->DATE_MODIFIED;
			$this->USER_MODIFIED = $queryData->USER_MODIFIED;
		}
		
		
		public function loadinput_entry()
        {
			$this->ID_MODULE = $_POST['ID_MODULE'];
			if(isset($_POST['GROUP_ID'])) $this->GROUP_ID = $_POST['GROUP_ID'];
			else unset($this->GROUP_ID);
			$this->NAME_PRJ = $_POST['NAME_PRJ'];
			$this->DESC_PRJ = $_POST['DESC_PRJ'];
			$this->CONTENT_PRJ = $_POST['CONTENT_PRJ'];
			$this->HOST_PRJ = $_POST['HOST_PRJ'];
			$this->LOCATION_PRJ = $_POST['LOCATION_PRJ'];
			$this->YEAR_PRJ = isset($_POST['YEAR_PRJ']) ? $_POST['YEAR_PRJ'] : "";
			
			if(!isset($_POST['VISIBLE_PRJ'])) $this->VISIBLE_PRJ = "0";
			else $this->VISIBLE_PRJ = $_POST['VISIBLE_PRJ'];
        }


        public function insert_entry()
        {
			$this->ID_MODULE = $_POST['ID_MODULE'];
			if(isset($_POST['GROUP_ID'])) $this->GROUP_ID = $_POST['GROUP_ID'];
			else unset($this->GROUP_ID);
			$this->NAME_PRJ = $_POST['NAME_PRJ'];
			$this->DESC_PRJ = $_POST['DESC_PRJ'];
			$this->CONTENT_PRJ = $_POST['CONTENT_PRJ'];
			$this->HOST_PRJ = $_POST['HOST_PRJ'];
			$this->LOCATION_PRJ = $_POST['LOCATION_PRJ'];
			$this->YEAR_PRJ = isset($_POST['YEAR_PRJ']) ? $_POST['YEAR_PRJ'] : "";
			$this->DATE_CREATED = date('Y-m-d H:i:s');
			
			if(!isset($_POST['VISIBLE_PRJ'])) $this->VISIBLE_PRJ = "0";
			else $this->VISIBLE_PRJ = $_POST['VISIBLE_PRJ'];
			
			
			$this->DATE_MODIFIED = $this->DATE_CREATED;
			$this->USER_MODIFIED = $this->USER_CREATED;
			
			$this->db->insert('hd_projects', $this);
        }

        public function update_entry()
        {
			unset($this->ID_PRJ);
			
			$this->ID_MODULE = $_POST['ID_MODULE'];
			$this->GROUP_ID = $_POST['GROUP_ID'];
			$this->NAME_PRJ = $_POST['NAME_PRJ'];
			$this->DESC_PRJ = $_POST['DESC_PRJ'];
			$this->CONTENT_PRJ = $_POST['CONTENT_PRJ'];
			$this->HOST_PRJ = $_POST['HOST_PRJ'];
			$this->LOCATION_PRJ = $_POST['LOCATION_PRJ'];
			$this->YEAR_PRJ = isset($_POST['YEAR_PRJ']) ? $_POST['YEAR_PRJ'] : "";
			
			$this->DATE_CREATED = $_POST['DATE_CREATED'];
			$this->USER_CREATED = $_POST['USER_CREATED'];
			$this->DATE_MODIFIED = date('Y-m-d H:i:s');			
			
			if(!isset($_POST['VISIBLE_PRJ'])) $this->VISIBLE_PRJ = "0";
			else $this->VISIBLE_PRJ = $_POST['VISIBLE_PRJ'];

			$this->db->update('hd_projects', $this, array('ID_PRJ' => $_POST['ID_PRJ']));
        }

	}
?>