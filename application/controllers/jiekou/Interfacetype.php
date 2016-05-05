<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 接口分类
 * Class Interfacetype
 */
class Interfacetype extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('jiekou/Interfacetype_model', 'jiekoutype');
	}

	/**
	 * 执行添加接口
	 */
	public function doadd()
	{
		$typeName = trim($this->input->post('typeName'));
		$addArr = array('typeName'=>$typeName);
		$id = $this->jiekoutype->addData($addArr);
		redirect('jiekou/Index/paramlist');
	}
}
