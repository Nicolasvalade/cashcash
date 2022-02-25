<?php

function creneaux($heure_debut = 8, $heure_fin = 17, $creneaux_par_heure = 4)
{
    // temps entre deux horaires
    $pas = 60 / $creneaux_par_heure;

    // si on ne peut pas diviser une heure en parts égales, on annule tout
    if (60 % $pas !== 0) return array();

    $options = [];
    $heure = $heure_debut;
    for ($i = 0; $heure < $heure_fin; $i++) {
        $minutes = $pas * ($i % $creneaux_par_heure);
        $options[] = [
            "value" => sprintf("%02d:%02d:00", $heure, $minutes),
            "label" => sprintf("%02d:%02d", $heure, $minutes)
        ];

        // si dernier créneau de l'heure, passer à l'heure suivante
        if ($i % $creneaux_par_heure === $creneaux_par_heure - 1) $heure++;
    }
    return $options;
}

function date_heure_sql($date, $heure)
{
    if($date == null || $heure == null) return false;
    
    // MySQL
    return sprintf("%s %s", $date, $heure);

    // PostgreSQL
    // return sprintf("%sT%sZ", $date, $heure);
}


function date_input($date_heure)
{
    $date = substr($date_heure, 0, 10);
    $date = $date != "1970-01-01" ? $date : "";
    return $date;
}

function heure_input($date_heure)
{
    $heure = substr($date_heure, 11, 8);
    $heure = $heure != "00:00:00" ? $heure : "";
    return $heure;
}

function date_locale($date_heure)
{
    $y = substr($date_heure, 0, 4);
    $m = substr($date_heure, 5, 2);
    $d = substr($date_heure, 8, 2);
    return sprintf("%s/%s/%s", $d, $m, $y);
}

function heure_courte($date_heure)
{
    return substr($date_heure, 11, 5);
}
