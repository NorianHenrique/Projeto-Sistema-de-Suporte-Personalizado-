<?php
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;
?>
<html>
    <?php
        if(isset($_POST['acao'])){
            $email = $_POST['email'];
            $pergunta = $_POST['pergunta'];
            $token = md5(uniqid());
            $sql = \MySql::conectar()->prepare("INSERT INTO chamados VALUES (null,?,?,?)");
		    $sql->execute(array($pergunta,$email,$token));
            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
            try {
                //Server settings
                $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'conhecimentogame@gmail.com';                 // SMTP username
                $mail->Password = 'pimtbkkjjgjoouml';                           // SMTP password
                $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;  
                                                  // TCP port to connect to
    
                //Recipients
                $mail->setFrom('contato@nadsistemas.com', 'Norian Henrique');
                $mail->addAddress($email, '');
    
                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->CharSet = "UTF-8";
                $mail->Subject = 'Seu chamado foi aberto!';
                $url = BASE.'chamado?token='.$token;
                $informacoes = '
                Olá, seu chamado foi criado com sucesso!<br />Utilize o link abaixo para interagir:<br />
                <a href="'.$url.'">Acessar chamado!</a>
                ';
                $mail->Body    = $informacoes;
    
                $mail->send();
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
            /*Fim do envio de e-mail*/
            echo '<script>alert("Seu chamado foi aberto com sucesso! Você receberá no e-mail as informações para interagir.")</script>';
        }
    ?>


     
    <body>

    <style>
         input,textarea{
             width: 100%;
         }
         textarea{
            height: 120px;
         }
    </style>
         <h2>Abrir Chamado</h2>

         <form method="post">
            <input type="email" name="email" placeholder="Seu email"/>
                 </br>
                 </br>
              <textarea name="pergunta" placeholder="Qual sua pergunta ?"></textarea>
                 </br>
                 </br>
              <input type="submit" name="acao" value="Enviar"/>
         </form>
    </body>
</html>