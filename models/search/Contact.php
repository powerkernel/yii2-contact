<?php

namespace modernkernel\contact\models\search;


use yii\base\Model;
use yii\data\ActiveDataProvider;
use modernkernel\contact\models\Contact as ContactModel;

/**
 * ContactWeb represents the model behind the search form about `modernkernel\contact\models\ContactWeb`.
 */
class Contact extends ContactModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'updated_at'], 'integer'],
            [['name', 'email', 'subject', 'content', 'created_at'], 'safe'],
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
            'sort' => ['defaultOrder'=>['id'=>SORT_DESC]]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            //'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'content', $this->content]);

        if(!empty($this->created_at)){
            $query->andFilterWhere([
                'DATE(CONVERT_TZ(FROM_UNIXTIME(`created_at`), :UTC, :ATZ))' => $this->created_at,
            ])->params([
                ':UTC'=>'+00:00',
                ':ATZ'=>date('P')
            ]);
        }

        return $dataProvider;
    }
}
