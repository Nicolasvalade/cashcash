<?php function get_all_clients()
{
    include_once 'db_config.php';
    $conn = getConnexion();
    $sql = "SELECT * FROM client;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $conn = null;
    return $result;
}
