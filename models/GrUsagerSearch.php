<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GrUsager;

/**
 * GrUsagerSearch represents the model behind the search form of `app\models\GrUsager`.
 */
class GrUsagerSearch extends GrUsager
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_DROITS', 'ID_PERSONNE', 'IDENTIFIANT', 'ID_DOSSIER'], 'integer'],
            [['GR_LIBELLE', 'GR_DESCRIPTION'], 'safe'],
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
        $query = GrUsager::find();
        $query->groupBy(['GR_LIBELLE', 'GR_DESCRIPTION']);

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
            'ID_DROITS' => $this->ID_DROITS,
            'ID_PERSONNE' => $this->ID_PERSONNE,
            'IDENTIFIANT' => $this->IDENTIFIANT,
            'ID_DOSSIER' => $this->ID_DOSSIER,
        ]);

        $query->andFilterWhere(['like', 'GR_LIBELLE', $this->GR_LIBELLE])
            ->andFilterWhere(['like', 'GR_DESCRIPTION', $this->GR_DESCRIPTION])
            ->groupBy(['GR_DESCRIPTION']);

        return $dataProvider;
    }


    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchUserByGR($params)
    {
        $query = GrUsager::find();

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
            'ID_DROITS' => $this->ID_DROITS,
            'ID_PERSONNE' => $this->ID_PERSONNE,
            'IDENTIFIANT' => $this->IDENTIFIANT,
            'ID_DOSSIER' => $this->ID_DOSSIER,
        ]);

        $query->andFilterWhere(['like', 'GR_LIBELLE', $this->GR_LIBELLE])
            ->andFilterWhere(['like', 'GR_DESCRIPTION', $this->GR_DESCRIPTION])
            ->groupBy(['GR_DESCRIPTION']);

        return $dataProvider;
    }
}
