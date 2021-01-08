<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Editar Perfil</h2>
            </div>
            <div class="p-2">
                <a href="<?= URLADM . 'ver-perfil/perfil' ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
            </div>
        </div>
        <hr>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        if (isset($this->dados['form'])) {
            $valorForm = $this->dados['form'];
        }
        if (isset($this->dados['form'][0])) {
            $valorForm = $this->dados['form'][0];
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label><span class="text-danger">*</span> Nome</label>
                    <input 
                        name="nome" 
                        type="text" 
                        class="form-control" 
                        placeholder="Nome completo" 
                        value="<?php
                        if (isset($valorForm['nome'])) {
                            echo $valorForm['nome'];
                        } else {
                            echo '';
                        }
                        ?>">
                </div>
                <div class="form-group col-md-6">
                    <label><span class="text-danger">*</span> Apelido</label>
                    <input 
                        name="apelido" 
                        type="text" 
                        class="form-control" 
                        placeholder="Seu apelido" 
                        value="<?php
                        if (isset($valorForm['apelido'])) {
                            echo $valorForm['apelido'];
                        } else {
                            echo '';
                        }
                        ?>">
                </div>
                <div class="form-group col-md-6">
                    <label><span class="text-danger">*</span> E-mail</label>
                    <input 
                        name="email" 
                        type="email" 
                        class="form-control" 
                        placeholder="Seu melhor e-mail" 
                        value="<?php
                        if (isset($valorForm['email'])) {
                            echo $valorForm['email'];
                        } else {
                            echo '';
                        }
                        ?>">
                </div>
                <div class="form-group col-md-6">
                    <label><span class="text-danger">*</span> Usuário</label>
                    <input 
                        name="usuario" 
                        type="text" 
                        class="form-control" 
                        placeholder="Digite o Usuário" 
                        value="<?php
                        if (isset($valorForm['usuario'])) {
                            echo $valorForm['usuario'];
                        } else {
                            echo '';
                        }
                        ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input name="imagemAntiga" type="hidden" value="<?php
                    if (isset($valorForm['imagemaAntiga'])) {
                        echo $valorForm['imagemaAntiga'];
                    } elseif (isset($valorForm['imagem'])) {
                        echo $valorForm['imagem'];
                    }
                    ?>">
                    <label><span class="text-danger">*</span>Foto (150x150)</label><br>
                    <input name="imagem" type="file" onchange="previewImagem()">
                </div>
                <div class="form-group col-md-6">
                    <?php
                    if (isset($valorForm['imagem']) && !empty($valorForm['imagem'])) {
                        $imagemAntiga = URLADM . 'assets/imagens/usuario/' . $_SESSION['usuario_id'] . '/' . $_SESSION['usuario_imagem'];
                    } else {
                        $imagemAntiga = URLADM . 'assets/imagens/usuario/preview_img.png';
                    }
                    ?>
                    <img src="<?= $imagemAntiga ?>" alt="Imagem do usuario" class="img-thumbnail" style="width: 250px; height: 250px;" id="preview-user">
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input type="submit" value="Salvar" class="btn btn-warning" name="ediPerfil">
        </form>
    </div>
</div>