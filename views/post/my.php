<?php use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>
<div class="my-post">
    <?php $form = ActiveForm::begin(['action' => ['post/create']]); ?>
    <?= $form->field($model, 'title')->textInput(['placeholder' => 'Title'])->label(false) ?>
    <?= $form->field($model, 'content')->textarea(['placeholder' => 'Description'])->label(false) ?>
    <?= Html::submitButton('Add', ['class' => 'cbtn']) ?>
    <?php ActiveForm::end(); ?>
</div>

<?php foreach ($posts as $post): ?>
    <div class="my-post">
        <?php $form = ActiveForm::begin(['action' => ['post/update', 'id' => $post->id]]); ?>
        <?= $form->field($post, 'title')->textInput()->label(false) ?>
        <?= $form->field($post, 'content')->textarea()->label(false) ?>
        <div class="post-actions">
            <?= Html::a('Delete', ['post/delete', 'id' => $post->id], [
                'class' => 'cbtn gray',
                'data' => ['confirm' => 'Вы уверены?', 'method' => 'post'],
            ]) ?>
            <?= Html::submitButton('Save', ['class' => 'cbtn']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
<?php endforeach; ?>