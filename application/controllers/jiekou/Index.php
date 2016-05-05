<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author  gf
 * 接口主页
 * Class Index
 */
class Index extends CI_Controller
{
	public static $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('jiekou/Jiekou_model','jiekou');
		$this->load->model('jiekou/Interfacetype_model', 'jiekoutype');
	}

	/**
	 * 添加接口
	 */
	public function index()
	{
		$list = $this->jiekoutype->getlist();
		self::$data['list'] = $list;
		$this->load->view('jiekou/myindex',self::$data);
	}

	/**
	 *数据入库
	 */
	public function dataHandle()
	{
		$interfaceName = trim($this->input->post('interfaceName'));
		$interfaceUrl = trim($this->input->post('interfaceUrl'));
		$isLogin = intval($this->input->post('isLogin'));
		$tId = intval($this->input->post('tId'));
		$paramName = $this->input->get_post('paramName');
		$paramValue = $this->input->get_post('paramValue');
		$newParam = array_combine($paramName,$paramValue);
		$jsonParam = json_encode($newParam);
		$interfaceArr = array(
			'tId' => $tId,
			'interfaceName' => $interfaceName,
			'interfaceUrl' => $interfaceUrl,
			'isLogin' => $isLogin,
			'paramlist' => $jsonParam,
		);
		$this->jiekou->addData($interfaceArr);
		redirect('jiekou/Index/paramlist');
	}

	/**
	 * 接口列表
	 */
	public function paramlist($tId = false)
	{
		$param = array();
		$tId = intval($tId);
		$list = $this->jiekoutype->getlist();
		self::$data['list'] = $list;
		$param['tId'] = $tId ? $tId : 0;
		$jielist = $this->jiekou->jieList($param);
		self::$data['jielist'] = $jielist;
		$this->load->view('jiekou/paramlist',self::$data);
	}

	/**
	 * 接口信息
	 * @param bool|false $jId
	 * @param bool|false $isLogin
	 */
	public function jiekouInfo($jId=false,$isLogin=false)
	{
		$sessiondata = $_SESSION;
		unset($sessiondata['regenerated']);
		self::$data['sessiondata'] = $sessiondata;
		$jId = intval($jId);
		$isLogin = intval($isLogin);
		$info = $this->jiekou->getJieById($jId);
		self::$data['info'] = $info;
		$jsonlist = json_decode($info['paramlist']);
		$jsonlist = (array)$jsonlist;
		self::$data['jsonlist'] = $jsonlist;
		$retunData = $this->_request_post($info['interfaceUrl'], $jsonlist);
		$newparam = $this->dealparam($jsonlist);
		if(empty($retunData))
		{
			$retunData = '{"0":"数据错误","1":"参数或地址错误"}';
		}
		self::$data['newUrl'] = $info['interfaceUrl'].'?'.$newparam;
		self::$data['returnData'] = $retunData;
		$this->load->view('jiekou/updateinfo',self::$data);
	}

	/**
	 * @author  gf
	 * 删除接口
	 * @param bool $jId
	 */
	public function deleteJiekou($jId = false)
	{
		$jId = intval($jId);
		$bool = $this->jiekou->delete($jId);
		redirect('jiekou/Index/paramlist');
	}

	/**
	 * 调试接口信息
	 * @param bool|false $jId
	 */
	public function readInfo($jId = false)
	{
		$jId = intval($jId);
		$info = $this->jiekou->getJieById($jId);
		self::$data['info'] = $info;
		$sessiondata = $_SESSION;
		unset($sessiondata['regenerated']);
		self::$data['sessiondata'] = $sessiondata;
		$this->load->view('jiekou/updateinfo',self::$data);

	}

	/**
	 * @author  gf
	 * 修改数据
	 */
	public function update()
	{
		$jId = intval($this->input->get_post('jId'));
		$interfaceName = trim($this->input->post('interfaceName'));
		$interfaceUrl = trim($this->input->post('interfaceUrl'));
		$paramName = $this->input->get_post('paramName');
		$paramValue = $this->input->get_post('paramValue');
		$newParam = array_combine($paramName,$paramValue);
		$jsonParam = json_encode($newParam);
		$interfaceArr = array(
			'interfaceName' => $interfaceName,
			'interfaceUrl' => $interfaceUrl,
			'paramlist' => $jsonParam
		);
		$this->jiekou->update($jId,$interfaceArr);
		redirect('jiekou/Index/readInfo/'.$jId);
	}

	/**
	 * @author  gf
	 * 模拟post进行url请求
	 * @param string $url
	 * @param array $post_data
	 */
	private function _request_post($url = '', $post_data = array())
	{
		if ( empty ( $url ) || empty ( $post_data ))
		{
			return false;
		}
		$o = "";
		foreach ( $post_data as $k => $v )
		{
			$o .= "$k=" . urlencode ( $v ) . "&";
		}
		$post_data = substr ( $o, 0, - 1 );
		$postUrl = $url;
		$curlPost = $post_data;
		$ch = curl_init (); //初始化curl
		curl_setopt ( $ch, CURLOPT_URL, $postUrl ); //抓取指定网页
		curl_setopt ( $ch, CURLOPT_HEADER, 0 ); //设置header
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 ); //要求结果为字符串且输出到屏幕上
		curl_setopt ( $ch, CURLOPT_POST, 1 ); //post提交方式
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $curlPost );
		$data = curl_exec ( $ch ); //运行curl
		curl_close ( $ch );
		return $data;
	}

	/**
	 * @author  gf
	 * 处理参数
	 * */
	public function dealparam($param)
	{

		$url = array();
		if(!empty($param)){
			foreach ($param as $k=>$v)
			{
				if($v !== '')
				{
					$url[] = $k.'='.$v;
				}
			}
		}
		return !empty($url) ? implode('&', $url) : '';
	}
}
