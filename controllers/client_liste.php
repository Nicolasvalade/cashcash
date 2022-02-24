<?php
require_once 'models/client_arrays.php';
require_once 'models/client.php';
$client_array = get_all_clients();
require_once 'views/client_liste.php';
