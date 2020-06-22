<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class PessoasCategorias extends ActiveRecord {
    
    /**
     * {@inheritdoc}
    */
    public static function tableName()
    {
        return 'pessoas_categorias';
    }
    
    public function rules()
    {
        return [
            [['codigo_pessoa', 'codigo_categoria'], 'required'],
            // [['codigo_pessoa'], 'exist', 'skipOnError' => true, 'targetClass' => Pessoas::class, 'targetAttribute' => ['codigo_pessoa' => 'codigo']],
            // [['codigo_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::class, 'targetAttribute' => ['codigo_categoria' => 'codigo']],
        ];
    }

    public function getPessoa() {
        return $this->hasOne(Pessoas::class, ['codigo' => 'codigo_categoria']);
    }

    public function getCategoria() {
        return $this->hasOne(Categorias::class, ['codigo' => 'codigo_categoria']);
    }

}