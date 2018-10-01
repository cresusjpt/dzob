<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Droits;
use yii\db\Query;
use yii\web\NotFoundHttpException;

/**
 * DroitsSearch represents the model behind the search form of `app\models\Droits`.
 */
class DroitsSearch extends Droits
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_DROITS'], 'integer'],
            [['ETAT_DROIT', 'LIBELLE_DROIT', 'COMMENTAIRE_DROIT', 'DATE_DROIT', 'DATE_DM'], 'safe'],
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
     * @param $identifiant
     * @param $id_doc
     * @return array
     * @throws NotFoundHttpException
     */
    public function searchBYDOCAndIDENTIFIANT($identifiant, $id_doc)
    {
        $query = (new Query())->select('d.*')
            ->from('droits d')
            ->innerJoin('gr_usager g', 'g.ID_DROITS = d.ID_DROITS')
            ->innerJoin('dossier dos', 'dos.ID_DOSSIER = g.ID_DOSSIER')
            ->innerJoin('document doc', 'doc.ID_DOSSIER = dos.ID_DOSSIER')
            ->andWhere(['d.ETAT_DROIT' => 'ACTIF'])
            ->andWhere(['doc.ID_DOC' => $id_doc])
            ->andWhere(['g.IDENTIFIANT' => $identifiant])
            ->all();
        if (count($query) == 0) {
            throw new NotFoundHttpException('Vous n\'avez pas le droit de consulter cette page');
        }
        return $query;
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
        $query = Droits::find();

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
            'ID_DROITS' => $this->ID_DROITS,
            'DATE_DROIT' => $this->DATE_DROIT,
            'DATE_DM' => $this->DATE_DM,
        ]);

        $query->andFilterWhere(['like', 'ETAT_DROIT', $this->ETAT_DROIT])
            ->andFilterWhere(['like', 'LIBELLE_DROIT', $this->LIBELLE_DROIT])
            ->andFilterWhere(['like', 'COMMENTAIRE_DROIT', $this->COMMENTAIRE_DROIT]);

        return $dataProvider;
    }
}
