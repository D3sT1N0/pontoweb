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
        
        
        $hoje = date("Y/m/d");
        
        $queriBatida = "SELECT dataBD, batida01, batida02, batida03, batida04 FROM registrospontos where dataBD = '$hoje'";
        
        $consultaBatida = mysqli_query($conectaBD, $queriBatida);
        //$mostraBatida = mysqli_fetch_assoc($consultaBatida);
        
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

        ?>
        
            <a href="index.html" ><h4>Volta</h4></a>
        
    </main>
    
</body>
</html>