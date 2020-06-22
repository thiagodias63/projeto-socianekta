<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
class Categorias extends ActiveRecord {
    
    /**
     * {@inheritdoc}
    */
    public static function tableName()
    {
        return 'categorias';
    }
    
    public function rules()
    {
        return [
            [['codigo', 'descricao'], 'required'],
            ['codigo', 'string', 'min' => 3, 'max' => 3],
            ['descricao', 'string', 'max' => 50]
        ];
    }

    public function getPessoas() {
        return $this->hasMany(PessoasCategorias::class, ['codigo' => 'codigo_categoria']);
    }

}