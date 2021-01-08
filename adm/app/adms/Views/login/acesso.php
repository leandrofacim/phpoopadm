<body class="text-center">
    <form class="form-signin" method="POST" action="">
        <img 
            class="mb-4" 
            src="<?= URLADM . 'assets/imagens/logo_login/logo.png' ?>" 
            alt="LF" width="72" 
            height="72">
        <h1 class="h3 mb-3 font-weight-normal">Área Restrita</h1>
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
            <label>Usuário</label>
            <input 
                name="usuario" 
                type="text" 
                class="form-control" 
                placeholder="Digite o usuário" 
                value="<?= isset($valorForm['usuario']) ? $valorForm['usuario'] : '' ?>">
        </div>
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
            name="sendLogin" 
            class="btn btn-lg btn-primary btn-block" 
            type="submit" 
            value="Acessar">
           
            <p 
                class="text-center">
                <a href="<?= URLADM . 'novo-usuario/novo-usuario'?>">Cadastrar</a> 
                - <a href="<?= URLADM . 'esqueceu-senha/esqueceu-senha'?>">Esqueceu a senha?</a>
            </p>
    </form>
</body>
