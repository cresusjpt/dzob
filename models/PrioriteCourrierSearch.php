<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PrioriteCourrier;

/**
 * PrioriteCourrierSearch represents the model behind the search form of `app\models\PrioriteCourrier`.
 */
class PrioriteCourrierSearch extends PrioriteCourrier
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_PRIORITE'], 'integer'],
            [['NATURE_COURRIER', 'CLASSER'], 'safe'],
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
        $query = PrioriteCourrier::find();

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
            'ID_PRIORITE' => $this->ID_PRIORITE,
        ]);

        $query->andFilterWhere(['like', 'NATURE_COURRIER', $this->NATURE_COURRIER])
            ->andFilterWhere(['like', 'CLASSER', $this->CLASSER]);

        return $dataProvider;
    }
}
