<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    protected $table = 'poster';

    protected $primarykey = 'id';

    public $timestamps = false;

    //可以被批量赋值的属性
    // protected $fillable = ['name','sex','age','city'];
    
    //不可被批量赋值的属性
    protected $guarded = [];
}
