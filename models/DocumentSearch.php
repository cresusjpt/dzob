<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Document;

/**
 * DocumentSearch represents the model behind the search form of `app\models\Document`.
 */
class DocumentSearch extends Document
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_DOC'], 'integer'],
            [['TITRE_DOC', 'DESCRIPTION_DOC', 'DATE_DOC', 'DATE_EFFECTIVE', 'CREATEUR', 'SOURCE'], 'safe'],
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
        $query = Document::find();

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
            'ID_DOC' => $this->ID_DOC,
            'DATE_DOC' => $this->DATE_DOC,
            'DATE_EFFECTIVE' => $this->DATE_EFFECTIVE,
        ]);

        $query->andFilterWhere(['like', 'TITRE_DOC', $this->TITRE_DOC])
            ->andFilterWhere(['like', 'DESCRIPTION_DOC', $this->DESCRIPTION_DOC])
            ->andFilterWhere(['like', 'CREATEUR', $this->CREATEUR])
            ->andFilterWhere(['like', 'SOURCE', $this->SOURCE]);

        return $dataProvider;
    }
}
