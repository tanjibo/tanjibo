<?php
namespace common\models;
use yii;
use yii\db\ActiveRecord;


class User extends ActiveRecord{

  static function tableName(){
    return '{{%user}}';

  }
  function rules(){

    return [
      ['username','checkName','skipOnEmpty'=>false],
      ['password','string','min'=>6,'tooShort'=>"dd",'skipOnEmpty'=>'false'],
      ['status','in','range'=>[0,1],'message'=>'非法操作']

    ];

  }

   function checkName($attr,$params){

     if(!preg_match("/^[\w]{2,30}$/", $this->$attr)){
       $this->addError($attr,'用户名错误');
     }else if(self::find()->where(['username'=>$this->$attr])->count()>0)
     {
       $this->addError($attr,'用户名被占用');
     }

   }


   function beforeSave($insert){

     if(parent::beforeSave($insert)){
       //isNewRecord 是不是一条新纪录
       if($this->isNewRecord)
      $this->date=$this->login_date=time();
      $this->password=md5($this->password);
      $this->login_ip=Yii::$app->request->userIP;
  
      return true;
     }
     return false;


   }
}
