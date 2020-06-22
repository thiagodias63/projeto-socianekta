<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\helpers\FormatHelper;

class Pessoas extends ActiveRecord {
     /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pessoas';
    }
    public function rules()
    {
        return [
            [['nome', 'cpf'], 'required'],
            [['celular', 'data_nascimento', 'email'], 'safe'],
            // [['data_nascimento'], 'date'],
            [['email'], 'email'],
            [['cpf', 'celular'], 'string', 'max' => 11],
        ];
    }

    /**
    * Gets query for [[PessoasCategorias]].
    *
    * @return \yii\db\ActiveQuery
    */
    public function getCategorias()
    {
        return $this->hasMany(PessoasCategorias::class, ['codigo_pessoa' => 'codigo']);
    }

    public function removerMascaras()
    {
        $this->celular = FormatHelper::removeTelefoneMask($this->celular);
        $this->cpf = FormatHelper::removeCpfMask($this->cpf);
        // $this->data_nascimento = isset($this->data_nascimento) ? FormatHelper::DateToInsert($this->data_nascimento) : null;
    }

    public function adcionarMascaras()
    {
        $this->celular = "(".substr($this->celular, 0, 2). ") ". substr($this->celular, 2, 5) ."-". substr($this->celular, 7, 5);
        $this->cpf = substr($this->cpf, 0, 3). ".". substr($this->cpf, 3, 3) .".". substr($this->cpf, 7, 3) ."-". substr($this->cpf, 9, 2);
        $this->data_nascimento = isset($this->data_nascimento) ? FormatHelper::DateToShow($this->data_nascimento) : '';
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->adcionarMascaras();
    }

    public function beforeSave($insert):bool
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->removerMascaras();
        return boolval($this->validate());
    }
    
}