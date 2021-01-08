<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Perfil</h2>
            </div>
            <div class="p-2">
                <span class="d-none d-md-block">
                    <a href="<?= URLADM . 'editar-perfil/alterar-perfil' ?>" class="btn btn-outline-warning btn-sm">Editar</a>
                    <a href="<?= URLADM . 'alterar-senha/alterar-senha' ?>" class="btn btn-outline-danger btn-sm">Editar Senha</a>
                </span>
                <div class="dropdown d-block d-md-none">
                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ações
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                        <a class="dropdown-item" href="<?= URLADM . 'editar-perfil/alterar-perfil' ?>">Editar</a>
                        <a class="dropdown-item" href="<?= URLADM . 'alterar-senha/alterar-senha' ?>">Editar Senha</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
         <?php 
           if (isset($_SESSION['msg'])) {
               echo $_SESSION['msg'];
               unset($_SESSION['msg']);
           }
        ?>
        <dl class="row">
            <?php
            if (!empty($this->dados['dados_perfil'])) {
                extract($this->dados['dados_perfil'][0]);
            ?>
                <dt class="col-sm-3">Foto</dt>
                <dd class="col-sm-9">
                    <?php
                    if (!empty($_SESSION['usuario_imagem'])) {
                        echo "<img src='" . URLADM . "assets/imagens/usuario/" .
                            $_SESSION['usuario_id'] . "/" . $_SESSION['usuario_imagem'] . "'  
                        witdh='150' height='150'>";
                    } else {
                        echo "<img src='" . URLADM . "assets/imagens/usuario/icone_usuario.png'  witdh='150' height='150'>";
                    }
                    ?>
                </dd>

                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?= $id ?></dd>

                <dt class="col-sm-3">Nome</dt>
                <dd class="col-sm-9"><?= $nome ?></dd>
                
                <dt class="col-sm-3">Apelido</dt>
                <dd class="col-sm-9"><?= $apelido ?></dd>

                <dt class="col-sm-3">E-mail</dt>
                <dd class="col-sm-9"><?= $email ?></dd>


                <dt class="col-sm-3 text-truncate">Data do Cadastro</dt>
                <dd class="col-sm-9"><?= date('d/m/Y H:i:s', strtotime($created)) ?></dd>
            <?php } ?>

        </dl>
    </div>
</div>