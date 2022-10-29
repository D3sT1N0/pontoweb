
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

    <main>
        <?php


            
            require './arq/Processamento.php';
            //include './arq/Email.php';

            $pegDi = $_POST['ndia'];
            $pegDa = $_POST['ndata'];
            $pegH = $_POST['nhora'];
            $pegID = $_POST['nid'];




            $executaComando = new Processamento($pegDi, $pegDa, $pegH, $pegID);
            

            if ($executaComando->numeroDeLinha() == 0){

                $executaComando->insereBatida01();
                echo "Primeira batida registrada com sucesso!!<br>";
                $executaComando->mandaEmail();


            } elseif ($executaComando->comparaHora() >= 15) {

                switch ($executaComando->colunasVazias()){

                    case 3:
                        $executaComando->insereBatida02();
                        echo "<br>Segunda batida registrada com sucesso!!<br>";
                        $executaComando->mandaEmail();
                        
                        break;
                    case 2:
                        if ($executaComando->comparaHora() > 60) {

                        $executaComando->insereBatida03();
                        echo "<br>Terceira batida registrada com sucesso!!<br>";
                        $executaComando->mandaEmail();
                        
                        } else {

                            $restaMinutos = 60 - $executaComando->comparaHora();
                            echo "Você ainda não cumpriu seu intervalo por completo.<p> <br>Faltam <h3><strong>".$restaMinutos." minutos</strong></h3> para terminar.</p>";
                        }
                        break;
                    case 1:
                        $executaComando->insereBatida04();
                        echo "<br>Quarta batida registrada com sucesso!!<br>";
                        $executaComando->mandaEmail();
                        break;
                    default :
                        echo "<br>Batida não reconhecida. Tente Novamente";
                        break;
                }
            } else {
                echo "você tentou bater outra vez com menos de 15min";
                //<meta http-equiv="refresh" content="5; url=index.html">
            }

        ?>

        
    </main>
    <meta http-equiv="refresh" content="9; url=index.html">

</body>
</html>
