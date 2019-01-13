<?php

namespace powerkernel\contact\models\search;


use MongoDB\BSON\UTCDateTime;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use powerkernel\contact\models\Contact as ContactModel;

/**
 * ContactWeb represents the model behind the search form about `powerkernel\contact\models\ContactWeb`.
 */
class Contact extends ContactModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'string'],
            [['name', 'phone', 'email', 'subject', 'content', 'created_at'], 'safe'],
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
        $query = ContactModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }


        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['status', 'content', $this->status]);

        if (!empty($this->created_at)) {

            $query->andFilterWhere([
                'created_at' => ['$gte' => new UTCDateTime(strtotime($this->created_at) * 1000)],
            ])->andFilterWhere([
                'created_at' => ['$lt' => new UTCDateTime((strtotime($this->created_at) + 86400) * 1000)],
            ]);


        }

        return $dataProvider;
    }
}
