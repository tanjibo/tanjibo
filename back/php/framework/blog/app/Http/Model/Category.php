<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

use App\Libs\Data\Data;

class Category extends Model
{

    protected $table='category';
    protected $primaryKey='c_id';
    public $timestamps=false;
     protected $guarded = [];

    public function getList(){

        $data=$this->orderBy('cate_order')->get()->toArray();
        $data=(new Data)->tree($data,'cate_name','c_id','pid');
         return $data;


    }

}
