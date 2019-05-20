<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';

    protected $primarykey = 'id';

    public $timestamps = false;

    //不可被批量赋值的属性
    protected $guarded = [];
}
