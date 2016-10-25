<?php
namespace app\models;
use yii\base\Model;


class Status extends Model{
  const PERMISSIONS_PRIVATE=10;
  const PERMISSIONS_PUBLIC=20;

  public $text;
  public $permissions;

  function rules(){
    return [
      [['text','permissions'],'required']
    ];
  }

  function getPermissions(){
    return [self::PERMISSIONS_PRIVATE=>'Private',self::PERMISSIONS_PUBLIC=>'Public'];
  }

  function getPermissionsLabel($permission){
  return  $permissions==self::PERMISSIONS_PUBLIC?
       'Public':
      'Private';


  }
}
