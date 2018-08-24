<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Courrier;

/**
 * CourrierSearch represents the model behind the search form of `app\models\Courrier`.
 */
class CourrierSearch extends Courrier
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['REFERENCE', 'DATE', 'OBJET_COURRIER'], 'safe'],
            [['ID_PERSONNE', 'ID_PRIORITE', 'ID_TYPECOURRIER'], 'integer'],
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
        $query = Courrier::find();

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
            'ID_PRIORITE' => $this->ID_PRIORITE,
            'ID_TYPECOURRIER' => $this->ID_TYPECOURRIER,
            'DATE' => $this->DATE,
        ]);

        $query->andFilterWhere(['like', 'REFERENCE', $this->REFERENCE])
            ->andFilterWhere(['like', 'OBJET_COURRIER', $this->OBJET_COURRIER]);

        return $dataProvider;
    }
}
