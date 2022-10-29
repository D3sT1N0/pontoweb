<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./arq/estiloPonto.css">
    <title>Document</title>
</head>
<body>

    <?php
    
        require_once './arq/InformaIP.php';
        date_default_timezone_set('America/Sao_Paulo');
        setlocale(LC_ALL, NULL);
        // setlocale(LC_ALL, 'pt-BR');  
        $data = date("d/m/Y");
    
        $Object01 = new DateTime();  
        $hora01 = $Object01->format("H:i");  
                
        $Object02 = new DateTime();  
        $data01 = $Object02->format('d/m/Y');  
        
    ?>
    
    <main>
    
        <form action="Executa.php" method="post">
            <label for="">Dia da Semana</label>
                <br><input type="text" name="ndia" id="iddiaform" size="10" value="<?php echo ucfirst( utf8_encode(strftime('%A'))); ?>"></br>
            <br><label for="">Data da Batida</label></br>
            <input type="text" name="ndata" id="iddataform" size="10" value="<?php echo $data01;?>">
            <br><br><label for="">Hora da Batida</label></br>
            <input type="time" name="nhora" id="idHoraform" value="<?php echo $hora01;   ?>"><br>
            <br><label for="">Ip do dispositivo </label></br>
            <input type="text" name="nid" id="" size="10" value="<?php echo mostraip();   ?>">
    
                <p><input type="submit" value="Enviar" id="butao"></p>
        </form>
    </main>
    
    
</body>
</html>