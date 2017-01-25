<?php
header("Content-type: application/json; charset=utf-8");

$client = new SoapClient('http://ws.correios.com.br/calculador/CalcPrecoPrazo.asmx?WSDL');
$function = 'CalcPrecoPrazo';
$arguments = array('CalcPrecoPrazo' => array(
        'nCdEmpresa' => 0,
        'sDsSenha' => '',
        'nCdServico' => $_POST['cdServico'],
        'sCepOrigem' => '08653300',
        'sCepDestino' => $_POST['cep'],
        'nVlPeso' => 0,
        'nCdFormato' => 1,
        'nVlComprimento' => 16,
        'nVlAltura' => 2,
        'nVlLargura' => 11,
        'nVlDiametro' => 0,
        'sCdMaoPropria' => 'N',
        'nVlValorDeclarado' => 0,
        'sCdAvisoRecebimento' => 'N'
    )
);

$options = array('location' => 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.asmx');
$result = $client->__soapCall($function, $arguments, $options);

echo json_encode(array("valor" => $result->CalcPrecoPrazoResult->Servicos->cServico->Valor));
