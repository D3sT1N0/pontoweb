<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./arq/estiloPonto.css">

    <style>
       
        h4{
            
            margin-top: 40%;
            
        }
        
    </style>
    <title>Document</title>
    
</head>
<body>

    <main>

        <?php

        require './arq/Conexao.php';  
        require './arq/Processamento.php';
        
        
        $hoje = date("d/m/Y");
        $agora = date("H:i");
        
        
        $queriBatida01 = "SELECT id,batida01, batida02, batida03, batida04 FROM registrospontos where dataBD = '$hoje' ";// where dataBD = '$hoje'";
        //$queriBatida = "SELECT SUM(batida01) as total FROM registrospontos";// where dataBD = '$hoje'";
        
        $consultaBatida01 = mysqli_query($conectaBD, $queriBatida01);
        //$mostraBatida = mysqli_fetch_assoc($consultaBatida);
      /*  
        while ($row = mysqli_fetch_assoc($consultaBatida)) {
           //extract($mostraBatida);
            
            echo "            
                
                <table border='1'>
                    <thead>
                        <tr><th colspan='2'><label>Informações do Rgistro da Batida</label></th></tr>
                        <tr>
                            <th class='compr'>Data da Batida</th>
                            <th class='compr'>Hora da Batida</th>
                        </tr>
                    </thead>";
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
                    </tbody>
 
                </table>";
        }

        $i = 1;
        while ($linha = mysqli_fetch_array($consultaBatida)) {
            
*/           echo $hoje."<br>"; 
            $impo = new Processamento(0, $hoje, 0, 0);
            
            echo $impo->colunasVazias();
       
        ?>
        
            <a href="index.html" ><h4>Volta</h4></a>
        
    </main>
    
</body>
</html>