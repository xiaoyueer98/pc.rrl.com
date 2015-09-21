<?php
namespace Home\Controller;
use Think\Controller;
class DatabaseController extends Controller {

function index()
{

	$database = "stj";
	$host="123.57.79.2";
	$root="mystj";
	$password="VsEW8aNDwp7BNTwH";
	$link=mysql_connect($host,$root,$password);
	if($link)
	{
		 $linkdb=mysql_select_db($database);
		 mysql_query('set names GBK');
		 if($linkdb)
		{
			$marr=array();
			$carr=array();
			$sql="select username,password,email from stj_member";
			$sql1="select username,password,email from stj_company";
			$minfo = mysql_query($sql);
			$cinfo = mysql_query($sql1);
			$msql="INSERT INTO `stj_userinfo` ( `username`, `password`, `status`, `flag`) values ";
			while($array = mysql_fetch_assoc($minfo))
			{
				
				$marr[]=$array;
				
	
			}
			for($i=0;$i<count($marr);$i++)
			{
				$msql.="('".$marr[$i]['username']."', '".$marr[$i]['password']."', '1', '0'),";
			}
			
				 
				 echo $msql=rtrim($msql,",");
				$madd = mysql_query($msql);
			if($madd)
			{
				echo "ccccc";
			}
			while($arr = mysql_fetch_assoc($cinfo))
			{
				
				$carr[]=$arr;
				
	
			}
			for($i=0;$i<count($carr);$i++)
			{
				$msql.="('".$carr[$i]['username']."', '".$carr[$i]['password']."', '1', '1'),";
			}
			
				 
				 echo $msql=rtrim($msql,",");
				$cadd = mysql_query($msql);
			if($cadd)
			{
				echo "ccccc";
			}
			
			
	
			
		 }
		
	}
		
}
	

}
?>