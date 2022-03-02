<?php

/**
 * Biblioteca para manipulacao do ficheiro Json como DB para integracao com Moloni
 * Autor: Luis Gustavo Leal
 *        www.luisgustavo.dev
 */

# Ficheiro para registro das movimentacoes
$_file = 'db_moloni.json';


//
//Exemplo de utilizacao
//
# Leitura do ficheiro
echo readJson( $_file );
echo "<hr>";
# Adicionar registro (id_pagamento, id_invoice, status)
echo addJson('43', '123456', '1', $_file);
# Pesquisar registro
echo findJson('40',  $_file);


//
// Lista registros do ficheiro Json
//
function readJson( $_file ) {
   
    $_file = file_get_contents($_file);
    $json  = json_decode($_file);
    
    #Loop para percorrer o Objeto
    foreach($json as $registro):
        echo 'ID Pagamento: ' . $registro->id_pagamento . ' - ID Inovice: ' . $registro->id_invoice . '<br>';
    endforeach;

}


//
// Lista registros do ficheiro Json
//
function findJson( $payments_id , $_file ) {
   
    $_status = 0;

    $_file = file_get_contents($_file);
    $json  = json_decode($_file);
    
    #Loop para percorrer o Objeto
    foreach($json as $registro) {

        # Verifica se existe o ID do pagamento no arquivo Json
        if ($registro->id_pagamento == $payments_id) {
            ####echo '=> ID Pagamento: ' . $registro->id_pagamento . ' - ID Inovice: ' . $registro->id_invoice . '<br>';    
            $_status = 1;
        }
        
    }

    return $_status;

}


//
// Adiciona movimentacao no ficheiro Json
//
function addJson( $payments_id, $invoice_id, $status, $_file ) {

    # Valores de teste
    $invoice = array(
        'id_pagamento'   => $payments_id,
        'id_invoice'     => $invoice_id,
        'status'         => $status
    );

    # Extrai a informação do ficheiro
    $string = file_get_contents($_file);
    # Faz o decode o json para uma variavel php que fica em array
    $json = json_decode($string, true);
    # Adiciona a nova linha ao ao array assignment
    $json[] = $invoice;

    # Abre o ficheiro em modo de escrita
    $fp = fopen($_file, 'w');
    # Escreve no ficheiro em json
    fwrite($fp, json_encode($json));
    # Fecha o ficheiro
    fclose($fp);

}



?>


