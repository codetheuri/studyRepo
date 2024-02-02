<?php

namespace app\modules\studyRepo\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\studyRepo\models\Paper;

/**
 * PaperSearch represents the model behind the search form of `app\modules\studyRepo\models\Paper`.
 */
class PaperSearch extends Paper
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at'], 'integer'],
            [['papername', 'unit', 'papercode'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Paper::find();

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
            'id' => $this->id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'papername', $this->papername])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'papercode', $this->papercode]);

        return $dataProvider;
    }
}
