<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Immobilier;
use yii\db\Query;

/**
 * ImmobilierSearch represents the model behind the search form of `app\models\Immobilier`.
 */
class ImmobilierSearch extends Immobilier
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['REFERENCE_PATRIMOINE', 'DESCRIPTION_IMMO', 'ADRESSE'], 'safe'],
            [['ID_IMMOBILIER', 'ID_PERSONNE', 'ID_AYANTDROIT'], 'integer'],
            [['LATITUDE', 'LONGITUDE'], 'number'],
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
        $query = Immobilier::find();

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
            'ID_IMMOBILIER' => $this->ID_IMMOBILIER,
            'ID_PERSONNE' => $this->ID_PERSONNE,
            'ID_AYANTDROIT' => $this->ID_AYANTDROIT,
            'LATITUDE' => $this->LATITUDE,
            'LONGITUDE' => $this->LONGITUDE,
        ]);

        $query->andFilterWhere(['like', 'REFERENCE_PATRIMOINE', $this->REFERENCE_PATRIMOINE])
            ->andFilterWhere(['like', 'DESCRIPTION_IMMO', $this->DESCRIPTION_IMMO])
            ->andFilterWhere(['like', 'ADRESSE', $this->ADRESSE]);

        return $dataProvider;
    }

    public function searchResponsable($id, $type)
    {
        if ($type == 'IMMO') {
            $query = (new Query())->select('NOM, PRENOM')
                ->from('ayant_droit a')
                ->innerJoin('immobilier i', 'a.ID_AYANTDROIT = i.ID_AYANTDROIT')
                ->andWhere(['i.ID_IMMOBILIER' => $id])
                ->one();
        } elseif ($type == 'MO') {
            $query = (new Query())->select('NOM, PRENOM')
                ->from('ayant_droit a')
                ->innerJoin('mobilier m', 'a.ID_AYANTDROIT = m.ID_AYANTDROIT')
                ->andWhere(['m.ID_MOBILIER' => $id])
                ->one();
        }
        return $query;
    }
}
