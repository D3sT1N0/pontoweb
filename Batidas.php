<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./arq/estiloPonto.css">

        <style>

            h4{

                padding: 0px;

            }
            
            table{
                
                margin-top: 20px;
            }

        </style>
        <title>Document</title>

    </head>
    <body>

        <main id="idBatida">

            <?php

                require './arq/Conexao.php';  
                require './arq/Processamento.php';
                
                //$consulta = date("Y/m/d");
                //$tempo = date("Y/m/d") ;
                
                $hoje = date("Y/m/d");
                //$hoje = date("2022/11/22");
                
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
                                <td>Inicio Intervalo</td>
                                <td>".$row['batida02']."</td>
                            </tr>
                            <tr>
                                <td>Fim Intervalo</td>
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


                
                //echo "colunas  ".$mostraColunasCheias."<br>";
                //echo "ident__01   ". $mostraTempo;
                
               // echo "Total de Horas trabalhadas ".$mostraTempo." em $consulta";
                
                if ($mostraColunasCheias == 4) {
                    $mostraTempo = $consultaTempo->somaDasHoras($h1, $h2);
                    echo "Total de Horas trabalhadas ".$mostraTempo." em $consulta";
                }
                
                elseif($mostraColunasCheias > 4 && $mostraColunasCheias < 6){

                    $h1 = $consultaTempo->consultaTabela(4);
                    $h2 = $consultaTempo->consultaTabela(3);
                    $mostraTempo = $consultaTempo->somaDasHoras($h1, $h2);
                    echo "Total de Horas trabalhadas ".$mostraTempo." em $consulta";
                   
                    $h1 = new DateTime($consultaTempo->consultaTabela(5));
                    $h2 = new DateTime($consultaTempo->consultaTabela(4));
                    $diferenca1 = $h2->diff($h1);
                    echo "<p><br>Duração do Intervalo ".$diferenca1->format('%H:%I:%S')."</p>";
                    
                } else {
                    
                    $mostraTempo = $consultaTempo->somaDasHoras($h1, $h2);
                    $h1 = new DateTime($consultaTempo->consultaTabela(5));
                    $h2 = new DateTime($consultaTempo->consultaTabela(4));
                    
                    $horaSemIntervalo = new DateTime($mostraTempo);

                    $diferenca2 = $h2->diff($h1);
                    $horaSemIntervalo->sub($diferenca2);

                    
                    //echo "<br>diferenca___".$diferenca2->format('%H:%I:%S'); //este FORMAT é usado quando trabalhammos com DateTime
                    //echo "<br>Hora sem Inter   ".$horaSemIntervalo->format('%H:%I:%S');//deste jeito nao funciona
                    echo "<p><br>Total de Horas trabalhadas ".$horaSemIntervalo->format('H:i:s')." em $consulta <br></p>";
                    echo "<p>Duração do Intervalo ".$diferenca2->format('%H:%I:%S')."</p>";
                 }

                /*
                if($mostraColunasCheias < 3){
                    
                    

                    //$t01 = new DateTime($consultaTempo->consultaTabela(4));// Uma outra forma de escrever DateTime
                    //$t02 = new DateTime ($consultaTempo->consultaTabela(5));

                    //$difereca = $t01->diff($t02);
                    //echo "mostre __: ".$difereca->format('%H:%I:%S');
                    
                    //o codigo abaixo é para aprendizado ---------------------------
                    /*
                    $horaSemIntervalo = DateTime::createFromFormat("H:i:s",$mostraTempo); //uma forma de escrever Datetime

                    $intervalo = new DateInterval('PT1H');//para calcular as horas temos que usar alm do P o T tambem.
                    $horaSemIntervalo->sub($intervalo);

                    echo "hora alterada <br>__:".$horaSemIntervalo->format('H:i:s');//este FORMAT é usado quando trabalhammos com DateTime::createFromFormat
                     * 
                     *
                    
                    }elseif ($mostraColunasCheias > 3) {
                    
                        $t01 = new DateTime($consultaTempo->consultaTabela(4));// Uma outra forma de escrever DateTime
                        $t02 = new DateTime ($consultaTempo->consultaTabela(5));

                        $difereca = $t01->diff($t02);
                        echo "mostre __: ".$difereca->format('%H:%I:%S');   
                    }else {
                    echo "Horas trabalhadas até o momento: <br>".$mostraTempo."<br>";
                }
*/
            ?>
            <a href="index.html"><h4>Volta</h4></a>
            
        </main>
        
        
        
    </body>
</html>