<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('cookie');
		$this->load->helper('url');
		$this->load->database();
		$this->load->library('user_agent');
		$this->load->helper('counter');

		if($this->input->cookie('language') == null || $this->input->cookie('language') == ''){			
			$cookie = array(
				'name'   => 'language',
				'value'  => 'vi',                            
				'expire' => 86400*30,                                                                                   
				'secure' => FALSE
			);
			$this->input->set_cookie($cookie);
		}
		
		$querysiteActive = $this->db->query("SELECT KEY_INFO, VAL_INFO FROM hd_infomations WHERE KEY_INFO = 'stopwebsite'");
	    if($querysiteActive->row()->VAL_INFO == "0" && $this->router->fetch_method() != "stopsite") {
			 redirect('page/stopsite', 'location');
		} 
	}

	public function changelang($language){	
		$cookie = array(
			'name'   => 'language',
			'value'  => $language,                            
			'expire' => 86400*30,                                                                                   
			'secure' => FALSE
		);
		$this->input->set_cookie($cookie);
		redirect('home', 'location');
	}
	
	public function imagethumbnail(){
		$imageurl = $this->input->get("imageurl");
		$width = $this->input->get("width");
		$height = $this->input->get("height");
		switch ( strtolower( pathinfo( $imageurl, PATHINFO_EXTENSION ))) {
			case 'jpeg':
			case 'jpg':
				imagejpeg(imagescale(imagecreatefromjpeg($imageurl), $width));
			break;

			case 'png':
				imagepng(imagescale(imagecreatefrompng($imageurl), $width));
			break;

			case 'gif':
				imagegif(imagescale(imagecreatefromgif($imageurl), $width));
			break;

			default:
				throw new InvalidArgumentException('File is not valid jpg, png or gif image.');
			break;
		}
		//imagejpeg(imagescale(imagecreatefrompng($imageurl), $width));
	}
	
	public function index()
	{
		$data = array('content'=>'home/home');
		$this->load->view('home/master_view', $data);
		//$this->load->view('home/stopsite');
	}
	
	public function stopsite()
	{
		$querysiteActive = $this->db->query("SELECT KEY_INFO, VAL_INFO FROM hd_infomations WHERE KEY_INFO = 'stopwebsite'");
	    if($querysiteActive->row()->VAL_INFO == "1") {
			 redirect('', 'location');
		} 
		$this->load->view('home/stopsite');
	}
	
	public function listarticles($module)
	{

		$queryModule = $this->db->query("SELECT * FROM hd_modules WHERE ID_MODULE ='".$module."' LIMIT 1");

		if(get_cookie("language") == "en") { $data['module'] = $queryModule->row()->En_US; $langQuery = 'En-US';}
		else { $data['module'] = $queryModule->row()->Vi_VN; $langQuery = 'Vi-VN';}

		if(get_cookie("language") == "en") { $data['langQuery'] = 'En-US'; }
		else { $data['langQuery'] = 'Vi-VN'; }

		$queryArticles = $this->db->query("SELECT * FROM hd_articles WHERE ID_MODULE = '.$module.' AND LANGUAGE = '".$langQuery."' ");
		$resultData = $queryArticles->result();

		if($queryModule->row()->TYPE_MD == '0'){
			$queryArticle = $this->db->query("SELECT * FROM hd_articles WHERE ID_MODULE ='".$module."' AND LANGUAGE = '".$langQuery."'  ORDER BY SORT_INDEX LIMIT 1");
			$data = array('content'=>'home/detailarticle');	
			$data['articleModel'] = $queryArticle->row();
			
			
			$data['og_Title'] = $queryArticle->row()->NAME_AR;
			$data['og_Desc'] = $queryArticle->row()->DESC_AR;
			$data['og_Image'] = $queryArticle->row()->IMAGE_AR;
		}
		else{
			$data = array('content'=>'home/listarticles');	
			
			$this->load->library('pagination');
			$limitrec = 20;
			$per_page = $this->input->get("per_page");
			if(!isset($per_page) || $per_page == null) $per_page = 1;
			$offsetSelect = ($per_page-1)*$limitrec;
			$queryCount = $this->db->query("SELECT count(*) TOTAL_REC FROM hd_articles WHERE ID_MODULE ='".$module."'  AND LANGUAGE = '".$langQuery."' AND VISIBLE_AR = 1 ");	
			$queryListArticle = $this->db->query("SELECT * FROM hd_articles 
					WHERE ID_MODULE ='".$module."' AND LANGUAGE = '".$langQuery."'  AND VISIBLE_AR = 1 ORDER BY SORT_INDEX, DATE_MODIFIED DESC, DATE_CREATED DESC 
					LIMIT ".$offsetSelect." ,".$limitrec);
			if(get_cookie("language") == "en") { $data['module'] = $queryModule->row()->En_US; $langQuery = 'En-US';}
			else { $data['module'] = $queryModule->row()->Vi_VN; $langQuery = 'Vi-VN';}
	
			$data['viewData'] = array('TOTAL_REC' => $queryCount->row()->TOTAL_REC);
			$data["contentModel"] = $queryListArticle->result();
			
			$data['og_Title'] = $data['module'];
			$data['og_Desc'] = $data['module'];
		}	
		//$data['module'] = $queryModule->row()->NAME_MD;
		if(get_cookie("language") == "en") { $data['module'] = $queryModule->row()->En_US; }
		else { $data['module'] = $queryModule->row()->Vi_VN; }
		$data['moduleName'] = $data['module'];
		$data['moduleID'] = $queryModule->row()->ID_MODULE;
		$data['moduleType'] = $queryModule->row()->TYPE_MD;
		$this->load->view('home/master_view', $data);
	}
	
	public function detailarticle($id, $module)
	{			
		$data = array('content'=>'home/detailarticle');
		$queryModule = $this->db->query("SELECT * FROM hd_modules WHERE ID_MODULE ='".$module."' LIMIT 1");	
		$queryArticle = $this->db->query("SELECT * FROM hd_articles WHERE ID_AR ='".$id."' LIMIT 1");	

		if(get_cookie("language") == "en") { $data['module'] = $queryModule->row()->En_US; }
		else { $data['module'] = $queryModule->row()->Vi_VN; }

		if(get_cookie("language") == "en") { $data['langQuery'] = 'En-US'; }
		else { $data['langQuery'] = 'Vi-VN'; }

		//$data['module'] = $queryModule->row()->NAME_MD;
		$data['moduleName'] = $data['module']; //$queryModule->row()->NAME_MD;
		$data['moduleID'] = $queryModule->row()->ID_MODULE;
		$data['moduleType'] = $queryModule->row()->TYPE_MD;
		$data['articleModel'] = $queryArticle->row();
		
		
		$data['og_Title'] = $queryArticle->row()->NAME_AR;
		$data['og_Desc'] = $queryArticle->row()->DESC_AR;
		$data['og_Image'] = $queryArticle->row()->IMAGE_AR;
		
		$this->load->view('home/master_view', $data);
	}
	
	
	public function listimages($module)
	{
		$queryModule = $this->db->query("SELECT * FROM hd_modules WHERE ID_MODULE ='".$module."' LIMIT 1");				

		$data = array('content'=>'home/listimages');						

		if(get_cookie("language") == "en") { $data['module'] = $queryModule->row()->En_US;  $langQuery = 'En-US'; }
		else { $data['module'] = $queryModule->row()->Vi_VN;  $langQuery = 'Vi-VN';}

		if(get_cookie("language") == "en") { $data['langQuery'] = 'En-US'; }
		else { $data['langQuery'] = 'Vi-VN'; }
		
		$this->load->library('pagination');
		$limitrec = 10;
		$per_page = $this->input->get("per_page");
		if(!isset($per_page) || $per_page == null) $per_page = 1;
		$offsetSelect = ($per_page-1)*$limitrec;
		$queryCount = $this->db->query("SELECT count(*) TOTAL_REC FROM hd_images WHERE ID_MODULE ='hinhanh'  AND LANGUAGE = '".$langQuery."'  AND VISIBLE_IMG = 1 ");		
		$data['viewData'] = array('TOTAL_REC' => $queryCount->row()->TOTAL_REC);
		$queryImageActivity = $this->db->query("SELECT * FROM hd_images 
					WHERE ID_MODULE ='hinhanh'  AND LANGUAGE = '".$langQuery."'  AND VISIBLE_IMG = 1 ORDER BY SORT_INDEX, DATE_MODIFIED DESC, DATE_CREATED DESC 
					LIMIT ".$offsetSelect." ,".$limitrec);

		//$data['module'] = $queryModule->row()->NAME_MD;
		$data['moduleName'] = $data['module'];
		$data['moduleID'] = $queryModule->row()->ID_MODULE;
		$data['moduleType'] = $queryModule->row()->TYPE_MD;
		$data["queryImageActivity"] = $queryImageActivity; 		
		
		
		$data['og_Title'] = $data['module'];
		$data['og_Desc'] = $data['module'];
		
		$this->load->view('home/master_view', $data);
	}
	
	public function detailimage($module, $id)
	{
		$data = array('content'=>'home/detailimage');
		$queryModule = $this->db->query("SELECT * FROM hd_modules WHERE ID_MODULE ='".$module."' LIMIT 1");	
		$queryImageModel = $this->db->query("SELECT * FROM hd_images WHERE ID = ".$id." LIMIT 1");
		$queryImageListModel = $this->db->query("SELECT * FROM hd_images WHERE ID_MODULE ='".$module."_ref_".$id."' AND REF_ID = ".$id." ");
					

		if(get_cookie("language") == "en") { $data['module'] = $queryModule->row()->En_US; }
		else { $data['module'] = $queryModule->row()->Vi_VN; }

		if(get_cookie("language") == "en") { $data['langQuery'] = 'En-US'; }
		else { $data['langQuery'] = 'Vi-VN'; }

		//$data['module'] = $queryModule->row()->NAME_MD;
		$data['moduleName'] = $data['module'];
		$data['moduleID'] = $queryModule->row()->ID_MODULE;
		$data['moduleType'] = $queryModule->row()->TYPE_MD;
		$data['queryImageModel'] = $queryImageModel->row();
		$data['queryImageListModel'] = $queryImageListModel->result();
		
		
		$data['og_Title'] = $queryImageModel->row()->NAME_IMG;
		$data['og_Desc'] = $queryImageModel->row()->NAME_IMG;
		$data['og_Image'] = $queryImageModel->row()->IMAGE_URL;
		
		$this->load->view('home/master_view', $data);
	}
	
	public function detailimageflb($module)
	{
		$data = array('content'=>'home/detailimageflb');
		$queryModule = $this->db->query("SELECT * FROM hd_modules WHERE ID_MODULE ='".$module."' LIMIT 1");	
		$queryImageListModel = $this->db->query("SELECT * FROM hd_images WHERE ID_MODULE ='".$module."' AND VISIBLE_IMG = 1 ");

		
		if(get_cookie("language") == "en") { $data['module'] = $queryModule->row()->En_US; }
		else { $data['module'] = $queryModule->row()->Vi_VN; }

		if(get_cookie("language") == "en") { $data['langQuery'] = 'En-US'; }
		else { $data['langQuery'] = 'Vi-VN'; }

		//$data['module'] = $queryModule->row()->NAME_MD;
		$data['moduleName'] = $data['module'];
		$data['moduleID'] = $queryModule->row()->ID_MODULE;
		$data['moduleType'] = $queryModule->row()->TYPE_MD;
		$data['queryImageListModel'] = $queryImageListModel->result();
		
		
		$data['og_Title'] = $data['module'];
		$data['og_Desc'] = $data['module'];
		
		$this->load->view('home/master_view', $data);
	}
	
	
	public function listprojects($module, $id=-1)
	{
		$this->load->library('pagination');
		$data = array('content'=>'home/listprojects');
		
		$limitrec = 24;
		$per_page = $this->input->get("per_page");
		if(!isset($per_page) || $per_page == null) $per_page = 1;
		$offsetSelect = ($per_page-1)*$limitrec;
		
		
		$queryModule = $this->db->query("SELECT * FROM hd_modules WHERE ID_MODULE ='".$module."' LIMIT 1");	
		
		if(get_cookie("language") == "en") { $data['module'] = $queryModule->row()->En_US;  $langQuery = 'En-US';}
		else { $data['module'] = $queryModule->row()->Vi_VN;  $langQuery = 'Vi-VN';}

		if(get_cookie("language") == "en") { $data['langQuery'] = 'En-US'; }
		else { $data['langQuery'] = 'Vi-VN'; }
			
		//$data['module'] = $queryModule->row()->NAME_MD;
		$data['moduleName'] = $data['module'];
		$data['moduleID'] = $queryModule->row()->ID_MODULE;
		$data['moduleType'] = $queryModule->row()->TYPE_MD;
		
		if($id != -1){
			$queryGroupName = $this->db->query("SELECT NAME_GR FROM hd_groups WHERE ID_GR ='".$id."' LIMIT 1");
			$data['module'] = $data['module']." - ".$queryGroupName->row()->NAME_GR;
			
			$queryCount = $this->db->query("SELECT count(*) TOTAL_REC FROM hd_projects WHERE ID_MODULE ='duan'  AND LANGUAGE = '".$langQuery."'  AND GROUP_ID = ".$id." AND VISIBLE_PRJ = 1 ");		
			$data['viewData'] = array('TOTAL_REC' => $queryCount->row()->TOTAL_REC);
			$queryProjects = $this->db->query("SELECT * FROM (SELECT * FROM hd_projects 
						WHERE ID_MODULE ='duan'   AND LANGUAGE = '".$langQuery."'  AND GROUP_ID = ".$id." AND VISIBLE_PRJ = 1 ORDER BY rand() 
						LIMIT ".$offsetSelect." ,".$limitrec." ) a ORDER BY a.YEAR_PRJ DESC, a.NAME_PRJ ");
			$data["queryProjects"] = $queryProjects->result();
			
			
			$data['og_Title'] = $queryGroupName->row()->NAME_GR;
			$data['og_Desc'] = $data['module'];
		}
		else{	
			
			$queryCount = $this->db->query("SELECT count(*) TOTAL_REC FROM hd_projects WHERE ID_MODULE ='duan'  AND LANGUAGE = '".$langQuery."'  AND VISIBLE_PRJ = 1 ");		
			$data['viewData'] = array('TOTAL_REC' => $queryCount->row()->TOTAL_REC);
			$queryProjects = $this->db->query("SELECT * FROM (SELECT * FROM hd_projects 
						WHERE ID_MODULE ='duan'  AND LANGUAGE = '".$langQuery."'  AND VISIBLE_PRJ = 1  ORDER BY rand() 
						LIMIT ".$offsetSelect." ,".$limitrec." ) a ORDER BY a.YEAR_PRJ DESC, a.NAME_PRJ ");
			$data["queryProjects"] = $queryProjects->result();
			
			
			$data['og_Title'] = $data['module'];
			$data['og_Desc'] = $data['module'];
		}
		
		
		
		$this->load->view('home/master_view', $data);
	}
	
	public function detailproject($module, $id)
	{
		$queryModule = $this->db->query("SELECT * FROM hd_modules WHERE ID_MODULE ='".$module."' LIMIT 1");	
		$data = array('content'=>'home/detailproject');
		$queryProject = $this->db->query("SELECT * FROM hd_projects WHERE ID_PRJ ='".$id."' LIMIT 1");
		$queryImageListModel = $this->db->query("SELECT * FROM hd_images WHERE ID_MODULE ='".$module."_ref_".$id."' AND REF_ID = ".$id." ");

		
		if(get_cookie("language") == "en") { $data['module'] = $queryModule->row()->En_US; }
		else { $data['module'] = $queryModule->row()->Vi_VN; }

		if(get_cookie("language") == "en") { $data['langQuery'] = 'En-US'; }
		else { $data['langQuery'] = 'Vi-VN'; }

		//$data['module'] = $queryModule->row()->NAME_MD;
		$data['moduleName'] = $data['module'];
		$data['moduleID'] = $queryModule->row()->ID_MODULE;
		$data['moduleType'] = $queryModule->row()->TYPE_MD;
		$data['modelProject'] = $queryProject->row();
		$data['queryImageListModel'] = $queryImageListModel->result();
		
		$data['og_Title'] = $queryProject->row()->NAME_PRJ;
		$data['og_Desc'] = $queryProject->row()->LOCATION_PRJ." - ".$queryProject->row()->LOCATION_PRJ." - "
			.$queryProject->row()->YEAR_PRJ." - ".$queryProject->row()->NAME_PRJ;
		$data['og_Image'] = $queryProject->row()->IMAGE_PRJ;
		
		$this->load->view('home/master_view', $data);
	}
	
	public function captcha()
	{
		$length=5;
		$md5 = md5(rand());
		$text = substr($md5,0,$length);
		
		$captcha = imagecreatefrompng("img/captchar.png");
		$font=13;
		for($i=0;$i<20;$i++)
			imageline ( $captcha , rand(0,100) , rand(0,100) , rand(0,100),rand(0,100),rand(0,100000));
		$image_width=imagesx($captcha);
		$image_height=imagesy($captcha);
		$text_width=imagefontwidth($font)*$length;
		$text_height=imagefontheight($font);
		imagestring($captcha, $font, ($image_width-$text_width)/2 , ($image_height-$text_height)/2, $text, 0);

		$this->session->set_userdata(array("captchaCode" =>  md5($text)));
		
		header("Content-type: image/png");
		imagepng($captcha);
		imagedestroy($captcha);
	}
	
	public function contact()
	{
		$this->load->helper('captcha');
		if(get_cookie("language") == "en") { 
			$data['module'] = "Contact";
			$language_dict = array(
				'contactFormMissingField' => 'Please complete the information',
				'contactInvaliSecurityCode' => 'The security code is incorrect',
				'contactSuccess' => 'Your request has been sent successfully!',
        		'contactError' => 'An error has occurred. Please try again or contact us directly. Thank you !'
			);	
		}
		else { 
			$data['module'] = "Liên hệ";
			$language_dict = array(
				'contactFormMissingField' => 'Vui lòng điền đầy đủ các thông tin',
				'contactInvaliSecurityCode' => 'Mã bảo mật không đúng',
				'contactSuccess' => 'Yêu cầu của bạn đã được gửi thành công !',
				'contactError' => 'Đã có lỗi xảy ra. Vui lòng thử lại hoặc liên hệ trực tiếp với chúng tôi. Xin cảm ơn'
			);			
		}

		if(get_cookie("language") == "en") { $data['langQuery'] = 'En-US'; }
		else { $data['langQuery'] = 'Vi-VN'; }
		
		$data['module'] = "Liên hệ";
		$data = array('content'=>'home/contact');
		if(!isset($_POST["submit"])){
			
			$this->load->view('home/master_view', $data);
		}
		else{
			
			$TITLE_CONTACT = $this->input->post("TITLE_CONTACT");
			$CONTENT_CONTACT = $this->input->post("CONTENT_CONTACT");
			$NAME_CONTACT = $this->input->post("NAME_CONTACT");
			$EMAIL_CONTACT = $this->input->post("EMAIL_CONTACT");
			$PHONE_CONTACT = $this->input->post("PHONE_CONTACT");
			$captchaCodeInput = $this->input->post("CaptchaCode");
			
			if($TITLE_CONTACT == "" || $CONTENT_CONTACT == "" || $NAME_CONTACT == ""
			   || $EMAIL_CONTACT == "" || $PHONE_CONTACT == "" || $captchaCodeInput == ""){
				
				$data["viewData"] = array("Failed" => "<p>".$language_dict['contactFormMissingField']."</p>");
				$this->load->view('home/master_view', $data);
			}
			else{				
				$captchaCode = $this->session->captchaCode;
				if(md5($captchaCodeInput) == $captchaCode){
					$this->db->query("INSERT INTO hd_contacts (NAME_CONTACT, EMAIL_CONTACT, PHONE_CONTACT, TITLE_CONTACT, 
					 CONTENT_CONTACT, STATUS_CONTACT, DATE_CREATED, DATE_PROCCESS) 
					 VALUES ('".$NAME_CONTACT."', '".$EMAIL_CONTACT."', '".$PHONE_CONTACT."', '".$TITLE_CONTACT."', '".$CONTENT_CONTACT."', '0', '".date('Y-m-d H:i:s')."', NULL)");
					if($this->db->affected_rows() > 0){
						unset ($_POST);
						$data["viewData"] = array("Success" => "<p>".$language_dict['contactSuccess']."</p>");
					}
					else $data["viewData"] = array("Failed" => "<p>".$language_dict['contactError']."</p>");
				} 
				else {
					$data["viewData"] = array("Failed" => "<p>".$language_dict['contactInvaliSecurityCode']."</p>");
				}
				$this->load->view('home/master_view', $data);
			}
			
		}
	}
}
