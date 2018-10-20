<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Valeur;

/**
 * ValeurSearch represents the model behind the search form of `app\models\Valeur`.
 */
class ValeurSearch extends Valeur
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_VALEUR'], 'integer'],
            [['REFERENCE_PATRIMOINE', 'TYPE_PATRIMOINE', 'DATE_DEBUT', 'DATE_FIN', 'REF_TYPE_PATRIMOINE'], 'safe'],
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
        $query = Valeur::find();

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
            'ID_VALEUR' => $this->ID_VALEUR,
            'MONTANT' => $this->MONTANT,
            'DATE_DEBUT' => $this->DATE_DEBUT,
            'DATE_FIN' => $this->DATE_FIN,
        ]);

        $query->andFilterWhere(['like', 'REFERENCE_PATRIMOINE', $this->REFERENCE_PATRIMOINE])
            ->andFilterWhere(['like', 'TYPE_PATRIMOINE', $this->TYPE_PATRIMOINE])
            ->andFilterWhere(['like', 'REF_TYPE_PATRIMOINE', $this->REF_TYPE_PATRIMOINE]);

        return $dataProvider;
    }
}
