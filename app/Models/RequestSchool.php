<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestSchool extends Model
{
    //定义模型关联的数据表
    protected $table = 'request_school';
    //定义主键
    protected $primaryKey = 'request_id';
    //定义禁止操作时间
    public $timestamps = true;
}
