<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author  gf
 * Class Interfacetype_model
 */
class Interfacetype_model extends CI_Model
{
	private $table = 'interfacetype';
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @author  gf
	 * 添加接口分类
	 * @param $data
	 * @param bool|false $tId
	 * @return mixed
	 */
	public function addData($data,$tId = false)
	{
		$tId = intval($tId);
		if(!empty($tId))
		{
			$this->db->where('tId',$tId);
			return $this->db->update($this->table, $data);
		}
		else
		{
			$this->db->insert($this->table, $data);
			return $this->db->insert_id();
		}
	}

	/**
	 * @author  gf
	 * 获取总数据
	 * @return mixed
	 */
	public function getlist()
	{
		$res = $this->db->get($this->table)->result_array();
		return $res;
	}
}
