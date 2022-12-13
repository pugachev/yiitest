<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
?>


<?php
echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'title',
        // title attribute (in plain text)
        'description:html',
        // description attribute in HTML
        [
            // the owner name of the model
            'label' => 'Owner',
            'value' => function ($model) {
                foreach($model as $key => $val){
                    return ($val["femalenumber"].' '.$val["femalename"].' '.$val["femalenote"]);
                }
            }
        ],
        'created_at:datetime', // creation date formatted as datetime
    ],
]);
?>
