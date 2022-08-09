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