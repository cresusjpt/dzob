<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Dossier;

/**
 * DossierSearch represents the model behind the search form of `app\models\Dossier`.
 */
class DossierSearch extends Dossier
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_DOSSIER', 'ID_CLASSEUR', 'ID_PERSONNE', 'ID_CLIENT', 'DOS_ID_DOSSIER'], 'integer'],
            [['LIBELLE_DOSSIER', 'COMMENTAIRE_DOSSIER', 'DATE_CREATION', 'DATE_DMDOSSIER', 'ETAT_DOSSIER_TRAITEMENT', 'STATUT_DOSSIER'], 'safe'],
            [['FRAIS_DOSSIER'], 'number'],
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
        $query = Dossier::find();

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
            'ID_CLASSEUR' => $this->ID_CLASSEUR,
            'ID_PERSONNE' => $this->ID_PERSONNE,
            'ID_CLIENT' => $this->ID_CLIENT,
            'DOS_ID_DOSSIER' => $this->DOS_ID_DOSSIER,
            'DATE_CREATION' => $this->DATE_CREATION,
            'DATE_DMDOSSIER' => $this->DATE_DMDOSSIER,
            'FRAIS_DOSSIER' => $this->FRAIS_DOSSIER,
        ]);

        $query->andFilterWhere(['like', 'LIBELLE_DOSSIER', $this->LIBELLE_DOSSIER])
            ->andFilterWhere(['like', 'COMMENTAIRE_DOSSIER', $this->COMMENTAIRE_DOSSIER])
            ->andFilterWhere(['like', 'ETAT_DOSSIER_TRAITEMENT', $this->ETAT_DOSSIER_TRAITEMENT])
            ->andFilterWhere(['like', 'STATUT_DOSSIER', $this->STATUT_DOSSIER]);

        return $dataProvider;
    }
}
