<?php use yii\helpers\Html; ?>
<?php foreach ($posts as $post): ?>
    <div class="post">
        <h4><?= Html::encode($post->title) ?></h4>
        <p><?= Html::encode($post->content) ?></p>
    </div>
<?php endforeach; ?>