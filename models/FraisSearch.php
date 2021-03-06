<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Frais;
use yii\db\Query;

/**
 * FraisSearch represents the model behind the search form of `app\models\Frais`.
 */
class FraisSearch extends Frais
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_FRAIS', 'ID_DOSSIER'], 'integer'],
            [['MONTANT'], 'number'],
            [['DATE_REGLE'], 'safe'],
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
        $query = Frais::find();

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
            'ID_FRAIS' => $this->ID_FRAIS,
            'ID_DOSSIER' => $this->ID_DOSSIER,
            'MONTANT' => $this->MONTANT,
            'DATE_REGLE' => $this->DATE_REGLE,
        ]);

        return $dataProvider;
    }

    /*
     * SELECT dossier.`FRAIS_DOSSIER`-SUM(frais.`MONTANT`) AS 'reste a payer'
        FROM dossier, frais
        WHERE dossier.`ID_DOSSIER` = frais.`ID_DOSSIER`
        AND dossier.`ID_DOSSIER` = 10

     */

    public function resteAPayer($dossier)
    {
        $query = (new Query())->select('d.FRAIS_DOSSIER-SUM(f.MONTANT) AS RESTE_A_PAYER')
            ->from('dossier d')
            ->innerJoin('frais f', 'd.ID_DOSSIER = f.ID_DOSSIER')
            ->andWhere(['d.ID_DOSSIER' => $dossier])
            ->one();

        return $query;
    }
}
