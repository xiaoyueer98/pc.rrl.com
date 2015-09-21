<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends Controller {

		public function indexLeftNav()
	{
		 $model = M('casclist','stj_','DB_CONFIG1'); 
		$position = $model
						->where("id in (641,642,643,648,649,645,970)")
						->select();
		$this->position=$position;
		$this->display();
	}
	function fiexdTop()
	{
			 $model = M('userinfo','stj_','DB_CONFIG1'); 
			if(!empty($_SESSION['username']))
			{
			$username=$_SESSION['username'];
			$decide = $model
							->where("username='".$username."'")
							->find();
			if(!empty($decide))
			{
				$table=array();
				foreach($decide as $key=>$val)
				{
					$table=$decide[$key];
				}
				//判断是企业or推荐人 1企业用户 0推荐人
				if($table["flag"]=="0")
				{
					$data['url'] = "{:U('Login/userinfo')}";
					$data['logout'] = "{:U('Login/logout')}";
					$data['savepass'] = "{:U('Login/savepass')}";
				}
				else if($table["flag"]=="1")
				{
					$data['url'] = "{:U('Company/EnterpriseInformation')}";
					$data['logout'] = "{:U('Company/logout')}";
					$data['savepass'] = "{:U('Company/savepass')}";
				}	
				$this->assign("data",$data);
				$this->display();
			}
			
		}
	}
	function aa()
	{		 $model = M('userinfo','stj_','DB_CONFIG1'); 
			if(!empty($_SESSION['username']))
			{
			$username=$_SESSION['username'];
			$decide = $model
							->where("username='".$username."'")
							->find();
			if(!empty($decide))
			{
				$table=array();
				foreach($decide as $key=>$val)
				{
					$table=$decide[$key];
				}
				//判断是企业or推荐人 1企业用户 0推荐人
				if($table["flag"]=="0")
				{
					$data['url'] = "{:U('Login/userinfo')}";
					$data['logout'] = "{:U('Login/logout')}";
					$data['savepass'] = "{:U('Login/savepass')}";
				}
				else if($table["flag"]=="1")
				{
					$data['url'] = "{:U('Company/EnterpriseInformation')}";
					$data['logout'] = "{:U('Company/logout')}";
					$data['savepass'] = "{:U('Company/savepass')}";
				}	
				$this->assign("data",$data);
				var_dump($data);
				$this->display();
			}
			
		}
		
	}

}