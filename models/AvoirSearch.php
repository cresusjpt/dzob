<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Avoir;
use yii\db\Query;

/**
 * AvoirSearch represents the model behind the search form of `app\models\Avoir`.
 */
class AvoirSearch extends Avoir
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_PERSONNE', 'ID_AYANTDROIT'], 'integer'],
            [['REFERENCE_PATRIMOINE'], 'safe'],
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
        $query = Avoir::find();
        $query->orderBy('REFERENCE_PATRIMOINE');

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
            'ID_PERSONNE' => $this->ID_PERSONNE,
            'ID_AYANTDROIT' => $this->ID_AYANTDROIT,
        ]);

        $query->andFilterWhere(['like', 'REFERENCE_PATRIMOINE', $this->REFERENCE_PATRIMOINE]);

        return $dataProvider;
    }

    public function searchGroup($params)
    {
        $query = (new Query())->select('*');

        $query->from('avoir')
            ->groupBy('REFERENCE_PATRIMOINE')
            ->all();

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
            'ID_PERSONNE' => $this->ID_PERSONNE,
            'ID_AYANTDROIT' => $this->ID_AYANTDROIT,
        ]);

        $query->andFilterWhere(['like', 'REFERENCE_PATRIMOINE', $this->REFERENCE_PATRIMOINE]);

        return $dataProvider;
    }
}
