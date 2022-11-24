<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./arq/estiloPonto.css">

        <style>

            h4{

                margin-top: 20%;

            }

        </style>
        <title>Document</title>

    </head>
    <body>

        <main>

            <?php

                require './arq/Conexao.php';  
                require './arq/Processamento.php';
                
                
                $hoje = date("Y/m/d");
                $consulta = date("d/m/Y");
                $consultaTempo = new Processamento(0, $consulta, 0, 0);

                $queriInfoBatida = "SELECT batida01, batida02, batida03, batida04 from registrospontos WHERE dataBD = '$hoje'";
                $resultado01 = mysqli_query($conectaBD, $queriInfoBatida);

                $i = 0;

                echo "<table border='1'>
                    <thead>
                        <tr><th colspan='2'><label>Informações do Rgistro da Batida</label></th></tr>
                        <tr>
                            <th class='compr'>Data da Batida</th>
                            <th class='compr'>Hora da Batida</th>
                        </tr>
                    </thead>";
                while ($row = mysqli_fetch_array($resultado01)) {

                    echo "<tbody>
                            <tr>
                                <td>Batida_01</td>
                                <td>".$row['batida01']."</td>
                            </tr>
                            <tr>
                                <td>Batida_02</td>
                                <td>".$row['batida02']."</td>
                            </tr>
                            <tr>
                                <td>Batida_03</td>
                                <td>".$row['batida03']."</td>
                            </tr>
                            <tr>
                                <td>Batida_04</td>
                                <td>".$row['batida04']."</td>
                            </tr>
                        </tbody>";
                }
                $mostraColunasCheias = $consultaTempo->colunasCheias() + 2;
                $h1 = $consultaTempo->consultaTabela($mostraColunasCheias);
                $h2 = $consultaTempo->consultaTabela(3);

                $mostraTempo = $consultaTempo->somaDasHoras($h1, $h2);
                
                if($mostraColunasCheias > 2){
                    
                    $horaSemIntervalo = DateTime::createFromFormat("H:i:s",$mostraTempo);

                    $intervalo = new DateInterval('PT1H');
                    $horaSemIntervalo->sub($intervalo);

                    echo "hora alterada <br>__:".$horaSemIntervalo->format('H:i:s');
                
                } else {
                    echo "Horas trabalhadas até o momento: <br>".$mostraTempo."<br>";
                }


            ?>
            
            
        </main>
        
        
        
    </body>
</html>