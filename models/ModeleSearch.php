<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Modele;

/**
 * ModeleSearch represents the model behind the search form of `app\models\Modele`.
 */
class ModeleSearch extends Modele
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_MODELE'], 'integer'],
            [['NOM_MODELE', 'SOURCE_MODELE'], 'safe'],
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
        $query = Modele::find();

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
            'ID_MODELE' => $this->ID_MODELE,
        ]);

        $query->andFilterWhere(['like', 'NOM_MODELE', $this->NOM_MODELE])
            ->andFilterWhere(['like', 'SOURCE_MODELE', $this->SOURCE_MODELE]);

        return $dataProvider;
    }
}
