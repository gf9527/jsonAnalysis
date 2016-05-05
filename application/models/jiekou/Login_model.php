<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model
{
	private $table = 'user';
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 验证用户名与密码登录
	 * @author  gf
	 * @param $username
	 * @param $password
	 * @return mixed
	 */
	public function check($username , $password)
	{
		$this->db->where('userName',$username);
		$this->db->where('userPassword',$password);
		$res = $this->db->get($this->table)->row_array();
		return $res;
	}

	/**
	 * 获取信息
	 * @param bool|false $userId
	 * @return mixed
	 */
	public function getInfoById($userId = false)
	{
		$this->db->where('userId',$userId);
		$res = $this->db->get('usercount')->row_array();
		echo $this->db->last_query();
		return $res;
	}
}
