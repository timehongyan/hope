<?php 

function getCateName($pid)
{
	if($pid == 0){
		return '顶级分类';
	} else {
		$rs = DB::table('type')->where('id', $pid)->first();

		return $rs->tname;
	}
}


 ?>