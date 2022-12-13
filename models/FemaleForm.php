<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\bootstrap5\ActiveForm;

class FemaleForm extends Model
{
    public $id;
    public $femalenumber;
    public $femalename;
    public $femalenote;


    public function rules()
    {
        return [
            [['femalenumber', 'femalename','femalenote'], 'required'],
        ];
    }
}