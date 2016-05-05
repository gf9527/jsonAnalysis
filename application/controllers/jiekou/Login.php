<?php defined('BASEPATH') OR exit('No direct script access allowed');
header('content-type:text/html;charset="utf-8"');

/**@author  gf
 * 登录控制器
 * Class Login
 */
class Login extends CI_Controller
{
	private static $view_data = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('jiekou/Login_model','loginmodel');
		$this->load->model('jiekou/User_model','user');
	}

	/**
	 * @author  gf
	 * 登录页面
	 */
	public function index()
	{
		$this->load->view('jiekou/login');
	}

	/**
	 * @author  gf
	 * 登录处理
	 */
	public function loginIn()
	{
		$username = trim($this->input->post('userName'));
		$password = md5($this->input->post('userPassword'));
		$check = $this->loginmodel->check($username,$password);
		if(!empty($check))
		{
			$userinfo = $this->loginmodel->getInfoById($check['userId']);
			$sessionArr = array(
				'userName' => $check['userName'],
				'userId' => $check['userId'],
				'token' => $check['token'],
				'realName' => $check['realName'],
				'roleId' => $userinfo['roleId'],
				'classId' => $userinfo['classId'],
				'studentId' => $userinfo['studentId'],
				'validateParam' => $userinfo['validateParam'],
			);
			$this->session->set_userdata($sessionArr);
			redirect('jiekou/Index/paramlist');
		}
		else
		{
			redirect('jiekou/Login');
		}
	}

	/**
	 * @author  gf
	 * 注销
	 */
	public function loginOut()
	{
		$this->session->sess_destroy();
		redirect('jiekou/Login/');
	}
}