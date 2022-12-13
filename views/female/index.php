<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h1>国リスト</h1>
<ul>
<?php foreach ($females as $female): ?>
    <li>
        <?= Html::encode("{$female->femalenumber} ({$female->femalename})") ?>:
        <?= $female->femalenote ?>
    </li>
<?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>