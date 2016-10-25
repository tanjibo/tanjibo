<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'sex', 'province_id', 'city_id', 'ping_num', 'is_lock', 'reg_client_id', 'delivery_address_id', 'create_time', 'update_time'], 'integer'],
            [['mobile_phone', 'login_pwd', 'nickname', 'head_url', 'signature'], 'safe'],
            [['integral'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'sex' => $this->sex,
            'province_id' => $this->province_id,
            'city_id' => $this->city_id,
            'ping_num' => $this->ping_num,
            'integral' => $this->integral,
            'is_lock' => $this->is_lock,
            'reg_client_id' => $this->reg_client_id,
            'delivery_address_id' => $this->delivery_address_id,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'mobile_phone', $this->mobile_phone])
            ->andFilterWhere(['like', 'login_pwd', $this->login_pwd])
            ->andFilterWhere(['like', 'nickname', $this->nickname])
            ->andFilterWhere(['like', 'head_url', $this->head_url])
            ->andFilterWhere(['like', 'signature', $this->signature]);

        return $dataProvider;
    }
}
