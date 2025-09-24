<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Post;
use app\models\User;

class PostController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['my', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // Только авторизованные
                    ],
                ],
            ],
        ];
    }

    public function actionMy()
    {
        $this->view->title = 'My posts';
        $model = new Post();
        $posts = Post::find()->where(['user_id' => Yii::$app->user->id])->all();

        return $this->render('my', [
            'model' => $model,
            'posts' => $posts,
        ]);
    }

    public function actionCreate()
    {
        $model = new Post();
        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['my']);
        }

        return $this->render('my', [
            'model' => $model,
            'posts' => Post::find()->where(['user_id' => Yii::$app->user->id])->all(),
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->user_id !== Yii::$app->user->id) {
            throw new ForbiddenHttpException('Вы не можете редактировать этот пост.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['my']);
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->user_id !== Yii::$app->user->id) {
            throw new ForbiddenHttpException('Вы не можете удалить этот пост.');
        }

        $model->delete();
        return $this->redirect(['my']);
    }

    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Пост не найден.');
    }
}
