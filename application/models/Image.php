<?php 
	class Image extends CI_Model {

		public $ID;
		public $NAME_IMG;
		public $ID_MODULE;
		public $REF_ID;
		public $IMAGE_URL;
		public $GROUP_ID;
		public $URL_LINK_IMG;
		public $VISIBLE_IMG;
		public $SORT_INDEX;
		public $INFO_1;
		public $INFO_2;
		public $INFO_3;
		public $DATE_CREATED;
		public $USER_CREATED;
		public $DATE_MODIFIED;
		public $USER_MODIFIED;
		public $LANGUAGE;
		
		public function loadfromquery($queryData){
			$this->ID = $queryData->ID;
			$this->NAME_IMG = $queryData->NAME_IMG;
			$this->ID_MODULE = $queryData->ID_MODULE;
			$this->REF_ID = $queryData->REF_ID;
			$this->IMAGE_URL = $queryData->IMAGE_URL;
			$this->GROUP_ID = $queryData->GROUP_ID;
			$this->URL_LINK_IMG = $queryData->URL_LINK_IMG;
			$this->VISIBLE_IMG = $queryData->VISIBLE_IMG;
			$this->SORT_INDEX = $queryData->SORT_INDEX;
			
			$this->INFO_1 = $queryData->INFO_1;
			$this->INFO_2 = $queryData->INFO_2;
			$this->INFO_3 = $queryData->INFO_3;
			
			$this->DATE_CREATED = $queryData->DATE_CREATED;
			$this->USER_CREATED = $queryData->USER_CREATED;
			$this->DATE_MODIFIED = $queryData->DATE_MODIFIED;
			$this->USER_MODIFIED = $queryData->USER_MODIFIED;
		}
		
		
		public function loadinput_entry()
        {
			$this->NAME_IMG = $_POST['NAME_IMG'];
			$this->ID_MODULE = $_POST['ID_MODULE'];
			if(isset($_POST['REF_ID'])) $this->REF_ID = $_POST['REF_ID'];
			else $this->REF_ID = "";
			if(isset($_POST['GROUP_ID'])) $this->GROUP_ID = $_POST['GROUP_ID'];
			$this->URL_LINK_IMG = $_POST['URL_LINK_IMG'];
			$this->SORT_INDEX = $_POST['SORT_INDEX'];
			
			$this->INFO_1 = $_POST['INFO_1'];
			$this->INFO_2 = $_POST['INFO_2'];
			$this->INFO_3 = $_POST['INFO_3'];
			
			if(!isset($_POST['VISIBLE_IMG'])) $this->VISIBLE_IMG = "0";
			else $this->VISIBLE_IMG = $_POST['VISIBLE_IMG'];
        }


        public function insert_entry()
        {
			$this->NAME_IMG = $_POST['NAME_IMG'];
			$this->ID_MODULE = $_POST['ID_MODULE'];
			if(isset($_POST['REF_ID'])) $this->REF_ID = $_POST['REF_ID'];
			else $this->REF_ID = "";
			if(isset($_POST['GROUP_ID'])) $this->GROUP_ID = $_POST['GROUP_ID'];
			else unset($this->GROUP_ID);
			$this->URL_LINK_IMG = $$_POST['URL_LINK_IMG'];
			$this->SORT_INDEX = $_POST['SORT_INDEX'];
			
			$this->INFO_1 = $_POST['INFO_1'];
			$this->INFO_2 = $_POST['INFO_2'];
			$this->INFO_3 = $_POST['INFO_3'];
			
			
			if(!isset($_POST['VISIBLE_IMG'])) $this->VISIBLE_IMG = "0";
			else $this->VISIBLE_IMG = $_POST['VISIBLE_IMG'];
			
			$this->DATE_CREATED = date('Y-m-d H:i:s');
			
			$this->DATE_MODIFIED = $this->DATE_CREATED;
			$this->USER_MODIFIED = $this->USER_CREATED;
			$this->LANGUAGE = $_POST['langQuery'];
			
			$this->db->insert('hd_images', $this);
        }

        public function update_entry()
        {
			unset($this->ID);
			$this->NAME_IMG = $_POST['NAME_IMG'];
			$this->ID_MODULE = $_POST['ID_MODULE'];
			if(isset($_POST['REF_ID'])) $this->REF_ID = $_POST['REF_ID'];
			else $this->REF_ID = "";
			if(isset($_POST['GROUP_ID'])) $this->GROUP_ID = $_POST['GROUP_ID'];
			else unset($this->GROUP_ID);
			$this->URL_LINK_IMG = $_POST['URL_LINK_IMG'];
			$this->SORT_INDEX = $_POST['SORT_INDEX'];
			
			$this->INFO_1 = $_POST['INFO_1'];
			$this->INFO_2 = $_POST['INFO_2'];
			$this->INFO_3 = $_POST['INFO_3'];
			
			
			if(!isset($_POST['VISIBLE_IMG'])) $this->VISIBLE_IMG = "0";
			else $this->VISIBLE_IMG = $_POST['VISIBLE_IMG'];
			
			$this->DATE_CREATED = $_POST['DATE_CREATED'];
			$this->USER_CREATED = $_POST['USER_CREATED'];
			$this->LANGUAGE = $_POST['langQuery'];
			$this->DATE_MODIFIED = date('Y-m-d H:i:s');

			$this->db->update('hd_images', $this, array('ID' => $_POST['ID']));
        }

	}
?>