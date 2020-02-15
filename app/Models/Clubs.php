<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clubs extends Model
{
    //定义模型关联的数据表
    protected $table = 'clubs';
    //定义主键
    protected $primaryKey = 'id';
    //定义禁止操作时间
    public $timestamps = true;
}
