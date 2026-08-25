<?php 
	class Article extends CI_Model {

		public $ID_MODULE;
		public $ID_AR;
		public $NAME_AR;
		public $DESC_AR;
		public $CONTENT_AR;
		public $IMAGE_AR;
		public $GROUP_ID;
		public $SORT_INDEX;
		public $VISIBLE_AR;
		public $DATE_CREATED;
		public $USER_CREATED;
		public $DATE_MODIFIED;
		public $USER_MODIFIED;
		public $LANGUAGE;
		
		public function loadfromquery($queryData){
			$this->ID_AR = $queryData->ID_AR;
			$this->NAME_AR = $queryData->NAME_AR;
			$this->DESC_AR = $queryData->DESC_AR;
			$this->CONTENT_AR = $queryData->CONTENT_AR;
			$this->IMAGE_AR = $queryData->IMAGE_AR;
			$this->GROUP_ID = $queryData->GROUP_ID;
			$this->SORT_INDEX = $queryData->SORT_INDEX;
			$this->VISIBLE_AR = $queryData->VISIBLE_AR;
			$this->DATE_CREATED = $queryData->DATE_CREATED;
			$this->USER_CREATED = $queryData->USER_CREATED;
			$this->DATE_MODIFIED = $queryData->DATE_MODIFIED;
			$this->USER_MODIFIED = $queryData->USER_MODIFIED;
		}
		
		
		public function loadinput_entry()
        {
			$this->ID_MODULE = $_POST['ID_MODULE'];
			$this->NAME_AR = $_POST['NAME_AR'];
			$this->DESC_AR = $_POST['DESC_AR'];
			$this->CONTENT_AR = $_POST['CONTENT_AR'];
			if(isset($_POST['GROUP_ID'])) $this->GROUP_ID = $_POST['GROUP_ID'];
			$this->SORT_INDEX = $_POST['SORT_INDEX'];
			
			if(!isset($_POST['VISIBLE_AR'])) $this->VISIBLE_AR = "0";
			else $this->VISIBLE_AR = $_POST['VISIBLE_AR'];
        }


        public function insert_entry()
        {
			$this->ID_MODULE = $_POST['ID_MODULE'];
			$this->NAME_AR = $_POST['NAME_AR'];
			$this->DESC_AR = $_POST['DESC_AR'];
			$this->CONTENT_AR = $_POST['CONTENT_AR'];
			if(isset($_POST['GROUP_ID'])) $this->GROUP_ID = $_POST['GROUP_ID'];
			else unset($this->GROUP_ID);
			$this->SORT_INDEX = $_POST['SORT_INDEX'];
			if(!isset($_POST['VISIBLE_AR'])) $this->VISIBLE_AR = "0";
			else $this->VISIBLE_AR = $_POST['VISIBLE_AR'];
			$this->DATE_CREATED = date('Y-m-d H:i:s');
			$this->DATE_MODIFIED = date('Y-m-d H:i:s');
			$this->USER_MODIFIED = $this->USER_CREATED;
			$this->LANGUAGE = $_POST['langQuery'];
			$this->db->insert('hd_articles', $this);
        }

        public function update_entry()
        {
			unset($this->ID_AR);
			$this->ID_MODULE = $_POST['ID_MODULE'];
			$this->NAME_AR = $_POST['NAME_AR'];
			$this->DESC_AR = $_POST['DESC_AR'];
			$this->CONTENT_AR = $_POST['CONTENT_AR'];
			if(isset($_POST['GROUP_ID'])) $this->GROUP_ID = $_POST['GROUP_ID'];
			else unset($this->GROUP_ID);
			$this->SORT_INDEX = $_POST['SORT_INDEX'];
			if(!isset($_POST['VISIBLE_AR'])) $this->VISIBLE_AR = "0";
			else $this->VISIBLE_AR = $_POST['VISIBLE_AR'];
			$this->DATE_CREATED = $_POST['DATE_CREATED'];
			$this->USER_CREATED = $_POST['USER_CREATED'];
			$this->LANGUAGE = $_POST['langQuery'];
			$this->DATE_MODIFIED = date('Y-m-d H:i:s');

			$this->db->update('hd_articles', $this, array('ID_AR' => $_POST['ID_AR']));
        }

	}
?>