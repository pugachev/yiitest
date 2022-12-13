<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Female;

class FemaleController extends Controller
{
    public function actionIndex()
    {
        $query = Female::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $females = $query->orderBy('femalenumber')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'females' => $females,
            'pagination' => $pagination,
        ]);
    }

    public function actionFemale()
    {
        $model = new Female();

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {

            \Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->render('forms', [
                'model' => $model,
            ]);

        } else {

            return $this->render('forms', [
                'model' => $model,
            ]);
        }
    }
}