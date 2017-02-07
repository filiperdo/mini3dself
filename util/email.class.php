<?php

require_once 'util/class.phpmailer.php';
require_once 'models/user_model.php';

/**
 * Classe que configura todos os envios de emails do sistema
 * @author Filipe Rodrigues
 *
 */
class Email
{
    public $mail;
    public $corpoRodape;

    public function __construct()
    {
        $this->mail = new PHPMailer();

        // Define os dados do servidor e tipo de conexão
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $this->mail->isSMTP(true); // Define que a mensagem será SMTP

        $this->mail->SMTPAuth = true; // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
        $this->mail->Mailer = 'smtp';

        $this->mail->Host = 'mail.miniaturafacil.com.br'; // Endereço do servidor SMTP (caso queira utilizar a autenticação, utilize o host smtp.seudomínio.com.br)
        $this->mail->Username = 'noreplay@miniaturafacil.com.br'; // Usuário do servidor SMTP (endereço de email)
        $this->mail->Password = 'Inicial@123'; // Senha do servidor SMTP (senha do email usado)
     	//$this->mail->SMTPSecure = 'ssl';
     	//$this->mail->Port = 465; // 587

        $this->mail->isHTML(true);

		$this->mail->SMTPDebug = 0;
		//$this->mail->Port = AWS_PORT; // 587

        // Define o remetente
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $this->mail->From = "noreply@miniaturafacil.com.br"; // Seu e-mail
        $this->mail->FromName = "3D SELFIE"; // Seu nome

        $this->configurarDadosPadroes();
    }

    /**
     * Configura alguns dados padrões dos e-mail de ações
     * do sistema, como assunto e rodapé do corpo do e-mail
     */
    private function configurarDadosPadroes()
    {
        // Configura o rodape do corpo do e-mail a ser enviado

        $this->corpoRodape  = "<br/><br/>Grande abraço!<br/>";
        $this->corpoRodape .= "Equipe 3D SELFIE<br/>";
        $this->corpoRodape .= "<a href='http://www.miniaturafacil.com.br/' target='_blank'>www.miniaturafacil.com.br</a>";
    }

    /**
     * Envia um e-mail de acordo com
     * as configuração dos atributos
     */
    public function enviar()
    {
        // Define os anexos (opcional)
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

        // Envia o e-mail
        $enviado = $this->mail->Send();

        //echo $this->mail->Body;

        // Limpa os destinatários e os anexos
        $this->mail->ClearAllRecipients();
        $this->mail->ClearAttachments();


        if ($enviado)
        {
            echo 'Enviou';
            return true;
        }
        else
        {
            echo 'Não enviou';
            return false;
        }

    }

    public function sendOrder($id_order)
    {
    	$this->mail->Subject = "Pedido 3D Selfie";
    	$this->mail->AddAddress( 'filiperdo@gmail.com' );

    	// Envia uma copia do e-mail
    	//$this->mail->addBCC( '' );

        include_once 'models/order_product_model.php';
        $objOrderProduct = new Order_product_Model();

    	// Configura o corpo do email
    	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    	$this->mail->Body  = "Oi <strong>" . 'Maicon' . "</strong>, tudo bem?<br/>";
        $this->mail->Body .= "Você recebeu um pedido pelo site 3D Selfie!<br/><br/>";
        $this->mail->Body .= '<table cellpadding="6" cellspacing="0"  margin:0">';
        $this->mail->Body .= '<thead style="border:1px solid #ccc;">';
        $this->mail->Body .= '<tr >';
        $this->mail->Body .= '<th style="border:1px solid #ccc;">Cod.</th>';
        $this->mail->Body .= '<th style="border:1px solid #ccc;">Produto</th>';
        $this->mail->Body .= '<th style="border:1px solid #ccc;">Tamanho</th>';
        $this->mail->Body .= '<th style="border:1px solid #ccc;">Preço</th>';
        $this->mail->Body .= '</tr>';
        $this->mail->Body .= '</thead>';
        $this->mail->Body .= '<tbody>';

        foreach( $objOrderProduct->listarOrder_productByOrder($id_order) as $order )
        {
            $this->mail->Body .= '<tr>';
            $this->mail->Body .= '<th style="border:1px solid #ccc;">'.$order->getProduct()->getId_product().'</th>';
            $this->mail->Body .= '<th style="border:1px solid #ccc;">'.$order->getProduct()->getName().'</th>';
            $this->mail->Body .= '<th style="border:1px solid #ccc;">'.$order->getSize().'cm</th>';
            $this->mail->Body .= '<th style="border:1px solid #ccc;">'.Data::formataMoeda($order->getPrice()).'</th>';
            $this->mail->Body .= '</tr>';
        }

        $this->mail->Body .= '</tbody>';
        $this->mail->Body .= "</table>";
    	$this->mail->Body .= "<br><br>";
        $this->mail->Body .= "Enviar para <strong>" . $order->getOrder()->getUser()->getName() . ' - ' . $order->getOrder()->getUser()->getPhone1() .', ' . $order->getOrder()->getUser()->getEmail() . '</strong><br>';
        $this->mail->Body .= "Endereço: <strong>" . $order->getOrder()->getUser()->getAdress() . ', ' . $order->getOrder()->getUser()->getNumber() . ' - ' . $order->getOrder()->getUser()->getComplement() . ' - ' . $order->getOrder()->getUser()->getCep() . '</strong>';


    	$this->mail->Body .= $this->corpoRodape;
        //echo $this->mail->Body;
    	$enviar = $this->enviar();

    	return $enviar;

    }



    /**
     * Envia a senha para o email vinculado
     * @param unknown $email
     * @param unknown $senha
     * @return boolean
     */
    public function enviarSenhaRecuperada( User_Model $user )
    {

    	$this->mail->Subject = "Robo3D - Senha!";
    	$this->mail->AddAddress( $user->getEmail() );

    	// Configura o corpo do email
    	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    	$this->mail->Body  = "Oi <strong>" . $user->getLogin() . "</strong>, tudo bem?<br/>";
    	$this->mail->Body .= "Sua senha foi recuperada com sucesso!<br/><br/> ";

    	$this->mail->Body .= "Para você não esquecer:<br/> ";
    	$this->mail->Body .= "Endereço do portal: <a href='".URL."'>" . URL . '</a><br/>';
    	$this->mail->Body .= "Seu login: <strong>" . $user->getLogin() . "</strong><br/>";
    	$this->mail->Body .= "Sua senha: <strong>" . $user->getPassword() . "</strong><br/>";

    	$this->mail->Body .= $this->corpoRodape;

    	$enviar = $this->enviar();

    	return $enviar;

    }


    /**
     * Teste de envio
     * @return unknown
     */
    public function teste_envio()
    {
    	$this->mail->Subject = "Robo3D - Teste!";
    	$this->mail->AddAddress( 'filiperdo@gmail.com' );

    	// Configura o corpo do email
    	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    	$this->mail->Body  = "Oi <br/>";


    	$this->mail->Body .= $this->corpoRodape;

    	$enviar = $this->enviar();

    	return $enviar;
    }

}
?>
