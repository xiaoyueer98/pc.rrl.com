<?php
	class  Pagenumber{
		    // 默认列表每页显示行数
			 public $listRows = 20;
			  // 总行数
			 protected $totalRows;
			//点击时触发的方法名
			 public  $fun;
			 function  __construct($totalRows,$fun,$listRows=''){
				$this->totalRows=$totalRows;
				$this->listRows=$listRows;
				$this->fun=$fun;
			 }
	
			//导航输出
			function  show(){
				//总的页数
				$page=ceil($this->totalRows/$this->listRows);

				for($i=1;$i<=$page;$i++){
					$str=$str."<a href='#' onclick='".$this->fun."(".$i.")'>".$i."</a>&nbsp;&nbsp;";
				}
				return  $str;	
			}

			
	}
?>