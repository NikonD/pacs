<?php
    include_once "../config.php";
    $res = $server->getStudies($_POST['iin']);
    echo json_encode($res);
    