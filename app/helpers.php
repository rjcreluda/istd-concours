<?php

function niveau_etude( $n ){
  switch( $n ){
    case 1:
      $niveau = 'dts';
      break;
    case 2:
      $niveau = 'dtss';
      break;
    case 3:
      $niveau = 'ingéniorat';
      break;
    default:
      $niveau = '';
      break;
  }
  return $niveau;
}

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

function mySql_date_concours( $date1, $date2 ){
    $tabDate1 = explode('-' , $date1);
    $tabDate2 = explode('-' , $date2);
    return $tabDate1[2] . ' et ' . $tabDate2[2] . '/' . $tabDate2[1] . '/' . $tabDate2[0];
}

function activeConcours(){
  return \App\Models\Concour::where('active', 1)->get()->first();
}
// Afficher nombre avec deux decimal, ex: 15,00
function format_note( $nombre, $decimal = 0 ){
  $note = sprintf('%.'.$decimal.'f', $nombre); // formattage en deux decimal
  return str_replace('.', ',', $note);
}