<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_c extends CI_Controller 
{
	 function __construct()
    {      
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->database();
        $this->load->model('user_m');
        $this->load->model('noticeboard_m');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('date');
        $config['upload_path']          = 'C:\Apache24\htdocs\upload';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 1024;
        $config['encrypt_name']         = TRUE;
		$this->load->library('upload', $config);
		

		

		
    }

	public function index()
	{

		$this->load->library('pagination');

		$config['first_tag_open']  = '<span id=page>';
		$config['first_tag_close']  = '</span>';
		$config['last_tag_open']  = '<span id=page>';
		$config['last_tag_close']  = '</span>';
		$config['cur_tag_open']  = '<span id=page>';
		$config['cur_tag_close']  = '</span>';
		$config['next_tag_open']  = '<span id=page>';
		$config['next_tag_close']  = '</span>';
		$config['prev_tag_open']  = '<span id=page>';
		$config['prev_tag_open']  = '<span id=page>';
		$config['prev_tag_close']  = '</span>';
		$config['num_tag_open']  = '<span id=page>';
		$config['num_tag_close']  = '</span>';


		$config['base_url'] = 'http://localhost/index.php/user_c/index';
		$config['total_rows'] = $this ->noticeboard_m->read_m('count');
		$config['per_page'] = 5;
		$this->pagination->initialize($config); 
		$read['pagination'] = $this -> pagination -> create_links();
		 $page = $this -> uri -> segment(3, 1);
 
        if ($page > 1) {

            $start = (($page / $config['per_page'])) * $config['per_page'];
        } else {
            $start = ($page - 1) * $config['per_page'];
        }
 
        $limit = $config['per_page'];
		$read['list'] = $this->noticeboard_m->read_m('',$start,$limit);
		
		$this -> load -> view('head');
		$this -> load -> view('index');
		$this -> load -> view('board',$read);
		
		
		$this -> load -> view('footer');

	}

	public function login()
	{

		if(@$this->session->userdata('login_idle')==TRUE)
		{
			$msg['msg']='이미 로그인 되어있습니다.';
			$this -> load -> view('head');
			$this -> load -> view('error',$msg);
			$this -> load -> view('footer');
		}
		else{
		$this -> load -> view('head');
		$this -> load -> view('login');
		$this -> load -> view('footer');
		}
	}

	public function login2()
	{
		$login_info = array(
			'login_id' => $this->input->post('id'),
			'login_pwd' => $this->input->post('pwd'),
		);
		

		$loginconfirm = $this->user_m->login($login_info);

		if($loginconfirm!=0)
		{
			$sessioninfo = array(
				'login_num' =>$this->user_m->sessioninfo($login_info)[0]['num'],
				'login_nickname'=> $this->user_m->sessioninfo($login_info)[0]['nickname'],
				'login_idle' => TRUE
				);

			
			$this -> session -> set_userdata($sessioninfo);
			redirect('http://localhost/index.php/user_c','refresh');

		}
		else
		{
			$msg['msg']='아이디와 패스워드를 확인해 주세요.';
			$this -> load -> view('head');
			$this -> load -> view('error',$msg);
			$this -> load -> view('footer');
		}

	}
	public function user()
	{
		$idfind = $this -> input -> post('idfind');

		$this -> load -> view('head');
		$this -> load -> view('user');
		$this -> load -> view('footer');
	} 
	public function idcreate()
	{
		$user = array(
			'm_name' =>  $this->input->post('name'),
			'm_id' =>  $this->input->post('id'),
			'm_pwd' => $this->input-> post('pwd'),
			'm_email' =>  $this->input->post('email'),
			'm_nickname' => $this->input->post('nickname')
			);
		
		
		if($this -> user_m -> overlap($user['m_id'])==0)
		{	
			$msg['msg'] = '회원가입이 완료되었습니다.';
			$this -> user_m ->insert($user);
			$this -> load -> view('head');
			$this -> load -> view('msg.php',$msg);
			$this -> load -> view('footer');
			
			}
			else
			{
				$msg['msg'] = '아이디확인을 해주세요.';
				$this -> user_m ->insert($user);
				$this -> load -> view('head');
				$this -> load -> view('msg.php',$msg);
				$this -> load -> view('footer');
			}
	}

	public function idfinder()
	{
		$idfind = $this -> input -> post('idfind');
		
		$overlap = $this->user_m->overlap($idfind);
		
		 echo $overlap;
	}

	public function logout()
	{
		$this -> session-> sess_destroy();
		redirect('http://localhost/index.php/user_c','refresh');
	}

	public function create_form()
	{
		if(@$this->session->userdata('login_idle')==TRUE)
		{
			$this -> load -> view('head');
			$this -> load -> view('create_form');
			$this -> load -> view('footer');
			echo  $this->db->insert_id();
		}
		else{
			redirect('http://localhost/index.php/user_c/login','refresh');
		}
	}

	public function create()
	{
		
		if($this->upload-> do_upload())
		{
			$posts = array( 
			'title' => $this->input->post('title'),
			'contents' => $this->input->post('contents'),
			'unum' => $this->session->userdata('login_num'),
			'date' => date("Y-m-d H:i"),
			'ufile' => $this->upload->data('file_name')
			);
			$this->noticeboard_m->create_m($posts);
			$msg['msg']='작성이 완료 되었습니다.';
			$this -> load -> view('head');
			$this -> load -> view('msg',$msg);
			$this -> load -> view('footer');
		    
		}
		else if($this->upload->data('file_name')==NULL)
		{
			$posts = array( 
			'title' => $this->input->post('title'),
			'contents' => $this->input->post('contents'),
			'unum' => $this->session->userdata('login_num'),
			'date' => date("Y-m-d H:i"),
			'ufile' => NULL
			);
			$this->noticeboard_m->create_m($posts);
			$msg['msg']='작성이 완료 되었습니다.';
			$this -> load -> view('head');
			$this -> load -> view('msg',$msg);
			$this -> load -> view('footer');
			echo  $this->db->insert_id();
		}
		else
		{
			$msg = array
			(
				'msg' =>  $this->upload->display_errors()
			);
			
			$this -> load -> view('head');
			$this->load->view('error', $msg);
			$this -> load -> view('footer');
		}
		

	}
	public function board()
	{
		
		$boardnum = $this->uri->segment(3);
		$boardcontents['list'] = $this->noticeboard_m->findboard($boardnum);
		$this -> load ->view('head');
		$this -> load ->view('boardpage',$boardcontents);
		$this -> load ->view('footer');  
		
	}
	public function confirmboard($boardinfo)
	{
		
		
		$confirm = $this->noticeboard_m->confirm($boardinfo);
		return $confirm;

	}

	public function deleteboard(){
		
		$this-> load ->view('footer');
		$num = $this -> input ->post('boardnum');
		$boaldinfo = array(
				'unum' => @$this->session->userdata('login_num'),
				'num' => $num
				);
		
		$confirm=$this->confirmboard($boaldinfo);
		if($confirm=='TRUE')
		{
			$this->noticeboard_m->deleteboard($boaldinfo);
			$msg['msg']='삭제가 완료 되었습니다.';
			$this -> load -> view('head');
			$this -> load -> view('msg',$msg);
			$this -> load -> view('footer');
		
		}
		else{
			$msg['msg']='권한이 없습니다.';
			$this -> load -> view('head');
			$this -> load -> view('error',$msg);
			$this -> load -> view('footer');

		}
		
	}


	public function update()
	{
		
		$num = $this -> input ->post('boardnum');
		$boaldinfo = array(
				'unum' => @$this->session->userdata('login_num'),
				'num' => $num
				);
		
		$confirm=$this->confirmboard($boaldinfo);
		if($confirm=='TRUE')
		{
			$preexistence['list']=$this -> noticeboard_m -> updatevalue($num);
			
			$this-> load ->view('head');
		
			$this->load->view('updateform',$preexistence);
			$this-> load ->view('footer');
		}
		else{
			$msg['msg']='권한이 없습니다.';
			$this -> load -> view('head');
			$this -> load -> view('error',$msg);
			$this -> load -> view('footer');

		}
	}

	public function updatecomplete()
	{
		
		$updateinfo = array(
		'num' => $this -> input ->post('num'),
		'title' => $this -> input ->post('title'),
		'contents' =>  $this -> input ->post('contents')
		);
		$this->noticeboard_m->updatestore($updateinfo);
		$msg['msg']='수정이 완료 되었습니다..';
			$this -> load -> view('head');
			$this -> load -> view('msg',$msg);
			$this -> load -> view('footer');


	}

	

}
?>