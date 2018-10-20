<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rdv;
use yii\db\Query;
use yii\web\NotFoundHttpException;

/**
 * RdvSearch represents the model behind the search form of `app\models\Rdv`.
 */
class RdvSearch extends Rdv
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_RDV'], 'integer'],
            [['NOM', 'TEL', 'OBJET', 'NOTAIRE', 'DATE_PRISE', 'DATE_RDV'], 'safe'],
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
        $query = Rdv::find();

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
            'ID_RDV' => $this->ID_RDV,
            'DATE_PRISE' => $this->DATE_PRISE,
            'DATE_RDV' => $this->DATE_RDV,
        ]);

        $query->andFilterWhere(['like', 'NOM', $this->NOM])
            ->andFilterWhere(['like', 'TEL', $this->TEL])
            ->andFilterWhere(['like', 'OBJET', $this->OBJET])
            ->andFilterWhere(['like', 'NOTAIRE', $this->NOTAIRE]);

        return $dataProvider;
    }

    /**
     * @return array
     * @throws NotFoundHttpException
     */
    public function searchAllNotarire()
    {
        $query = (new Query())->select('u.*')
            ->from('utilisateur u')
            ->innerJoin('user_profil up', 'up.IDENTIFIANT = u.IDENTIFIANT')
            ->andWhere(['up.CODE_PROFIL' => 'ADMIN'])
            ->all();
        if (count($query) == 0) {
            throw new NotFoundHttpException('Vous n\'avez pas le droit de consulter cette page');
        }
        return $query;
    }
}
