<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Mobilier;

/**
 * MobilierSearch represents the model behind the search form of `app\models\Mobilier`.
 */
class MobilierSearch extends Mobilier
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['REFERENCE_PATRIMOINE', 'DESCRIPTION_MO'], 'safe'],
            [['ID_MOBILIER', 'ID_PERSONNE', 'ID_AYANTDROIT'], 'integer'],
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
        $query = Mobilier::find();

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
            'ID_MOBILIER' => $this->ID_MOBILIER,
            'ID_PERSONNE' => $this->ID_PERSONNE,
            'ID_AYANTDROIT' => $this->ID_AYANTDROIT,
        ]);

        $query->andFilterWhere(['like', 'REFERENCE_PATRIMOINE', $this->REFERENCE_PATRIMOINE])
            ->andFilterWhere(['like', 'DESCRIPTION_MO', $this->DESCRIPTION_MO]);

        return $dataProvider;
    }
}
