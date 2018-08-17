<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LivreTraitement;

/**
 * LivreTraitementSearch represents the model behind the search form of `app\models\LivreTraitement`.
 */
class LivreTraitementSearch extends LivreTraitement
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_LT'], 'integer'],
            [['NOM_TRAITEMENT'], 'safe'],
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
        $query = LivreTraitement::find();

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
            'ID_LT' => $this->ID_LT,
        ]);

        $query->andFilterWhere(['like', 'NOM_TRAITEMENT', $this->NOM_TRAITEMENT]);

        return $dataProvider;
    }
}
