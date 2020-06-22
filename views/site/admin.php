<?php
/* @var $this yii\web\View */
$this->title = 'Socianekta - Admin';
?>
<div class="site-admin">
    <div class="col-md-12">
        <h1 class="">Area administrativa da <span class="brandname">Socianekta</span></h1>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <td>#</td>
                    <td>nome</td>
                    <td>cpf</td>
                    <td>celular</td>
                    <td>email</td>
                    <td>data de nascimento</td>
                    <td>categorias</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pessoas as $pessoa) { ?>
                    <tr>
                        <td><?= $pessoa->codigo ?></td>
                        <td><?= $pessoa->nome ?></td>
                        <td><?= $pessoa->cpf ?></td>
                        <td><?= $pessoa->celular ?></td>
                        <td><?= $pessoa->email ?></td>
                        <td><?= $pessoa->data_nascimento ?></td>
                        <td>
                            <?php foreach($pessoa->categorias as $index => $categoria) { ?>
                                <?= $index == sizeof($pessoa->categorias) - 1 ? $categoria->categoria->descricao :  $categoria->categoria->descricao.', ' ?>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>



        </table>
    </div>
</div>
