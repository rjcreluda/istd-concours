<?php

function dateToMySQL($date){
    $tabDate = explode('/' , $date);
    $date  = $tabDate[2].'-'.$tabDate[1].'-'.$tabDate[0];
    return $date;
}

function mySqlToDate($date){
    $tabDate = explode('-' , $date);
    $date  = $tabDate[2].'/'.$tabDate[1].'/'.$tabDate[0];
    return $date;
}

function activeConcours(){
  return \App\Models\Concour::where('active', 1)->get()->first();
}
// Afficher nombre avec deux decimal, ex: 15,00
function format_note( $nombre, $decimal = 0 ){
  $note = sprintf('%.'.$decimal.'f', $nombre); // formattage en deux decimal
  return str_replace('.', ',', $note);
}