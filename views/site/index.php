<?php
/* @var $this yii\web\View */
$this->title = 'Socianekta - Home';
?>
<div class="site-index row">
    <div class="col-md-6 brand-image">
    </div>
    <div class="col-md-6 main">
        <h1 class="main__title">Bem-vindo a <span class="brandname">Socianekta</span></h1>
        <h3 class="main__subtitle">Novo aqui? Cadastre-se agora</h3>
           <?= $this->render('cadastrar', [
               'categorias' => $categorias,
           ]) ?>
    </div>
</div>
