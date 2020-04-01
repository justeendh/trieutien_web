<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('cookie');
		$this->load->helper(array('form', 'url', 'counter'));
		$this->load->database();
		$this->load->library('user_agent');
		$this->load->library('form_validation');
		
		if(($this->router->fetch_method() != "login" && $this->router->fetch_method() != "loginuser")) {
			if($this->session->username == "" ) redirect('admin/manage/login-module-user', 'location');
		} 

		if($this->input->cookie('admin-language') == null || $this->input->cookie('admin-language') == ''){			
			$cookie = array(
				'name'   => 'admin-language',
				'value'  => 'Vi-VN',                            
				'expire' => 86400*30,                                                                                   
				'secure' => FALSE
			);
			$this->input->set_cookie($cookie);
		}

	}
	
	public function closeConnection(){
		unset(
			$_SESSION['username'],
			$_SESSION['fullname'],
			$_SESSION['isadmin']
		);
	}
		
	public function getlogsupdated(){
		$counterdate = $this->db->query("SELECT COUNTER FROM hd_userbydatelogs WHERE DATE_ACCESS = '".date('Y-m-d')."'");
		$counterdateval = 0;
		if($counterdate->num_rows() == 0 ){
			$counterdateval = 0;
			$qr = "INSERT INTO hd_userbydatelogs (DATE_ACCESS, COUNTER) VALUES ('".date('Y-m-d')."', 0);";
			$query =$this->db->query($qr);
		}
		else $counterdateval = $counterdate->row()->COUNTER;
		$data = array("countvisitor" => count_visitor(), "counterdate" =>  array("date" => date('Y-m-d'), "counter" => $counterdateval )); 
		echo json_encode($data);
	}
//	
//	
//	public function insertdata(){
//		// Set timezone
//		date_default_timezone_set('UTC');
//		// Start date
//		$date = '2018-07-31';
//		// End date
//		$end_date = '2018-09-21';
//		while (strtotime($date) <= strtotime($end_date)) {
//			$qr = "INSERT INTO hd_userbydatelogs (DATE_ACCESS, COUNTER) VALUES ('".$date."', 0)";
//			$query =$this->db->query($qr);
//			echo $qr."\r\n";
//			$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
//		}
//	}
	
	
	public function login(){		
		$this->load->view('admin/login');
	}

	public function changelang($language){	
		$cookie = array(
			'name'   => 'admin-language',
			'value'  => $language,                            
			'expire' => 86400*30,                                                                                   
			'secure' => FALSE
		);
		$this->input->set_cookie($cookie);
		redirect('admin', 'location');
	}
	
	public function loginuser(){	
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		if($username == "" || $password == ""){
			$data["viewData"] = array("Failed" => "Vui lòng nhập tài khoản và mật khẩu");
			$this->load->view('admin/login', $data);
			return;
		}
		$queryUser =$this->db->query("SELECT * from hd_users WHERE username = '".$username."' AND password = '".md5($password)."'");
		if( $queryUser->num_rows() > 0){			
			$userlogin = array(
				'username'  => $queryUser->row()->USERNAME,
				'fullname'     => $queryUser->row()->FULL_NAME,
				'isadmin' => $queryUser->row()->IS_ADMIN == 1 ? true : false
			);
			$this->session->set_userdata($userlogin);
			redirect('admin', 'location');
		}
		else{
			$data["viewData"] = array("Failed" => "Tài khoản hoặc mật khẩu không đúng");
			$this->load->view('admin/login', $data);
			return;
		}
				//echo $this->session->username;
	}
	
	public function logout(){		
		unset(
			$_SESSION['username'],
			$_SESSION['fullname'],
			$_SESSION['isadmin']
		);
		redirect('admin/manage/login-module-user', 'location');
	}
	
	public function changepassworduser(){
		$NEW_PASSWORD_CURRENT_USER = $this->input->post("NEW_PASSWORD_CURRENT_USER");
		if (isset($NEW_PASSWORD_CURRENT_USER) && $NEW_PASSWORD_CURRENT_USER != "")
		{
			$this->db->query("UPDATE hd_users SET PASSWORD = '"
							 .md5($NEW_PASSWORD_CURRENT_USER)."' WHERE USERNAME = '"
							 .$this->session->username."'");
			if($this->db->affected_rows() > 0) redirect('admin/manage/login-module-user?changepasswordsuccess=true', 'location');
			else redirect('admin?changepasswordfailed=true', 'location');
		}
		else{
			redirect('admin?changepasswordfailed=true', 'location');
		}
	}
	
	public function index()
	{
		$data = array('content'=>'admin/home');
		$this->load->view('admin/master_view', $data);
	}
	
	public function toogleenablesite(){
		$visible = $this->input->post("visible");
		if($visible == "") $visible = 0;
		$this->db->query("UPDATE hd_infomations SET VAL_INFO = ".$visible." WHERE KEY_INFO = 'stopwebsite'");
		$arr = array();
		if($this->db->affected_rows() > 0)  $arr['success'] = true;
		else  $arr['success'] = false;
		//add the header here 
		header('Content-Type: application/json');
		echo json_encode( $arr );
	}
	
	public function listuser(){

		$langQuery = get_cookie("admin-language");

		$this->load->library('pagination');
		$limitrec = 20;
		$per_page = $this->input->get("per_page");
		if(!isset($per_page) || $per_page == null) $per_page = 1;
		$offsetSelect = ($per_page-1)*$limitrec;
		$searchq = $this->input->get("searchq");
		$filterQr = (isset($searchq) && $searchq != "") ? " WHERE USERNAME like '%".$searchq."%' OR FULL_NAME like '%".$searchq."%' " : " ";
		
		$data = array('content'=>'admin/listuser');
		$contentModel = $this->db->query("SELECT * FROM hd_users ".$filterQr." LIMIT ".$offsetSelect." ,".$limitrec);
		$queryCount = $this->db->query("SELECT count(*) TOTAL_REC FROM hd_users ".$filterQr);		
		$data['viewData'] = array('TOTAL_REC' => $queryCount->row()->TOTAL_REC);
		$data["contentModel"] = $contentModel->result();
		$this->load->view('admin/master_view', $data);
	} 
	
	public function adduser($module)
	{	
		$this->load->model('User', 'contentModel');
		$this->contentModel->IS_ADMIN = false;
		
		$data = array();
		$data['contentModel'] = $this->contentModel;
		$data['viewData'] = array('ACTION_EDIT' => "false");
		$data['content'] = 'admin/edituser';
		$this->load->view('admin/master_view', $data);
	}
	
	public function modifyuser($module)
	{	
		$id = $_GET['id'];
		$this->load->model('User', 'contentModel');
		$this->contentModel->ID_MODULE = $module;
		$queryGetArticleItem = $this->db->query("SELECT * FROM hd_users WHERE USERNAME ='".$id."' LIMIT 1");
		$this->contentModel->loadfromquery($queryGetArticleItem->row());
			
		$data = array();
		$data['contentModel'] = $this->contentModel;
		$data['viewData'] = array('ACTION_EDIT' => "true");
		$data['content'] = 'admin/edituser';
		$this->load->view('admin/master_view', $data);
	}
	
	public function saveuser($module){		
		$ACTION_EDIT = $this->input->post('ACTION_EDIT');	
		
		if($ACTION_EDIT == "false"){
			$config = array(
				array(
					'field' => 'FULL_NAME',
					'label' => 'Tên người dùng',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Vui lòng nhập %s.',
					)
				),
				array(
					'field' => 'USERNAME',
					'label' => 'Tên đăng nhập',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Vui lòng nhập %s.',
					)
				),
				array(
					'field' => 'NEW_PASSWORD',
					'label' => 'Mật khẩu đăng nhập',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Vui lòng nhập %s.',
					)
				)
			);
		}
		else{
			$config = array(
				array(
					'field' => 'FULL_NAME',
					'label' => 'Tên người dùng',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Vui lòng nhập %s.',
					)
				)
			);
		}

		$this->form_validation->set_rules($config);
		
		$this->load->model('User', 'contentModel');
		$this->contentModel->loadinput_entry();
		if ($this->form_validation->run() == FALSE)
		{
			$data = array();
			$data['contentModel'] = $this->contentModel;
			$data['viewData'] = array('ACTION_EDIT' => $ACTION_EDIT);
			$data['content'] = 'admin/edituser';
			$this->load->view('admin/master_view', $data);
		}
		else
		{
					

			if($ACTION_EDIT == "false"){	
				$this->contentModel->insert_entry();
			}
			else{
				$this->contentModel->update_entry();
			}
			redirect('admin/manage/listuser-module-user', 'location');
		}
	}
	
	
	public function deleteuser($module){
		$id = $_GET['id'];		
		$this->db->where('USERNAME', $id);
		$this->db->where("IS_ADMIN !=", 1);
		$this->db->delete('hd_users');
		redirect('admin/manage/listuser-module-user', 'location');
	}
	
	//=============================
	
	
	public function infomations()
	{
		$langQuery = get_cookie("admin-language");

		$data = array('content'=>'admin/infomations');
		$contentModel = $this->db->query("SELECT * FROM hd_infomations a WHERE  a.LANGUAGE = '".$langQuery."' OR a.LANGUAGE = 'ALL'  ORDER BY SORT_INDEX ");
		$data["contentModel"] = $contentModel->result();
		$this->load->view('admin/master_view', $data);
	}
	
	public function saveinfomations(){
		$langQuery = get_cookie("admin-language");
		
		$this->db->trans_start();
		foreach($_POST as $key => $val)  
		{  			
			$this->db->query("UPDATE hd_infomations SET VAL_INFO = '".($this->input->post($key))."' WHERE KEY_INFO = '".$key."'");
		}  
		$this->db->trans_complete();
		
		$data = array('content'=>'admin/infomations');
		$contentModel = $this->db->query("SELECT * FROM hd_infomations ORDER BY SORT_INDEX ");
		$data["contentModel"] = $contentModel->result();
		if ($this->db->trans_status() === FALSE) $data["viewData"] = array('Failed' => "Lưu các thông tin không thành công !");
		else $data["viewData"] = array('Success' => "Lưu các thông tin thành công !");
		$this->load->view('admin/master_view', $data);
	}
	
	public function customcontact()
	{
		$data = array('content'=>'admin/customcontact');
		$this->load->library('pagination');
		$limitrec = 20;
		$per_page = $this->input->get("per_page");
		if(!isset($per_page) || $per_page == null) $per_page = 1;
		
		$condition = " WHERE 1 = 1 ";
		$viewtype = $this->input->get("viewtype");
		$datecreatedfrom = $this->input->get("datecreatedfrom");
		$datecreatedto = $this->input->get("datecreatedto");
		if(!isset($datecreatedto) || $datecreatedto == null) $datecreatedto = $datecreatedfrom;
		if(!isset($viewtype) || $viewtype == null || $viewtype == "all") $condition = $condition."";
		else $condition = $condition." AND STATUS_CONTACT = ".$viewtype;
		if(!isset($datecreatedfrom) || $datecreatedfrom == null) $condition = $condition."";
		else $condition = $condition." AND ( DATE_CREATED >= '".(date('Y-m-d', strtotime($datecreatedfrom)))." 00:00:00' AND DATE_CREATED <= '"
			.(date('Y-m-d', strtotime($datecreatedto)))." 23:59:59')";
		
		$searchq = $this->input->get("searchq");
		if(!isset($searchq) || $searchq == null) $searchq = "";
		else $condition = $condition." AND ( NAME_CONTACT like '%".$searchq."%' OR EMAIL_CONTACT like '%"
			.$searchq."%' OR PHONE_CONTACT like '%".$searchq."%' OR TITLE_CONTACT like '%".$searchq."%' OR CONTENT_CONTACT like '%".$searchq."%' )";
		
		$offsetSelect = ($per_page-1)*$limitrec;
		$queryCount = $this->db->query("SELECT count(*) TOTAL_REC FROM hd_contacts ".$condition);	
		$queryListContact = $this->db->query("SELECT * FROM hd_contacts ".$condition." ORDER BY STATUS_CONTACT, DATE_CREATED DESC
				LIMIT ".$offsetSelect." ,".$limitrec);

		$data['viewData'] = array('TOTAL_REC' => $queryCount->row()->TOTAL_REC);
		$data["contentModel"] = $queryListContact->result();
	 	$this->load->view('admin/master_view', $data);
	}
	
	public function markviewcontact(){
		$id = $this->input->get("id");
		$query = $this->db->query("UPDATE hd_contacts SET STATUS_CONTACT = 1 WHERE ID = ".$id);	
		
		$paramsQrs   = $_SERVER['QUERY_STRING'];
		parse_str($paramsQrs, $get_array);
		unset($get_array["id"]);
		$newParamQrs = http_build_query($get_array);
		redirect('admin/manage/customcontact-module-contact?'.$newParamQrs, 'location');
	}
	
	public function markunviewcontact(){
		$id = $this->input->get("id");
		$query = $this->db->query("UPDATE hd_contacts SET STATUS_CONTACT = 0 WHERE ID = ".$id);	
		
		$paramsQrs   = $_SERVER['QUERY_STRING'];
		parse_str($paramsQrs, $get_array);
		unset($get_array["id"]);
		$newParamQrs = http_build_query($get_array);
		redirect('admin/manage/customcontact-module-contact?'.$newParamQrs, 'location');
	}
	
	public function markreplycontact(){
		$id = $this->input->get("id");
		$query = $this->db->query("UPDATE hd_contacts SET STATUS_CONTACT = 2 WHERE ID = ".$id);	
		
		$paramsQrs   = $_SERVER['QUERY_STRING'];
		parse_str($paramsQrs, $get_array);
		unset($get_array["id"]);
		$newParamQrs = http_build_query($get_array);
		redirect('admin/manage/customcontact-module-contact?'.$newParamQrs, 'location');
	}
	
	//=============================
	
	public function elements($module)
	{		
		$langQuery = get_cookie("admin-language");
		
		$this->load->library('pagination');
		$limitrec = 20;
		$searchq = $this->input->get("searchq");
		$groupId = $this->input->get("groupId");
		$per_page = $this->input->get("per_page");
		if(!isset($per_page) || $per_page == null) $per_page = 1;
		$offsetSelect = ($per_page-1)*$limitrec;
		$queryModule = $this->db->query("SELECT * FROM hd_modules WHERE ID_MODULE ='".$module."' LIMIT 1");
		$data = array();
		$data['moduleAllowAction'] = $queryModule->row()->ALLOW_ACTION;
		$data['moduleName'] = $queryModule->row()->NAME_MD;
		$data['moduleID'] = $queryModule->row()->ID_MODULE;
		$data['moduleType'] = $queryModule->row()->TYPE_MD;
		switch($queryModule->row()->TYPE_MD){
			case "1":
			case "0":
				$filterQr = (isset($searchq) && $searchq != "") ? "  AND a.LANGUAGE = '".$langQuery."'  and NAME_AR like '%".$searchq."%' " : "   AND a.LANGUAGE = '".$langQuery."' ";
				if(isset($groupId) && $groupId != "") $filterQr = $filterQr." and GROUP_ID = ".$groupId." ";
				$data['content'] = 'admin/elementarticles';
				$queryCount = $this->db->query("SELECT count(*) TOTAL_REC FROM hd_articles a WHERE ID_MODULE ='".$module."'".$filterQr);		
				$data['viewData'] = array('TOTAL_REC' => $queryCount->row()->TOTAL_REC);
				$queryArticle = $this->db->query("SELECT a.*, g.NAME_GR FROM hd_articles a left join hd_groups g on a.GROUP_ID = g.ID_GR  WHERE a.ID_MODULE ='".$module."' ".$filterQr." ORDER BY SORT_INDEX, DATE_MODIFIED DESC, DATE_CREATED DESC LIMIT ".$offsetSelect." ,".$limitrec);
				
				$data['contentModel'] = $queryArticle->result();
				break;
			case "2":				
				$filterQr = (isset($searchq) && $searchq != "") ? "  AND a.LANGUAGE = '".$langQuery."'  and NAME_PRJ like '%".$searchq."%' " : "   AND a.LANGUAGE = '".$langQuery."' ";
				if(isset($groupId) && $groupId != "") $filterQr = $filterQr." and GROUP_ID = ".$groupId." ";
				$data['content'] = 'admin/elementprojects';
				$queryCount = $this->db->query("SELECT count(*) TOTAL_REC FROM hd_projects a WHERE ID_MODULE ='".$module."'".$filterQr);		
				$data['viewData'] = array('TOTAL_REC' => $queryCount->row()->TOTAL_REC);
				$query = $this->db->query("SELECT a.*, g.NAME_GR FROM hd_projects a left join hd_groups g on a.GROUP_ID = g.ID_GR  WHERE a.ID_MODULE ='".$module."' ".$filterQr." ORDER BY DATE_MODIFIED DESC, DATE_CREATED DESC LIMIT ".$offsetSelect." ,".$limitrec);
				$data['contentModel'] = $query->result();
				break;
			case "3":
			case "4":
				$filterQr = (isset($searchq) && $searchq != "") ? "  AND a.LANGUAGE = '".$langQuery."'  and NAME_IMG like '%".$searchq."%' " : "  AND a.LANGUAGE = '".$langQuery."'  ";
				if(isset($groupId) && $groupId != "") $filterQr = $filterQr." and GROUP_ID = ".$groupId." ";
				$data['content'] = 'admin/elementimages';
				$queryCount = $this->db->query("SELECT count(*) TOTAL_REC FROM hd_images a WHERE ID_MODULE ='".$module."'".$filterQr);		
				$data['viewData'] = array('TOTAL_REC' => $queryCount->row()->TOTAL_REC);
				$query = $this->db->query("SELECT a.*, g.NAME_GR FROM hd_images a left join hd_groups g on a.GROUP_ID = g.ID_GR  WHERE a.ID_MODULE ='".$module."' ".$filterQr." ORDER BY SORT_INDEX LIMIT ".$offsetSelect." ,".$limitrec);
				$data['contentModel'] = $query->result();
				break;
			case "5":
				$this->load->helper(array('form', 'url'));
				$data['content'] = 'admin/elementRedirectlink';
				break;
			default:
				break;
		}
		$this->load->view('admin/master_view', $data);
	}
	
	public function addarticle($module)
	{	
		$langQuery = get_cookie("admin-language");
		
		$this->load->model('Article', 'contentModel');
		$this->contentModel->ID_MODULE = $module;
		$this->contentModel->VISIBLE_AR = true;
		
		$queryModule = $this->db->query("SELECT * FROM hd_modules WHERE ID_MODULE ='".$module."' LIMIT 1");		
		$data = array();
		$data['moduleAllowAction'] = $queryModule->row()->ALLOW_ACTION;
		$data['moduleName'] = $queryModule->row()->NAME_MD;
		$data['moduleID'] = $queryModule->row()->ID_MODULE;
		$data['moduleType'] = $queryModule->row()->TYPE_MD;
		$data['moduleImageWidth'] = $queryModule->row()->IMAGE_WIDTH;
		$data['moduleImageHeight'] = $queryModule->row()->IMAGE_HEIGHT;
		$data['moduleImageRatio'] = $queryModule->row()->IMAGE_RATIO == 1 ? "true" : "false";
		$data['contentModel'] = $this->contentModel;
		$data['viewData'] = array('ACTION_EDIT' => "false");
		$data['content'] = 'admin/editarticle';
		$this->load->view('admin/master_view', $data);
	}
	
	public function modifyarticle($module)
	{	
		$langQuery = get_cookie("admin-language");
		
		$arid = $_GET['arid'];
		$this->load->model('Article', 'contentModel');
		$this->contentModel->ID_MODULE = $module;
		$queryGetArticleItem = $this->db->query("SELECT * FROM hd_articles WHERE ID_AR =".$arid." LIMIT 1");
		$this->contentModel->loadfromquery($queryGetArticleItem->row());
		
		$queryModule = $this->db->query("SELECT * FROM hd_modules WHERE ID_MODULE ='".$module."' LIMIT 1");		
		$data = array();
		$data['moduleAllowAction'] = $queryModule->row()->ALLOW_ACTION;
		$data['moduleName'] = $queryModule->row()->NAME_MD;
		$data['moduleID'] = $queryModule->row()->ID_MODULE;
		$data['moduleType'] = $queryModule->row()->TYPE_MD;
		$data['moduleImageWidth'] = $queryModule->row()->IMAGE_WIDTH;
		$data['moduleImageHeight'] = $queryModule->row()->IMAGE_HEIGHT;
		$data['moduleImageRatio'] = $queryModule->row()->IMAGE_RATIO == 1 ? "true" : "false";
		$data['contentModel'] = $this->contentModel;
		$data['viewData'] = array('ACTION_EDIT' => "true");
		$data['content'] = 'admin/editarticle';
		$this->load->view('admin/master_view', $data);
	}
	
	public function savearticle($module){		
		$langQuery = get_cookie("admin-language");
			
		$NEW_AFTER_SAVE_ARTICLE = $this->input->post('NEW_AFTER_SAVE_ARTICLE');
		$IMAGE_ARTICLE_UPLOAD = $this->input->post('IMAGE_ARTICLE_UPLOAD');
		$page = $this->input->post('page');		
		$ACTION_EDIT = $this->input->post('ACTION_EDIT');
		$oldImagePath = "";
		if($ACTION_EDIT == "true") $oldImagePath = $this->input->post('IMAGE_AR');		
		$ImageFileName = "";
		
		
		$config = array(
			array(
				'field' => 'NAME_AR',
				'label' => 'Tên bài viết',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Vui lòng nhập %s.',
                )
			)
		);

		$queryModule = $this->db->query("SELECT * FROM hd_modules WHERE ID_MODULE ='".$module."' LIMIT 1");	
		$this->form_validation->set_rules($config);
		
		$this->load->model('Article', 'contentModel');
		$this->contentModel->loadinput_entry();
		if ($this->form_validation->run() == FALSE)
		{
			$this->contentModel->IMAGE_AR = $IMAGE_ARTICLE_UPLOAD;
			$data = array();
			$data['moduleAllowAction'] = $queryModule->row()->ALLOW_ACTION;
			$data['moduleName'] = $queryModule->row()->NAME_MD;
			$data['moduleID'] = $queryModule->row()->ID_MODULE;
			$data['moduleType'] = $queryModule->row()->TYPE_MD;
			$data['moduleImageWidth'] = $queryModule->row()->IMAGE_WIDTH;
			$data['moduleImageHeight'] = $queryModule->row()->IMAGE_HEIGHT;
			$data['moduleImageRatio'] = $queryModule->row()->IMAGE_RATIO == 1 ? "true" : "false";
			$data['contentModel'] = $this->contentModel;
			$data['viewData'] = array('ACTION_EDIT' => $ACTION_EDIT);
			$data['content'] = 'admin/editarticle';
			$this->load->view('admin/master_view', $data);
		}
		else
		{
			if (isset($IMAGE_ARTICLE_UPLOAD) && $IMAGE_ARTICLE_UPLOAD != "" && (strpos($IMAGE_ARTICLE_UPLOAD, 'data:image/png;base64') !== false 
					|| strpos($IMAGE_ARTICLE_UPLOAD, 'data:image/jpeg;base64') !== false || strpos($IMAGE_ARTICLE_UPLOAD, 'data:image/gif;base64') !== false))
			{
				$fileType = ".jpg";
				if (strpos($IMAGE_ARTICLE_UPLOAD, 'data:image/png;base64') !== false) {
					$fileType = ".png";
				}
				if (strpos($IMAGE_ARTICLE_UPLOAD, 'data:image/gif;base64') !== false) {
					$fileType = ".gif";
				}
				$ImageFileName = friendlyName($this->contentModel->NAME_AR).date('YmdHis').$fileType;
				$success = saveBase64Png($ImageFileName, $IMAGE_ARTICLE_UPLOAD);
				if($success){
					$this->contentModel->IMAGE_AR = "imagesUpload/".$ImageFileName;
					unlink($oldImagePath);
				}
			}
			else{
				$this->contentModel->IMAGE_AR = $oldImagePath;
			}
			

			if($ACTION_EDIT == "false"){				
				if($queryModule->row()->TYPE_MD == 0){
					$querySortIndex = $this->db->query("SELECT MAX(SORT_INDEX) MAX_SORT_INDEX FROM hd_articles WHERE ID_MODULE ='".$module."' AND a.LANGUAGE = '".$langQuery."' ");
					if($querySortIndex->row()->MAX_SORT_INDEX == null) $this->contentModel->SORT_INDEX = 0;
					$this->contentModel->SORT_INDEX = ((int)$querySortIndex->row()->MAX_SORT_INDEX)+1;
				}
				$this->contentModel->USER_CREATED = $this->session->fullname.'('.$this->session->username.')';
				$this->contentModel->LANGUAGE = $langQuery;
				$this->contentModel->insert_entry();
			}
			else{
				$this->contentModel->USER_MODIFIED = $this->session->fullname.'('.$this->session->username.')';
				$this->contentModel->LANGUAGE = $langQuery;
				$this->contentModel->update_entry();
			}
			redirect('admin/manage/elements-module-'.$module, 'location');
		}
	}
	
	
	public function deletearticle($module){
		$arid = $_GET['arid'];		
		$fileDetete = $this->db->query("SELECT IMAGE_AR FROM hd_articles WHERE ID =".$arid);
		$this->db->where('ID_AR', $arid);
		$this->db->delete('hd_articles');
		if($this->db->affected_rows() > 0) unlink($fileDetete->row()->IMAGE_AR);
		redirect('admin/manage/elements-module-'.$module, 'location');
	}
	
	public function tooglevisiblearticle(){
		$arid = $this->input->post("arid");
		$visible = $this->input->post("visible");
		$this->db->query("UPDATE hd_articles SET VISIBLE_AR = ".$visible." WHERE ID_AR = ".$arid);
		$arr = array();
		if($this->db->affected_rows() > 0)  $arr['success'] = true;
		else  $arr['success'] = false;
		//add the header here 
		header('Content-Type: application/json');
		echo json_encode( $arr );
	}
	
	public function tooglepriorityarticle(){
		$arid = $this->input->post("arid");
		$priority = $this->input->post("priority");
		$this->db->query("UPDATE hd_articles SET PRIORITY = ".$priority." WHERE ID_AR = ".$arid);
		$arr = array();
		if($this->db->affected_rows() > 0)  $arr['success'] = true;
		else  $arr['success'] = false;
		//add the header here 
		header('Content-Type: application/json');
		echo json_encode( $arr );
	}
	
	public function sortarticle($module){
		$langQuery = get_cookie("admin-language");
		
		$currentpage = $this->input->post("currentpage");
		$items = $this->input->post("items");
		$this->db->trans_start();
		for ($i = 0; $i < count($items); $i++) {			
			if($items[$i] == "") continue;
			$this->db->query("UPDATE hd_articles SET SORT_INDEX = ".(($currentpage-1)*20+$i)." WHERE ID_AR = ".$items[$i]);
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			$arr['success'] = false;
		} else $arr['success'] = true;
		
		header('Content-Type: application/json');
		echo json_encode( $arr );
	}
	
	//=====================================
	
	public function addproject($module)
	{	
		$langQuery = get_cookie("admin-language");
		
		$this->load->model('Project', 'contentModel');
		$this->contentModel->ID_MODULE = $module;
		$this->contentModel->VISIBLE_PRJ = true;
		$this->contentModel->GROUP_ID = $this->session->lastprojectcat;
		
		$queryModule = $this->db->query("SELECT * FROM hd_modules WHERE ID_MODULE ='".$module."' LIMIT 1");		
		$data = array();
		$data['moduleAllowAction'] = $queryModule->row()->ALLOW_ACTION;
		$data['moduleName'] = $queryModule->row()->NAME_MD;
		$data['moduleID'] = $queryModule->row()->ID_MODULE;
		$data['moduleType'] = $queryModule->row()->TYPE_MD;
		$data['moduleImageWidth'] = $queryModule->row()->IMAGE_WIDTH;
		$data['moduleImageHeight'] = $queryModule->row()->IMAGE_HEIGHT;
		$data['moduleImageRatio'] = $queryModule->row()->IMAGE_RATIO == 1 ? "true" : "false";
		$data['contentModel'] = $this->contentModel;
		$data['viewData'] = array('ACTION_EDIT' => "false");
		$data['content'] = 'admin/editproject';
		$this->load->view('admin/master_view', $data);
	}
	
	public function modifyproject($module)
	{	
		$langQuery = get_cookie("admin-language");
		
		$id = $_GET['id'];
		$this->load->model('Project', 'contentModel');
		$this->contentModel->ID_MODULE = $module;
		$queryGetArticleItem = $this->db->query("SELECT * FROM hd_projects WHERE ID_PRJ =".$id." LIMIT 1");
		$this->contentModel->loadfromquery($queryGetArticleItem->row());
		
		$queryModule = $this->db->query("SELECT * FROM hd_modules WHERE ID_MODULE ='".$module."' LIMIT 1");		
		$data = array();
		$data['moduleAllowAction'] = $queryModule->row()->ALLOW_ACTION;
		$data['moduleName'] = $queryModule->row()->NAME_MD;
		$data['moduleID'] = $queryModule->row()->ID_MODULE;
		$data['moduleType'] = $queryModule->row()->TYPE_MD;
		$data['moduleImageWidth'] = $queryModule->row()->IMAGE_WIDTH;
		$data['moduleImageHeight'] = $queryModule->row()->IMAGE_HEIGHT;
		$data['moduleImageRatio'] = $queryModule->row()->IMAGE_RATIO == 1 ? "true" : "false";
		$data['contentModel'] = $this->contentModel;
		$data['viewData'] = array('ACTION_EDIT' => "true");
		$data['content'] = 'admin/editproject';
		$this->load->view('admin/master_view', $data);
	}
	
	public function tooglevisibleproject(){
		$id = $this->input->post("id");
		$visible = $this->input->post("visible");
		$this->db->query("UPDATE hd_projects SET VISIBLE_PRJ = ".$visible." WHERE ID_PRJ = ".$id);
		$arr = array();
		if($this->db->affected_rows() > 0)  $arr['success'] = true;
		else  $arr['success'] = false;
		//add the header here 
		header('Content-Type: application/json');
		echo json_encode( $arr );
	}
	
	
	public function tooglepriorityproject(){
		$arid = $this->input->post("arid");
		$priority = $this->input->post("priority");
		$this->db->query("UPDATE hd_projects SET PRIORITY = ".$priority." WHERE ID_PRJ = ".$arid);
		$arr = array();
		if($this->db->affected_rows() > 0)  $arr['success'] = true;
		else  $arr['success'] = false;
		//add the header here 
		header('Content-Type: application/json');
		echo json_encode( $arr );
	}
	
	
	public function saveproject($module){		
		$langQuery = get_cookie("admin-language");
			
		$NEW_AFTER_SAVE_ARTICLE = $this->input->post('NEW_AFTER_SAVE_ARTICLE');
		$IMAGE_ARTICLE_UPLOAD = $this->input->post('IMAGE_ARTICLE_UPLOAD');
		$page = $this->input->post('page');		
		$ACTION_EDIT = $this->input->post('ACTION_EDIT');
		$oldImagePath = "";
		if($ACTION_EDIT == "true") $oldImagePath = $this->input->post('IMAGE_PRJ');		
		$ImageFileName = "";
		
		
		$config = array(
			array(
				'field' => 'NAME_PRJ',
				'label' => 'Tên sản phẩm/dự án',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Vui lòng nhập %s.',
                )
			),
			array(
				'field' => 'HOST_PRJ',
				'label' => 'Chủ đầu tư',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Vui lòng nhập %s.',
                )
			),
			array(
				'field' => 'LOCATION_PRJ',
				'label' => 'Địa điểm thi công',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Vui lòng nhập %s.',
                )
			),
			array(
				'field' => 'YEAR_PRJ',
				'label' => 'Ngày khởi công',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Vui lòng nhập %s.',
                )
			)
		);

		$queryModule = $this->db->query("SELECT * FROM hd_modules WHERE ID_MODULE ='".$module."' LIMIT 1");	
		$this->form_validation->set_rules($config);
		
		$this->load->model('Project', 'contentModel');
		$this->contentModel->loadinput_entry();
		if ($this->form_validation->run() == FALSE)
		{
			$this->contentModel->IMAGE_PRJ = $IMAGE_ARTICLE_UPLOAD;
			$data = array();
			$data['moduleAllowAction'] = $queryModule->row()->ALLOW_ACTION;
			$data['moduleName'] = $queryModule->row()->NAME_MD;
			$data['moduleID'] = $queryModule->row()->ID_MODULE;
			$data['moduleType'] = $queryModule->row()->TYPE_MD;
			$data['moduleImageWidth'] = $queryModule->row()->IMAGE_WIDTH;
			$data['moduleImageHeight'] = $queryModule->row()->IMAGE_HEIGHT;
			$data['moduleImageRatio'] = $queryModule->row()->IMAGE_RATIO == 1 ? "true" : "false";
			$data['contentModel'] = $this->contentModel;
			$data['viewData'] = array('ACTION_EDIT' => $ACTION_EDIT);
			$data['content'] = 'admin/editproject';
			$this->load->view('admin/master_view', $data);
		}
		else
		{
			if (isset($IMAGE_ARTICLE_UPLOAD) && $IMAGE_ARTICLE_UPLOAD != "" && (strpos($IMAGE_ARTICLE_UPLOAD, 'data:image/png;base64') !== false 
					|| strpos($IMAGE_ARTICLE_UPLOAD, 'data:image/jpeg;base64') !== false || strpos($IMAGE_ARTICLE_UPLOAD, 'data:image/gif;base64') !== false))
			{
				$fileType = ".jpg";
				if (strpos($IMAGE_ARTICLE_UPLOAD, 'data:image/png;base64') !== false) {
					$fileType = ".png";
				}
				if (strpos($IMAGE_ARTICLE_UPLOAD, 'data:image/gif;base64') !== false) {
					$fileType = ".gif";
				}
				$ImageFileName = friendlyName($this->contentModel->NAME_PRJ).date('YmdHis').$fileType;
				$success = saveBase64Png($ImageFileName, $IMAGE_ARTICLE_UPLOAD, "ProjectsPhotos");
				if($success){
					$this->contentModel->IMAGE_PRJ = "imagesUpload/ProjectsPhotos/".$ImageFileName;
					unlink($oldImagePath);
				}
			}
			else{
				$this->contentModel->IMAGE_PRJ = $oldImagePath;
			}
			
			$this->session->set_userdata(array("lastprojectcat" => $this->input->post("GROUP_ID")));
			
			if($ACTION_EDIT == "false"){				
				
				$this->contentModel->USER_CREATED = $this->session->fullname.'('.$this->session->username.')';
				$this->contentModel->LANGUAGE = $langQuery;
				$this->contentModel->insert_entry();
				
				$insert_id = $this->db->insert_id();	
				redirect('admin/manage/modifyproject-module-'.$module."?id=".$insert_id, 'location');
			}
			else{
				$this->contentModel->USER_MODIFIED = $this->session->fullname.'('.$this->session->username.')';
				$this->contentModel->LANGUAGE = $langQuery;
				$this->contentModel->update_entry();
				redirect('admin/manage/elements-module-'.$module, 'location');
			}
		}
	}
	
	
	public function deleteproject($module){
		$id = $_GET['id'];		
		$fileDetete = $this->db->query("SELECT IMAGE_PRJ FROM hd_projects WHERE ID_PRJ =".$id);
		$fileImageListDetete = $this->db->query("SELECT ID, IMAGE_URL FROM hd_images WHERE ID_MODULE ='".$module."_ref_".$id."' AND REF_ID = ".$id." ");
		
		$this->db->trans_start();
		$this->db->where('ID_PRJ', $id);
		$this->db->delete('hd_projects');
		$fileDelOnDisk = array();
		foreach($fileImageListDetete->result() as $imagedetailDel){
			$this->db->where('ID', $imagedetailDel->ID);
			$this->db->delete('hd_images');
			array_push($fileDelOnDisk, $imagedetailDel->IMAGE_URL);
		}
		
		$this->db->trans_complete();
		
		if ($this->db->trans_status() === TRUE){
			unlink($fileDetete->row()->IMAGE_PRJ);
			foreach($fileDelOnDisk as $imagedetailDelonDisk){
				unlink($imagedetailDelonDisk);
			}
		}
		redirect('admin/manage/elements-module-'.$module, 'location');
	}
	
	
	//==============================
	
	public function addimage($module)
	{	
		$langQuery = get_cookie("admin-language");
		
		$this->load->model('Image', 'contentModel');
		$this->contentModel->ID_MODULE = $module;
		$this->contentModel->VISIBLE_IMG = true;
		
		$queryModule = $this->db->query("SELECT * FROM hd_modules WHERE ID_MODULE ='".$module."' LIMIT 1");		
		$data = array();
		$data['moduleAllowAction'] = $queryModule->row()->ALLOW_ACTION;
		$data['moduleName'] = $queryModule->row()->NAME_MD;
		$data['moduleID'] = $queryModule->row()->ID_MODULE;
		$data['moduleType'] = $queryModule->row()->TYPE_MD;
		$data['moduleImageWidth'] = $queryModule->row()->IMAGE_WIDTH;
		$data['moduleImageHeight'] = $queryModule->row()->IMAGE_HEIGHT;
		$data['moduleImageRatio'] = $queryModule->row()->IMAGE_RATIO == 1 ? "true" : "false";
		$data['contentModel'] = $this->contentModel;
		$data['viewData'] = array('ACTION_EDIT' => "false");
		$data['content'] = 'admin/editimage';
		$this->load->view('admin/master_view', $data);
	}
	
	public function modifyimage($module)
	{	
		$langQuery = get_cookie("admin-language");
		
		$id = $_GET['id'];
		$this->load->model('Image', 'contentModel');
		$this->contentModel->ID_MODULE = $module;
		$queryGetArticleItem = $this->db->query("SELECT * FROM hd_images WHERE ID =".$id." LIMIT 1");
		$this->contentModel->loadfromquery($queryGetArticleItem->row());
		
		$queryModule = $this->db->query("SELECT * FROM hd_modules WHERE ID_MODULE ='".$module."' LIMIT 1");		
		$data = array();
		$data['moduleAllowAction'] = $queryModule->row()->ALLOW_ACTION;
		$data['moduleName'] = $queryModule->row()->NAME_MD;
		$data['moduleID'] = $queryModule->row()->ID_MODULE;
		$data['moduleType'] = $queryModule->row()->TYPE_MD;
		$data['moduleImageWidth'] = $queryModule->row()->IMAGE_WIDTH;
		$data['moduleImageHeight'] = $queryModule->row()->IMAGE_HEIGHT;
		$data['moduleImageRatio'] = $queryModule->row()->IMAGE_RATIO == 1 ? "true" : "false";
		$data['contentModel'] = $this->contentModel;
		$data['viewData'] = array('ACTION_EDIT' => "true");
		$data['content'] = 'admin/editimage';
		$this->load->view('admin/master_view', $data);
	}
	
	public function deleteimage($module){
		$id = $_GET['id'];
		$fileDetete = $this->db->query("SELECT IMAGE_URL FROM hd_images WHERE ID =".$id);
		$fileImageListDetete = $this->db->query("SELECT ID, IMAGE_URL FROM hd_images WHERE ID_MODULE ='".$module."_ref_".$id."' AND REF_ID = ".$id." ");
		
		$this->db->trans_start();
		$this->db->where('ID', $id);
		$this->db->delete('hd_images');
		$fileDelOnDisk = array();
		foreach($fileImageListDetete->result() as $imagedetailDel){
			$this->db->where('ID', $imagedetailDel->ID);
			$this->db->delete('hd_images');
			array_push($fileDelOnDisk, $imagedetailDel->IMAGE_URL);
		}
		
		$this->db->trans_complete();
		
		if ($this->db->trans_status() === TRUE){
			unlink($fileDetete->row()->IMAGE_URL);
			foreach($fileDelOnDisk as $imagedetailDelonDisk){
				unlink($imagedetailDelonDisk);
			}
		}
		redirect('admin/manage/elements-module-'.$module, 'location');
	}
	
	public function saveimage($module){	
		$langQuery = get_cookie("admin-language");
				
		$NEW_AFTER_SAVE_ARTICLE = $this->input->post('NEW_AFTER_SAVE_ARTICLE');
		$IMAGE_ARTICLE_UPLOAD = $this->input->post('IMAGE_ARTICLE_UPLOAD');
		$page = $this->input->post('page');		
		$ACTION_EDIT = $this->input->post('ACTION_EDIT');
		$oldImagePath = "";
		if($ACTION_EDIT == "true") $oldImagePath = $this->input->post('IMAGE_URL');		
		$ImageFileName = "";
		
		
		$config = array(
			array(
				'field' => 'NAME_IMG',
				'label' => 'Tên đối tượng',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Vui lòng nhập %s.',
                )
			)
		);

		$queryModule = $this->db->query("SELECT * FROM hd_modules WHERE ID_MODULE ='".$module."' LIMIT 1");	
		$this->form_validation->set_rules($config);
		
		$this->load->model('Image', 'contentModel');
		$this->contentModel->loadinput_entry();
		if ($this->form_validation->run() == FALSE)
		{
			$this->contentModel->IMAGE_URL = $IMAGE_ARTICLE_UPLOAD;
			$data = array();
			$data['moduleAllowAction'] = $queryModule->row()->ALLOW_ACTION;
			$data['moduleName'] = $queryModule->row()->NAME_MD;
			$data['moduleID'] = $queryModule->row()->ID_MODULE;
			$data['moduleType'] = $queryModule->row()->TYPE_MD;
			$data['moduleImageWidth'] = $queryModule->row()->IMAGE_WIDTH;
			$data['moduleImageHeight'] = $queryModule->row()->IMAGE_HEIGHT;
			$data['moduleImageRatio'] = $queryModule->row()->IMAGE_RATIO == 1 ? "true" : "false";
			$data['contentModel'] = $this->contentModel;
			$data['viewData'] = array('ACTION_EDIT' => $ACTION_EDIT);
			$data['content'] = 'admin/editimage';
			$this->load->view('admin/master_view', $data);
		}
		else
		{
			if (isset($IMAGE_ARTICLE_UPLOAD) && $IMAGE_ARTICLE_UPLOAD != "" && (strpos($IMAGE_ARTICLE_UPLOAD, 'data:image/png;base64') !== false 
					|| strpos($IMAGE_ARTICLE_UPLOAD, 'data:image/jpeg;base64') !== false || strpos($IMAGE_ARTICLE_UPLOAD, 'data:image/gif;base64') !== false))
			{
				$fileType = ".jpg";
				if (strpos($IMAGE_ARTICLE_UPLOAD, 'data:image/png;base64') !== false) {
					$fileType = ".png";
				}
				if (strpos($IMAGE_ARTICLE_UPLOAD, 'data:image/gif;base64') !== false) {
					$fileType = ".gif";
				}
				$ImageFileName = friendlyName($this->contentModel->NAME_IMG).date('YmdHis').$fileType;
				$success = saveBase64Png($ImageFileName, $IMAGE_ARTICLE_UPLOAD);
				if($success){
					$this->contentModel->IMAGE_URL = "imagesUpload/".$ImageFileName;
					unlink($oldImagePath);
				}
			}
			else{
				$this->contentModel->IMAGE_URL = $oldImagePath;
			}
			

			if($ACTION_EDIT == "false"){				
				
				$this->contentModel->USER_CREATED = $this->session->fullname.'('.$this->session->username.')';
				$this->contentModel->LANGUAGE = $langQuery;
				$this->contentModel->insert_entry();	
				$insert_id = $this->db->insert_id();				
				redirect('admin/manage/modifyimage-module-'.$module."?id=".$insert_id, 'location');
			}
			else{
				$this->contentModel->USER_MODIFIED = $this->session->fullname.'('.$this->session->username.')';
				$this->contentModel->LANGUAGE = $langQuery;
				$this->contentModel->update_entry();
				redirect('admin/manage/elements-module-'.$module, 'location');
			}
		}
	}
	
	
	public function sortimage($module){
		$langQuery = get_cookie("admin-language");
		
		$items = $this->input->post("items");
		$this->db->trans_start();
		for ($i = 0; $i < count($items); $i++) {
			if($items[$i] == "") continue;
			$this->db->query("UPDATE hd_images SET SORT_INDEX = ".($i+1)." WHERE ID = ".$items[$i]);
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			$arr['success'] = false;
		} else $arr['success'] = true;
		
		header('Content-Type: application/json');
		echo json_encode( $arr );
	}
	
	
	public function tooglevisibleimage(){
		$id = $this->input->post("id");
		$visible = $this->input->post("visible");
		$this->db->query("UPDATE hd_images SET VISIBLE_IMG = ".$visible." WHERE ID = ".$id);
		$arr = array();
		if($this->db->affected_rows() > 0)  $arr['success'] = true;
		else  $arr['success'] = false;
		//add the header here 
		header('Content-Type: application/json');
		echo json_encode( $arr );
	}
	
	
	
	public function dropzoneupload($module){
		$uploadDir = 'imagesUpload/ActivitiesPhotos';
		
		if (!empty($_FILES)) {
			$tmpFile = $_FILES['file']['tmp_name'];
			$filename = $uploadDir.'/'.time().'-'. $_FILES['file']['name'];
			
			$this->load->model('Image', 'contentModel');
			$this->contentModel->NAME_IMG = "";
			$this->contentModel->REF_ID = $this->input->get("id");
			$this->contentModel->IMAGE_URL = $filename;
			$this->contentModel->ID_MODULE = $module."_ref_".$this->input->get("id");
			$this->contentModel->DATE_CREATED = date('Y-m-d H:i:s');
			$this->contentModel->USER_CREATED = $this->session->fullname.'('.$this->session->username.')';
			$this->db->insert('hd_images', $this->contentModel);
			
			move_uploaded_file($tmpFile, $filename);
		} 
		
		
	}
	
	public function deleteimagedetail($module){
		$id = $_GET['id'];
		$refid = $_GET['refid'];
		$fileDetete = $this->db->query("SELECT IMAGE_URL FROM hd_images WHERE ID =".$id);
		$this->db->where('ID', $id);
		$this->db->delete('hd_images');
		if($this->db->affected_rows() > 0) unlink($fileDetete->row()->IMAGE_URL);
		
		redirect('admin/manage/modifyimage-module-'.$module."?id=".$refid, 'location');
	}
	
	public function deleteimageprjdetail($module){
		$id = $_GET['id'];
		$refid = $_GET['refid'];
		$fileDetete = $this->db->query("SELECT IMAGE_URL FROM hd_images WHERE ID =".$id);
		$this->db->where('ID', $id);
		$this->db->delete('hd_images');
		if($this->db->affected_rows() > 0) unlink($fileDetete->row()->IMAGE_URL);
		
		redirect('admin/manage/modifyproject-module-'.$module."?id=".$refid, 'location');
	}
	//==============================
	
	public function listgroups($module){
		$langQuery = get_cookie("admin-language");
		
		$queryGroup = $this->db->query("SELECT * FROM hd_groups WHERE ID_MODULE ='".$module."'  AND LANGUAGE = '".$langQuery."'  ORDER BY SORT_INDEX");
		$this->load->view("listGroup", array("ListGroupModel" => $queryGroup->result(), "moduleListGroup" => $module));
	}
	
	public function creategroup($module){
		$langQuery = get_cookie("admin-language");
		
		$moduleLoad = $this->input->post("moduleLoad");
		$groupId = $this->input->post("id");
		if(isset($groupId) && $groupId != ""){
			$queryGroup = $this->db->query("SELECT * FROM hd_groups WHERE ID_GR ='".$groupId."'");
			$dataAddGroup = array(
				"addGroupAction" => "UPDATE", 
				"addGroupId" => $groupId ,
				"addGroupName" => $queryGroup->row()->NAME_GR,
				"addGroupDesc" => $queryGroup->row()->DESC_GR,
				"addGroupSortIndex" => $queryGroup->row()->SORT_INDEX,
				"addGroupVisibleGroup" => ($queryGroup->row()->VISIBLE_GR == 1) ? "true" : "false",
				"addGroupNewAfterSave" => "false"
			);
		}
		else{
			$dataAddGroup = array(
				"addGroupAction" => "ADD", 
				"addGroupId" => "",
				"addGroupName" => "",
				"addGroupDesc" => "",
				"addGroupSortIndex" => "",
				"addGroupVisibleGroup" => "true",
				"addGroupNewAfterSave" => "true"
			);
		}
		$this->load->view("addGroup", $dataAddGroup);
	}
	
	
	public function savegroup($module){
		$langQuery = get_cookie("admin-language");
		
		$addGroupNewAfterSave = $this->input->post('GROUP_NEW_AFTER_SAVE');
		$ACTION_EDIT = $this->input->post('ACTION');	
				
		$config = array(
			array(
				'field' => 'NAME_GR',
				'label' => 'Tên nhóm/ danh mục',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Vui lòng nhập %s.',
                )
			)
		);

		$queryModule = $this->db->query("SELECT * FROM hd_modules WHERE ID_MODULE ='".$module."' LIMIT 1");	
		$this->form_validation->set_rules($config);
		
		$this->load->model('Group', 'groupModel');
		$this->groupModel->loadinput_entry();
		if ($this->form_validation->run() == FALSE)
		{
			$dataAddGroup = array(
				"addGroupAction" => $ACTION_EDIT, 
				"addGroupId" => $this->groupModel->ID_GR ,
				"addGroupName" => $this->groupModel->NAME_GR,
				"addGroupDesc" => $this->groupModel->DESC_GR,
				"addGroupSortIndex" =>  $this->groupModel->SORT_INDEX,
				"addGroupVisibleGroup" => ($this->groupModel->VISIBLE_GR == 1) ? "true" : "false",
				"addGroupNewAfterSave" => ($addGroupNewAfterSave == 1) ? "true" : "false"
			);
			$this->load->view('addGroup', $dataAddGroup);
		}
		else
		{
			if($ACTION_EDIT == "ADD"){				
				$querySortIndex = $this->db->query("SELECT MAX(SORT_INDEX) MAX_SORT_INDEX FROM hd_groups WHERE ID_MODULE ='".$module."' AND LANGUAGE = '".$langQuery."' ");
				if($querySortIndex->row()->MAX_SORT_INDEX == null) $this->groupModel->SORT_INDEX = 0;
				$this->groupModel->SORT_INDEX = ((int)$querySortIndex->row()->MAX_SORT_INDEX)+1;
				$this->contentModel->LANGUAGE = $langQuery;
				
				$this->groupModel->insert_entry();
			}
			else{
				$this->contentModel->LANGUAGE = $langQuery;
				$this->groupModel->update_entry();
				$this->groupModel->ID_GR = $this->input->post('ID_GR');;
			}
			
			$dataAddGroup = array(
				"addGroupAction" =>  ($addGroupNewAfterSave == 1) ? "ADD" : "UPDATE", 
				"addGroupId" => ($addGroupNewAfterSave == 1) ? "" : $this->groupModel->ID_GR ,
				"addGroupName" => ($addGroupNewAfterSave == 1) ? "" : $this->groupModel->NAME_GR,
				"addGroupDesc" => ($addGroupNewAfterSave == 1) ? "" : $this->groupModel->DESC_GR,
				"addGroupSortIndex" =>  ($addGroupNewAfterSave == 1) ? "" : $this->groupModel->SORT_INDEX,
				"addGroupVisibleGroup" => ($addGroupNewAfterSave == 1) ? "true" : (($this->groupModel->VISIBLE_GR == 1) ? "true" : "false"),
				"addGroupNewAfterSave" => ($addGroupNewAfterSave == 1) ? "true" : "false"
			);
			$this->load->view('addGroup', $dataAddGroup);
		}
	}
	
	public function deletegroup($module){
		$groupId = $this->input->post("id");
		$this->db->where('ID_GR', $groupId);
		$this->db->delete('hd_groups');
		
		header('Content-Type: application/json');
		echo json_encode( array("success" => true ) );
	}
	
	public function tooglevisiblegroup(){
		$groupId = $this->input->post("groupId");
		$visible = $this->input->post("visible");
		$this->db->query("UPDATE hd_groups SET VISIBLE_GR = ".$visible." WHERE ID_GR = ".$groupId);
		$arr = array();
		if($this->db->affected_rows() > 0)  $arr['success'] = true;
		else  $arr['success'] = false;
		//add the header here 
		header('Content-Type: application/json');
		echo json_encode( $arr );
	}
	
	public function sortgroup($module){
		$langQuery = get_cookie("admin-language");
		
		$items = $this->input->post("items");
		$this->db->trans_start();
		for ($i = 0; $i < count($items); $i++) {
			if($items[$i] == "") continue;
			$this->db->query("UPDATE hd_groups SET SORT_INDEX = ".($i+1)." WHERE ID_GR = ".$items[$i]);
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			$arr['success'] = false;
		} else $arr['success'] = true;
		
		header('Content-Type: application/json');
		echo json_encode( $arr );
	}


	public function do_upload_file()
	{
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 100;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('userfile'))
			{
					$error = array('error' => $this->upload->display_errors());
					$this->load->helper(array('form', 'url'));
					$data['content'] = 'admin/elementRedirectlink';
			}
			else
			{
					$data = array('upload_data' => $this->upload->data());
					$this->load->helper(array('form', 'url'));
					$data['content'] = 'admin/elementRedirectlink';
			}
	}
}









