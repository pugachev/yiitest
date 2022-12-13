<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use yii\models\FemaleForm;
?>

<?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

<div class="row">

   <div class="col-lg-5">

       <div class="panel panel-default">

           <div class="panel-heading">Message Sent</div>

           <div class="panel-body">

               <p><b>femalenumber:</b> <?=$model->femalenumber?> </p>

               <p><b>femalename:</b> <?=$model->femalename?> </p>

               <p><b>femalenote:</b> <?=$model->femalenote?> </p>

           </div>

       </div>

       <div class="alert alert-success">

           Thank you for contacting us. We will respond to you as soon as possible.

       </div>

   </div>

</div>

   <?php else: ?>

<div class="row">

           <div class="col-lg-5">

               <?php $form = ActiveForm::begin(); ?>

                   <?= $form->field($model, 'femalenumber')->label("番号") ?>

                   <?= $form->field($model, 'femalename')->label("名前") ?>

                   <?= $form->field($model, 'femalenote')->label("メモ") ?>

                  <div class="form-group">

                       <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>

                   </div>

               <?php ActiveForm::end(); ?>

           </div>

       </div>

<?php endif; ?>