<?php use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>
<div class="login-block">
    <h1>Login to Account</h1>
    <p>Please enter your email and password to continue</p>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label('Email address:') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <div class="login-buttons">
        <?= Html::submitButton('Sign In', ['class' => 'cbtn', 'style'=> 'order: 0;']) ?>
        <?= Html::a('Back to Home', ['/'], ['class' => 'cbtn gray', 'style'=> 'order: 1;']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>