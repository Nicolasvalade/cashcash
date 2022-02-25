<?php function get_msg_erreur($code_erreur){
    switch($code_erreur){
        case "":
            return "";

        // tech/interv_details
        case "tid1": 
            return "Aucun matériel.";
        case "tid2":
            return "Erreur de la mise à jour.";

        // admin/interv_details
        case "aid1":
            return "Choisissiez un technicien valide.";

        // admin/interv_edit
        case "aie1":
            return "Choisissez une date et une heure valides.";
        case "aie2":
            return "Choisissiez un technicien valide.";
        case "aie3":
            return "Echec de la modification.";
    }
}