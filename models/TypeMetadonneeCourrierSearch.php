<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TypeMetadonnee;

/**
 * TypeMetadonneeCourrierSearch represents the model behind the search form of `app\models\TypeMetadonnee`.
 */
class TypeMetadonneeCourrierSearch extends TypeMetadonnee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_TYPEMETA'], 'integer'],
            [['LIBELLE_TYPEMETA'], 'safe'],
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
        $query = TypeMetadonnee::find();

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
            'ID_TYPEMETA' => $this->ID_TYPEMETA,
        ]);

        $query->andFilterWhere(['like', 'LIBELLE_TYPEMETA', $this->LIBELLE_TYPEMETA]);

        return $dataProvider;
    }
}
