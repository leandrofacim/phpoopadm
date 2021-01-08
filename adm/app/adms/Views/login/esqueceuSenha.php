<body class="text-center">
    <form class="form-signin" method="POST" action="">
        <img 
            class="mb-4" 
            src="<?= URLADM . 'assets/imagens/logo_login/logo.png' ?>" 
            alt="LF" width="72" 
            height="72">
        <h1 class="h3 mb-3 font-weight-normal">Recuperar Senha</h1>
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
            <label>E-mail</label>
            <input 
                name="email" 
                type="email" 
                class="form-control" 
                placeholder="Digite o email cadastrado" 
                value="<?= isset($valorForm['email']) ? $valorForm['email'] : '' ?>">
        </div>
        <input 
            name="recuperaSenha" 
            class="btn btn-lg btn-primary btn-block" 
            type="submit" 
            value="Recuperar">
            
        <p class="text-center">Já possui cadastro? <a href="<?= URLADM . 'login/acesso'?>">Clique aqui</a>para entrar</p>
    </form>
</body>
