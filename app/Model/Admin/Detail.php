<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = 'detail';

    protected $primarykey = 'id';

    public $timestamps = false;

    //不可被批量赋值的属性
    protected $guarded = [];

    //一对多
    public function ord()
    {
    	return $this->hasMany('App\Model\Admin\Orders','oid','oid');
    }
}
