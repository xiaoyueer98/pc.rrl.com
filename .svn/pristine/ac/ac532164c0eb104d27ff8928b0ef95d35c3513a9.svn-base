<?php
//封装分页类
class Page{
	public $count;//总记录数
	public $page_count;//总页数
	public $page_size;//每页显示的条数
	public $page;//当前页
	public $url;//跳转页面地址
	
	//对分页类进行初始化
	public function __construct($count,$page_count,$page_size,$page,$url){
		$this->count=$count;
		$this->page_count=$page_count;
		$this->page_size=$page_size;
		$this->page=$page;
		$this->url=$url;
		$arr=parse_url($this->url);
		if(isset($arr['query'])){
			$this->url.='&';
		}else{
			$this->url.='?';
		}
	}

	public function display(){
		$page_info=<<<PAGE
			<span>共有{$this->count}记录</span>
			<span>当前第{$this->page}页</span>
			<span>总共{$this->page_count}页</span>
			
PAGE;
	$first=1;
	$next=($this->page==$this->page_count)?$this->page_count:$this->page+1;
	$pre=($this->page==$first)?$first:$this->page-1;
	$last=$this->page_count;
$page_info.=<<<INFO
	<span style="cursor:pointer" onclick="page('{$this->url}p=$first')">首页</span>
	<span style="cursor:pointer" onclick="page('{$this->url}p=$next')">下一页</span>
	<span style="cursor:pointer" onclick="page('{$this->url}p=$pre')">上一页</span>
	<span style="cursor:pointer" onclick="page('{$this->url}p=$last')">尾页</span>
INFO;
		return $page_info;
	}
	
}