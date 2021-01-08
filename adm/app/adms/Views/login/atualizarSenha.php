<body class="text-center">
    <form class="form-signin" method="POST" action="">
        <img 
            class="mb-4" 
            src="<?= URLADM . 'assets/imagens/logo_login/logo.png' ?>" 
            alt="LF" width="72" 
            height="72">
        <h1 class="h3 mb-3 font-weight-normal">Atualizar Senha</h1>
        <?php 
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        if (isset($this->dados['form'])) {
            $valorForm = $this->dados['form'];
        }
        ?>
        <div class="form-group">
            <label>Senha</label>
            <input 
                name="senha" 
                type="password" 
                class="form-control" 
                placeholder="Digite a senha"
                value="<?= isset($valorForm['senha']) ? $valorForm['senha'] : '' ?>"
            >
        </div>
        <input 
            name="atualizarSenha" 
            class="btn btn-lg btn-warning btn-block" 
            type="submit" 
            value="Atualizar">
            
            <p class="text-center">Já possui cadastro? <a href="<?= URLADM . 'login/acesso'?>">Clique aqui</a> para entrar</p>
    </form>
</body>
