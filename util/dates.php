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
