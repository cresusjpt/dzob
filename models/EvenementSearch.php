<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Evenement;

/**
 * EvenementSearch represents the model behind the search form of `app\models\Evenement`.
 */
class EvenementSearch extends Evenement
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_EVENEMENT'], 'integer'],
            [['REFERENCE_PATRIMOINE', 'LIBELLE_EVENEMENT', 'COMMENTAIRE_EVENEMENT', 'DATE_EVENEMENT', 'ETAT_EVENEMENT', 'DATE_REALISATION'], 'safe'],
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
        $query = Evenement::find();

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
            'ID_EVENEMENT' => $this->ID_EVENEMENT,
            'DATE_EVENEMENT' => $this->DATE_EVENEMENT,
            'DATE_REALISATION' => $this->DATE_REALISATION,
        ]);

        $query->andFilterWhere(['like', 'REFERENCE_PATRIMOINE', $this->REFERENCE_PATRIMOINE])
            ->andFilterWhere(['like', 'LIBELLE_EVENEMENT', $this->LIBELLE_EVENEMENT])
            ->andFilterWhere(['like', 'COMMENTAIRE_EVENEMENT', $this->COMMENTAIRE_EVENEMENT])
            ->andFilterWhere(['like', 'ETAT_EVENEMENT', $this->ETAT_EVENEMENT]);

        return $dataProvider;
    }
}
