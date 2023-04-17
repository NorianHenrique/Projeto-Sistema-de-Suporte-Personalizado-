<?php
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;

	if(isset($_POST['responder_novo_chamado'])){
		$token = $_POST['token'];
		$email = $_POST['email'];
		$mensagem = $_POST['mensagem'];

		$sql = \MySql::conectar()->prepare("INSERT INTO interacao_chamado VALUES (null,?,?,?,1)");
		$sql->execute(array($token,$mensagem,1));
		//envio de e-mail
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
		    $mail->setFrom('conhecimentogame@gmail.com', 'Norian Henrique');
		    $mail->addAddress($email, '');

		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->CharSet = "UTF-8";
		    $mail->Subject = 'Nova interação no chamado: '.$token;
		    $url = BASE.'chamado?token='.$token;
		    $informacoes = '
		   	Uma nova interação foi feita no seu chamado!<br />Utilize o link abaixo para interagir:<br />
		    <a href="'.$url.'">Acessar chamado!</a>
		    ';
		    $mail->Body    = $informacoes;

		    $mail->send();
		} catch (Exception $e) {
		    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
		echo '<script>alert("Você respondeu o usuário!")</script>';
	}else if(isset($_POST['responder_nova_interacao'] )){
		$mensagem = $_POST['mensagem'];

		$token = $_POST['token'];

		$email = \MySql::conectar()->prepare("SELECT * FROM chamados WHERE token = ?");
		$email->execute(array($token));
		$email = $email->fetch()['email'];
		\MySql::conectar()->exec("UPDATE interacao_chamado SET status = 1 WHERE id = $_POST[id]");

		$sql = \MySql::conectar()->prepare("INSERT INTO `interacao_chamado` VALUES (null,?,?,1,1)");

		$sql->execute(array($token,$mensagem));

		//envio de e-mail
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
		    $mail->setFrom('conhecimentogame@gmail.com', 'Norian Henrique');
		    $mail->addAddress($email, '');

		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->CharSet = "UTF-8";
		    $mail->Subject = 'Nova interação no chamado: '.$token;
		    $url = BASE.'chamado?token='.$token;
		    $informacoes = '
		   	Uma nova interação foi feita no seu chamado!<br />Utilize o link abaixo para interagir:<br />
		    <a href="'.$url.'">Acessar chamado!</a>
		    ';
		    $mail->Body    = $informacoes;

		    $mail->send();
		} catch (Exception $e) {
		    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}

		echo '<script>alert("Você respondeu o usuário!")</script>';
	}
?>
<style type="text/css">
	textarea,input{
		width: 100%;
	}
	textarea{
		height: 120px;
	}
</style>
<h2>Novos chamados:</h2>
<?php
	$pegarChamados = \MySql::conectar()->prepare("SELECT * FROM chamados ORDER BY id DESC");
	$pegarChamados->execute();
	$pegarChamados = $pegarChamados->fetchAll();
	foreach ($pegarChamados as $key => $value) {
	$verificaInteracao = \MySql::conectar()->prepare("SELECT * FROM interacao_chamado WHERE id_chamado = '$value[token]'");
	$verificaInteracao->execute();
	if($verificaInteracao->rowCount() >= 1)
		continue;
?>
	<h2><?php echo $value['pergunta']; ?></h2>
	<form method="post">
		<textarea name="mensagem" placeholder="Sua resposta"></textarea>
		<br />
		<br />
		<input type="submit" name="responder_novo_chamado" value="Responder!">
		<input type="hidden" name="token" value="<?php echo $value['token']; ?>">
		<input type="hidden" name="email" value="<?php echo $value['email']; ?>">
	</form>
<?php } ?>
<hr>

<h2>Últimas interações:</h2>
<?php
	$pegarChamados = \MySql::conectar()->prepare("SELECT * FROM interacao_chamado WHERE admin = -1 AND status = 0 ORDER BY id DESC");
	$pegarChamados->execute();
	$pegarChamados = $pegarChamados->fetchAll();
	foreach ($pegarChamados as $key => $value) {
?>
	<h2><?php echo $value['mensagem']; ?></h2>
	<p>Clique <a href="<?php echo BASE ?>chamado?token=<?php echo $value['id_chamado']; ?>">aqui</a> para visualizar este chamado!</p>
	<form method="post">
		<textarea name="mensagem" placeholder="Sua resposta"></textarea>
		<br />
		<br />
		<input type="hidden" name="id" value="<?php echo $value['id']; ?>">
		<input type="submit" name="responder_nova_interacao" value="Responder!">
		<input type="hidden" name="token" value="<?php echo $value['id_chamado']; ?>">
	</form>
<?php } ?>