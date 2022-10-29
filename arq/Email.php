<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
 
    //Load Composer's autoloader
    require './Lib/vendor/autoload.php';
    
   

    $mail = new PHPMailer(true);
    $mail->CharSet = 'utf-8';  

    try {
        
        
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.office365.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'brunoleal3@outlook.com';                     //SMTP username
        $mail->Password   = 'duzuobzkmfkowtmy';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;//ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('brunoleal3@outlook.com', 'Registro de Ponto');
        $mail->addAddress('brunoleal3@yahoo.com.br');     //Add a recipient
        $mail->addAddress('brunoleal3@gmail.com');   

        
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Informações referente a Batida do Ponto';
        /*$mail->Body    = "A sua Batida foi registra com sucesso! <br><p></p><p></p>Abaixo as informações inseridas. <p></p><p></p>
                <table border='1'>
                    
                    <thead>
                        <tr class='pintado'><th colspan='3'><label>Informações do Rgistro da Batida</label></th></tr>
                        <tr>
                            <th class='compr'>Data da Batida</th>
                            <th class='compr'>Hora da Batida</th>
                            <th class='compr'>Ip do Dispositivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>".$pegDa."</td>
                            <td>".$pegH."</td>
                            <td>".$pegID."</td>
                        </tr>
                    </tbody>
                </table>";
        //$mail->send();
        echo 'Message has been sent';
        
         * 
         */
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }