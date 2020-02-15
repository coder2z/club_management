<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestDetails extends Model
{
    //定义模型关联的数据表
    protected $table = 'request_details';
    //定义主键
    protected $primaryKey = 'id';
    //定义禁止操作时间
    public $timestamps = true;
}
