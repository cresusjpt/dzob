<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Finance;

/**
 * FinanceSearch represents the model behind the search form of `app\models\Finance`.
 */
class FinanceSearch extends Finance
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_FINANCE'], 'integer'],
            [['REFERENCE_PATRIMOINE', 'DATE_FINANCE', 'NATURE_FINANCE'], 'safe'],
            [['MONTANT'], 'number'],
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
        $query = Finance::find();

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
            'ID_FINANCE' => $this->ID_FINANCE,
            'MONTANT' => $this->MONTANT,
            'DATE_FINANCE' => $this->DATE_FINANCE,
        ]);

        $query->andFilterWhere(['like', 'REFERENCE_PATRIMOINE', $this->REFERENCE_PATRIMOINE])
            ->andFilterWhere(['like', 'NATURE_FINANCE', $this->NATURE_FINANCE]);

        return $dataProvider;
    }
}
