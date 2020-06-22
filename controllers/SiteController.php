<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\db\Query;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

use app\models\Pessoas;
use app\models\Categorias;
use app\models\PessoasCategorias;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'cadastrar' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'categorias' => Categorias::find()->all()
        ]);
    }

    public function actionAdmin()
    {
        return $this->render('admin', [
            'pessoas' => Pessoas::find()->all()
        ]);
    }

    public function actionCadastrar()
    {
        $request = Yii::$app->request;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ($request->isAjax || $request->isPost) {
            $pessoa = ['Pessoas' => $request->post()['data']];
            $categorias = $pessoa['Pessoas']['categorias'];
            unset($pessoa['Pessoas']['categorias']);
            $model = new Pessoas;
            $model->load($pessoa);
            
            if ($model->save(false)) {
                foreach ($categorias as $categoria) {
                    $pessoa_categoria = new PessoasCategorias;
                    $pessoa_categoria->codigo_pessoa = $model->codigo;
                    $pessoa_categoria->codigo_categoria = $categoria;
                    $pessoa_categoria->save();
                }
                return ['status' => 'true', 'data' => $model];
            } else {
                return ['status' => false, $model->getErrors()];
            }
        }
    }
}
