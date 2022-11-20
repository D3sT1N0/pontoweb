<?php


class Processamento {
    
    
    private $pegaDia;
    private $pegaData;
    private $pegaHora;
    private $pegaID;
    private $dataConvertida;
    
    
    
    public function __construct($pegDi, $pegDa, $pegH, $pegID) {
        
       
        $this->pegaDia = $pegDi;
        $this->pegaData = $pegDa;
        $this->pegaHora = $pegH;
        $this->pegaID = $pegID;
        
        $this->dataConvertida = $this->pegaData;
        $dataTemporaria = DateTime::createFromFormat("d/m/Y", $this->pegaData);
        $this->pegaData = $dataTemporaria->format("Y/m/d");
    }

    public function insereBatida01 (){
        
        require './arq/Conexao.php';

        $queriBatida01 = "INSERT INTO registrospontos (diaBD, dataBD, batida01, ipBD) VALUES (?, ?, ?, ?)";


        //$queriBatida01 = "INSERT INTO registrospontos (diaBD, dataBD, batida01, ipBD) VALUES ('$this->pegaDia','$this->pegaData','$this->pegaHora','$this->pegaID')";
        
        $executaBatida01 = mysqli_prepare($conectaBD, $queriBatida01);
        mysqli_stmt_bind_param($executaBatida01,'ssss', $aa, $bb, $cc, $dd);
        $aa = $this->pegaDia;
        $bb = $this->pegaData;
        $cc = $this->pegaHora;
        $dd = $this->pegaID;
        
        mysqli_execute($executaBatida01);
        
    }
    
    public function insereBatida02() {
        
        require './arq/Conexao.php';
        
        $queriBatida02 = "UPDATE registrospontos SET batida02 = '$this->pegaHora' WHERE dataBD = '$this->pegaData'";
        $preparaBatida02 = mysqli_prepare($conectaBD, $queriBatida02);
        $resultadoBatida02 = mysqli_execute($preparaBatida02);
        
        //echo "Batida 02 alterada";
    } 
    
        public function insereBatida03() {
        
        require './arq/Conexao.php';
        
        $queriBatida03 = "update registrospontos set batida03 = '$this->pegaHora' where dataBD = '$this->pegaData'";
        $preparaBatida03 = mysqli_prepare($conectaBD, $queriBatida03);
        $resultadoBatida03 = mysqli_execute($preparaBatida03);
        
        //echo "Batida 03 alterada";
    } 
    
        public function insereBatida04() {
        
        require './arq/Conexao.php';
        
        $queriBatida04 = "update registrospontos set batida04 = '$this->pegaHora' where dataBD = '$this->pegaData'";
        $preparaBatida04 = mysqli_prepare($conectaBD, $queriBatida04);
        $resultadoBatida04 = mysqli_execute($preparaBatida04);
        
        //echo "Batida 04 alterada";
    } 
    
    public function numeroDeLinha() {
        
        require './arq/Conexao.php';
        
        $queriLinha = "select * from registrospontos where dataBD = '$this->pegaData'";
        $linha = mysqli_query($conectaBD, $queriLinha);
        $resultadoNumLinha = mysqli_num_rows($linha);
        
        return $resultadoNumLinha;
    }
    
        public function colunasVazias() {
        
        require './arq/Conexao.php';
        
        $queriVazio = "SELECT id, diaBD, dataBD,(batida01 is null) + (batida02 is null) + (batida03 is null) + (batida04 is null) AS total FROM registrospontos where dataBD = '$this->pegaData'";
        $colunaVazia = mysqli_query($conectaBD, $queriVazio);
        $resultadoLinhaVazia = mysqli_fetch_assoc($colunaVazia);
        
        return $resultadoLinhaVazia['total'];
    }
    
    public function comparaHora() {
        
        require './arq/Conexao.php';
        
        $queriBatidaSelecionada = "select id, (batida01 is not null) + (batida02 is not null) + (batida03 is not null) + (batida04 is not null)                 as Total from registrospontos WHERE dataBD = '$this->pegaData'";
        $qualBatida = mysqli_query($conectaBD, $queriBatidaSelecionada);
        $resultadoBatidaSelecionada = mysqli_fetch_assoc($qualBatida);
        
        $quantidadeBatidas = $resultadoBatidaSelecionada['Total'];
        
        $queriComparaBatida = "SELECT id, batida01, batida02, batida03, batida04 from registrospontos  WHERE dataBD = '$this->pegaData'";
        $horaVerificada = mysqli_query($conectaBD, $queriComparaBatida);
        $resultadohoraVerifica = mysqli_fetch_array($horaVerificada); 

        $horaSelecioda = $resultadohoraVerifica[$quantidadeBatidas];
        
        $start = strtotime($horaSelecioda);
        $end = strtotime($this->pegaHora);
        $menos = ($end - $start)/60;
        
        return $menos;
    }

    public function mandaEmail() {
        
        require './arq/Email.php';
              
        //$mail->Subject = 'Informacoes referente a Batida do Ponto';
        $mail->Body    = "A sua Batida foi registra com sucesso! <p></p>Abaixo as informações que foram inseridas. <p></p>
        
        <table border='1'>

                <tr style='background-color:#BCBCBC; height: 40px;'><th colspan='3'><label>Informações do Rgistro da Batida</label></th></tr>
                <tr>
                    <th style='background-color:#ffebcd; width: 140px;'>Data da Batida</th>
                    <th style='background-color:#ffebcd; width: 140px;'>Hora da Batida</th>
                    <th style='background-color:#ffebcd; width: 140px;'>Ip do Dispositivo</th>
                </tr>
            <tbody>
                <tr>
                    <td cellpadding=50px style = 'padding: 30px;'>".$this->dataConvertida."</td>
                    <td cellpadding=50px style = 'padding: 30px;'>".$this->pegaHora."</td>
                    <td cellpadding=50px style = 'padding: 30px;'>".$this->pegaID."</td>
                </tr>
            </tbody>
        </table>";
        $mail->send();
        echo " <p><br>Foi enviado um e-mail de confirmação para você.</p>.<p>Favor Verificar.</p> ";
        
    }
    
    
    public function getPegaDia() {
        return $this->pegaDia;
    }

    public function getPegaData() {
        
        return $this->pegaData;
    }

    public function getPegaHora() {
        return $this->pegaHora;
    }

    public function getPegaID() {
        return $this->pegaID;
    }

    public function setPegaDia($pegaDia): void {
        $this->pegaDia = $pegaDia;
    }

    public function setPegaData($pegaData): void {
        $this->pegaData = $pegaData;
    }

    public function setPegaHora($pegaHora): void {
        $this->pegaHora = $pegaHora;
    }

    public function setPegaID($pegaID): void {
        $this->pegaID = $pegaID;
    }


            
}
