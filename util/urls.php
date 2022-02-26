<?php function url_maps($adresse)
{
    $incorrects = array("\n", ",", " ");
    $corrects = array("+", "%2C", "+");
    return str_replace($incorrects, $corrects, $adresse);
}
