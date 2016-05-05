<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author  gf
 * Class Jiekou_model
 */
class Jiekou_model extends CI_Model
{
	private $table = 'interface';

	/**
	 * @author  gf
	 * 添加数据
	 * @param $data
	 * @return mixed
	 */
	public function addData($data)
	{
		$bool = $this->db->insert($this->table ,$data);
		return $bool ? $this->db->insert_id() : $bool;
	}

	/**
	 * @author  gf
	 * 接口列表
	 */
	public function jieList($param = array())
	{
		$where = $this->_getWhere($param);
		$this->db->where($where);
		$this->db->order_by('jId','DESC');
		$query = $this->db->get($this->table)->result_array();
		return $query;
	}

	/**
	 * @author  gf
	 * 拿取单条信息
	 * @param $jId
	 * @return mixed
	 */
	public function getJieById($jId)
	{
		if(isset($jId))
		{
			$jId = intval($jId);
			$this->db->where('jId',$jId);
		}
		$rowarr = $this->db->get($this->table)->row_array();
		return $rowarr;
	}

	/**
	 * @author  gf
	 * 删除
	 * @param $jId
	 * @return mixed
	 */
	public function delete($jId)
	{
		return $this->db->delete($this->table, array('jId' => $jId));
	}

	/**
	 * @author  gf
	 * 修改
	 * @param bool|false $jId
	 * @param $data
	 * @return mixed
	 */
	public function update($jId = false,$data)
	{
		$this->db->where('jId',$jId);
		$query = $this->db->update($this->table , $data);
		return $query;
	}

	/**
	 * @author  gf
	 * 搜索条件
	 * @param array $param
	 * @return array
	 */
	private function _getWhere($param = array())
	{
		$where = array();
		if(isset($param['tId']))
		{
			$where['tId'] = $param['tId'];
		}
		return $where;
	}
}
