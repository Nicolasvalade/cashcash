<?php
require_once 'models/client_arrays.php';
require_once 'models/client.php';
$f_id = isset($_POST['f_id']) ? $_POST['f_id'] : null;
$all_clients = get_all_clients();
require_once 'views/admin/client_liste.php';

