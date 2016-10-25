<?php 
namespace app\models;
use yii\db\ActiveRecord;

class  Test extends ActiveRecord{
   public $nickname;
	static function tableName(){
		return '{{%user}}';
	}
}