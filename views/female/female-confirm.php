<?php
use yii\helpers\Html;
use app\models\FemaleForm;
?>
<p>あなたは次の情報を入力しました</p>

<ul>
    <li><label>番号</label>: <?= Html::encode($model->femalenumber) ?></li>
    <li><label>名前</label>: <?= Html::encode($model->femalename) ?></li>
    <li><label>メモ</label>: <?= Html::encode($model->femalenote) ?></li>
</ul>