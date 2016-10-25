<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $user_id
 * @property string $mobile_phone
 * @property string $login_pwd
 * @property string $nickname
 * @property string $head_url
 * @property integer $sex
 * @property integer $province_id
 * @property integer $city_id
 * @property string $signature
 * @property integer $ping_num
 * @property double $integral
 * @property integer $is_lock
 * @property integer $reg_client_id
 * @property integer $delivery_address_id
 * @property integer $create_time
 * @property integer $update_time
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login_pwd', 'nickname', 'head_url', 'province_id', 'city_id', 'create_time', 'update_time'], 'required'],
            [['sex', 'province_id', 'city_id', 'ping_num', 'is_lock', 'reg_client_id', 'delivery_address_id', 'create_time', 'update_time'], 'integer'],
            [['integral'], 'number'],
            [['mobile_phone', 'nickname'], 'string', 'max' => 20],
            [['login_pwd'], 'string', 'max' => 50],
            [['head_url'], 'string', 'max' => 100],
            [['signature'], 'string', 'max' => 255],
            [['mobile_phone'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'mobile_phone' => 'Mobile Phone',
            'login_pwd' => 'Login Pwd',
            'nickname' => 'Nickname',
            'head_url' => 'Head Url',
            'sex' => 'Sex',
            'province_id' => 'Province ID',
            'city_id' => 'City ID',
            'signature' => 'Signature',
            'ping_num' => 'Ping Num',
            'integral' => 'Integral',
            'is_lock' => 'Is Lock',
            'reg_client_id' => 'Reg Client ID',
            'delivery_address_id' => 'Delivery Address ID',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
