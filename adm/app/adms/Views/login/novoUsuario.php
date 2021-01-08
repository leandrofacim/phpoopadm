<body class="text-center">
    <form class="form-signin" method="POST" action="">
        <img 
            class="mb-4" 
            src="<?= URLADM . 'assets/imagens/logo_login/logo.png' ?>" 
            alt="LF" width="72" 
            height="72">
        <h1 class="h3 mb-3 font-weight-normal">Novo Usuário</h1>
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
            <label>Nome</label>
            <input 
                name="nome" 
                type="text" 
                class="form-control" 
                placeholder="Digite o nome completo" 
                value="<?= isset($valorForm['nome']) ? $valorForm['nome'] : '' ?>">
        </div>
        <div class="form-group">
            <label>E-mail</label>
            <input 
                name="email" 
                type="email" 
                class="form-control" 
                placeholder="Digite o email" 
                value="<?= isset($valorForm['email']) ? $valorForm['email'] : '' ?>">
        </div>
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
            name="cadUserLogin" 
            class="btn btn-lg btn-success btn-block" 
            type="submit" 
            value="Cadastrar">
            
        <p class="text-center">Já possui cadastro? <a href="<?= URLADM . 'login/acesso'?>">Clique aqui</a></p>
    </form>
</body>
