<?php

declare(strict_types=1);

namespace App\adms\Models\helper;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Classe Para envio de email
 *
 * @author leandro
 */
class AdmsPhpMailer
{
    private bool $resultado;
    private array $dadosCredEmail;
    private array $dados;

    public function getResultado()
    {
        return $this->resultado;
    }
    
    /**
     * Metodo busca configurações de hots para envio de email,
     * e ex ecuta o metodo confiEmail para enviar email
     * 
     * @param array $dados dados do envio do email
     * 
     * @return void 
     */
    public function emailPhpMailer(array $dados): void
    {
        $this->dados = $dados;

        $credEmail = new \App\adms\Models\helper\AdmsRead();
        $credEmail->fullRead("SELECT * FROM adms_confs_emails WHERE id =:id LIMIT :limit", "id=1&limit=1");
        $this->dadosCredEmail = $credEmail->getResultado();

        if ((isset($this->dadosCredEmail[0]['host'])) && (!empty($this->dadosCredEmail[0]['host']))) {
            $this->confiEmail();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário
                as credenciais do e-mail no administrativo 
                para enviar e-mail inserir</div>";
            $this->resultado = false;
        }
    }

    /**
     * Metodo que instacia PHPMailer, e cnfigura os dados de envio de email
     * 
     * @return void
     */
    private function confiEmail(): void
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = $this->dadosCredEmail[0]['host'];
            $mail->SMTPAuth = true;
            $mail->CharSet = 'UTF-8';
            $mail->Username = $this->dadosCredEmail[0]['usuario'];
            $mail->Password = $this->dadosCredEmail[0]['senha'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $this->dadosCredEmail[0]['porta'];
            //Recipients
            $mail->setFrom($this->dadosCredEmail[0]['email'], $this->dadosCredEmail[0]['nome']);
            $mail->addAddress($this->dados['dest_email'], $this->dados['dest_nome']);
            // Content
            $mail->isHTML(true);
            $mail->Subject = $this->dados['titulo_email'];
            $mail->Body = $this->dados['cont_email'];
            $mail->AltBody = $this->dados['cont_text_email'];

            if ($mail->send()) {
                $this->resultado = true;
            } else {
                $this->resultado = false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->resultado = false;
        }
    }
}
