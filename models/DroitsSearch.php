<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Droits;

/**
 * DroitsSearch represents the model behind the search form of `app\models\Droits`.
 */
class DroitsSearch extends Droits
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_DROITS'], 'integer'],
            [['ETAT_DROIT', 'LIBELLE_DROIT', 'COMMENTAIRE_DROIT', 'DATE_DROIT', 'DATE_DM'], 'safe'],
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
        $query = Droits::find();

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
            'DATE_DROIT' => $this->DATE_DROIT,
            'DATE_DM' => $this->DATE_DM,
        ]);

        $query->andFilterWhere(['like', 'ETAT_DROIT', $this->ETAT_DROIT])
            ->andFilterWhere(['like', 'LIBELLE_DROIT', $this->LIBELLE_DROIT])
            ->andFilterWhere(['like', 'COMMENTAIRE_DROIT', $this->COMMENTAIRE_DROIT]);

        return $dataProvider;
    }
}
