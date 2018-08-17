<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Metadonnee;

/**
 * MetadonneeSearch represents the model behind the search form of `app\models\Metadonnee`.
 */
class MetadonneeSearch extends Metadonnee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_META', 'ID_TYPEMETA'], 'integer'],
            [['META_LIBELLE', 'META_CONTENU'], 'safe'],
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
        $query = Metadonnee::find();

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
            'ID_META' => $this->ID_META,
            'ID_TYPEMETA' => $this->ID_TYPEMETA,
        ]);

        $query->andFilterWhere(['like', 'META_LIBELLE', $this->META_LIBELLE])
            ->andFilterWhere(['like', 'META_CONTENU', $this->META_CONTENU]);

        return $dataProvider;
    }
}
