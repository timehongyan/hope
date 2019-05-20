<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'type';
    /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    protected $primaryKey = 'id';

    /**
	 * 不可被批量赋值的属性。
	 *
	 * @var array
	 */
	protected $guarded = [];
}
