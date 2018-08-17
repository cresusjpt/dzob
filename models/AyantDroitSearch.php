<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AyantDroit;

/**
 * AyantDroitSearch represents the model behind the search form of `app\models\AyantDroit`.
 */
class AyantDroitSearch extends AyantDroit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_PERSONNE', 'ID_AYANTDROIT'], 'integer'],
            [['NOM', 'PRENOM', 'SEXE', 'TELEPHONE', 'ADRESSE', 'DATE_NAISSANCE'], 'safe'],
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
        $query = AyantDroit::find();

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
            'DATE_NAISSANCE' => $this->DATE_NAISSANCE,
        ]);

        $query->andFilterWhere(['like', 'NOM', $this->NOM])
            ->andFilterWhere(['like', 'PRENOM', $this->PRENOM])
            ->andFilterWhere(['like', 'SEXE', $this->SEXE])
            ->andFilterWhere(['like', 'TELEPHONE', $this->TELEPHONE])
            ->andFilterWhere(['like', 'ADRESSE', $this->ADRESSE]);

        return $dataProvider;
    }
}
