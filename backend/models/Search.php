<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/3
 * Time: 13:34
 */

namespace backend\models;


use yii\base\Model;

class Search extends Model
{
    public $name;
    public $sn;
    public $max_price;
    public $min_price;
    public function rules()
    {
        return [
          [['name','sn'],'string'],
          [['max_price','min_price'],'double']
        ];
    }


}