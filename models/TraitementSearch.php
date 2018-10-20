<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Traitement;
use yii\db\Query;

/**
 * TraitementSearch represents the model behind the search form of `app\models\Traitement`.
 */
class TraitementSearch extends Traitement
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_DOSSIER', 'ID_LT', 'ID_TRAITEMENT', 'ETAT_TRAITEMENT'], 'integer'],
            [['COMMENTAIRE_TRAITEMENT', 'DATE_DEBUT', 'DATE_FIN', 'DATE_PREVUE'], 'safe'],
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
        $query = Traitement::find();

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
            'ID_DOSSIER' => $this->ID_DOSSIER,
            'ID_LT' => $this->ID_LT,
            'ID_TRAITEMENT' => $this->ID_TRAITEMENT,
            'ETAT_TRAITEMENT' => $this->ETAT_TRAITEMENT,
            'DATE_DEBUT' => $this->DATE_DEBUT,
            'DATE_FIN' => $this->DATE_FIN,
            'DATE_PREVUE' => $this->DATE_PREVUE,
        ]);

        $query->andFilterWhere(['like', 'COMMENTAIRE_TRAITEMENT', $this->COMMENTAIRE_TRAITEMENT]);

        return $dataProvider;
    }

    public function searchBYDossier($id_dossier)
    {
        $query = (new Query())->select('t.*,l.NOM_TRAITEMENT')->from('livre_traitement l')->innerJoin('traitement t', 't.ID_LT = l.ID_LT')->andWhere(['t.ID_DOSSIER' => $id_dossier])->all();
        return $query;
    }

    public function getCountTraitementByDossier($id_dossier)
    {
        $query = (new Query())->select('*')
            ->from('traitement')
            ->where(['ID_DOSSIER' => $id_dossier])
            ->count();

        return $query;
    }

    public function getCountValidTraitementByDossier($id_dossier)
    {
        $query = (new Query())
            ->from('traitement')
            ->where(['ID_DOSSIER' => $id_dossier])
            ->andWhere(['ETAT_TRAITEMENT' => 1])
            ->count();

        return $query;
    }
}
