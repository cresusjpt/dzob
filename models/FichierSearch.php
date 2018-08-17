<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Fichier;

/**
 * FichierSearch represents the model behind the search form of `app\models\Fichier`.
 */
class FichierSearch extends Fichier
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_FICHIER'], 'integer'],
            [['REFERNCE', 'NOM_FICHIER', 'FORMAT_FICHIER'], 'safe'],
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
        $query = Fichier::find();

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
            'ID_FICHIER' => $this->ID_FICHIER,
        ]);

        $query->andFilterWhere(['like', 'REFERNCE', $this->REFERNCE])
            ->andFilterWhere(['like', 'NOM_FICHIER', $this->NOM_FICHIER])
            ->andFilterWhere(['like', 'FORMAT_FICHIER', $this->FORMAT_FICHIER]);

        return $dataProvider;
    }
}
