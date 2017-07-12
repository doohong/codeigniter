<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_c extends CI_Controller 
{
   function __construct()
    {      
        parent::__construct();
        $this->load->database();
        $this->load->model('user_m');
        $this->load->model('noticeboard_m');
        $this->load->helper('url');
        $this->load->library('session');
    }
  public function index()
  {
    $read['list'] = $this->noticeboard_m->read_m();
    $this -> load -> view('head');
    $this -> load -> view('index');
    $this -> load -> view('board',$read);
    $this -> load -> view('footer');
    //echo $read[title];
    //print_r($read);

  }

  public function login()
  {

    $this -> load -> view('head');
    $this -> load -> view('login');
    $this -> load -> view('footer');
    

  }
  public function login2()
  {

    
    $login_info = array(
      'login_id' => $this->input->post('id'),
      'login_pwd' => $this->input->post('pwd'),
      'login_idle' => TRUE
    );

    //$this->user_m->logininfo($logininfo); //모델로 값 전달
    $loginconfirm = $this->user_m->login($login_info);

    if($loginconfirm!=0)
    {
      
      $this -> session -> set_userdata($login_info);
      redirect('http://localhost/index.php/user_c','refresh');
      echo '로그인이 완료 되었습니다.';
      //echo $this->session->userdata('login_id');

    }
    else
    {
      $this -> load -> view('head');
      $this -> load -> view('footer');
      echo '로그인 실패';
      echo '<br>';
      
    }

  }
  public function user()
  {


    $this -> load -> view('head');
    $this -> load -> view('user');
    $this -> load -> view('footer');
    

    

  } 
  public function jh()
  {
    
    $this -> load -> view('head');
    $this -> load -> view('footer');
    
    $user = array(
      'm_name' =>  $this->input->post('name'),
      'm_id' =>  $this->input->post('id'),
      'm_pwd' => $this->input-> post('pwd'),
      'm_email' =>  $this->input->post('email')
      );
    
    $overlap = $this->idfinder();
    
    if($overlap==0)
    {
      $this -> user_m ->insert($user);
      echo '가입이 완료 되었습니다.';
      echo '<br>';
    }
    else
    {
      echo '아이디가 중복입니다.';
      echo '<br>';
    }
    //$this -> user_m-> get($id),
    
    
    //redirect('http://localhost/index.php/user_c','refresh');
  }

  public function idfinder()
  {

    $idfind = $this -> input -> post('idfind');
    $overlap = $this->user_m->overlap($idfind);
    echo $overlap;

    return $overlap;
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
    }
    else{
      redirect('http://localhost/index.php/user_c/login','refresh');
    }
  
    

  }
  public function create()
  {
    $posts = array( 
    'title' => $this->input->post('title'),
    'contents' => $this->input->post('contents'),
    'id' => $this->session->userdata('login_id'),
    );
    $this->noticeboard_m->create_m($posts);
    echo '완료되었습니다. <br>';
    echo '<a href="/index.php/user_c">홈으로</a>';
    

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
    $this-> load ->view('head');
    $this-> load ->view('footer');
    $num = $this -> input ->post('boardnum');
    $boaldinfo = array(
        'id' => @$this->session->userdata('login_id'),
        'num' => $num
        );
    
    $confirm=$this->confirmboard($boaldinfo);
    if($confirm=='TRUE')
    {
      $this->noticeboard_m->deleteboard($boaldinfo);
      echo '삭제되었습니다.';

    }
    else
      echo '권한이 없어요';
  }

}
?>