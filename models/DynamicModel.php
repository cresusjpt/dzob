<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 12/10/2018
 * Time: 19:18
 */

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class DynamicModel extends \yii\base\Model
{
    /**
     * Creates and populates a set of models.
     *
     * @param string $modelClass
     * @param array $multipleModels
     * @return array
     */
    public static function createMultiple($modelClass, $multipleModels = [])
    {
        $model = new $modelClass;
        $formName = $model->formName();
        $post = Yii::$app->request->post($formName);
        $models = [];

        if (!empty($multipleModels)) {
            // $keys = array_keys(ArrayHelper::map($multipleModels, 'ID_MODELE', 'ID_MODELE'));
            $keys = array_keys($multipleModels);
            $multipleModels = array_combine($keys, $multipleModels);
            echo Json::encode($multipleModels);
            die();

        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['ID_MODELE']) && !empty($item['ID_MODELE']) && isset($multipleModels[$item['ID_MODELE']])) {
                    $models[] = $multipleModels[$item['ID_MODELE']];
                } else {
                    $models[] = new $modelClass;
                }
            }
        }

        unset($model, $formName, $post);

        return $models;
    }
}