<?php 
    include_once "../config.php";
    $data = array();
    $token = $server->setToken();
    $_SESSION['token'] = $token->access_token;
    $seriesInfo = $server->getSeriesInfo($_POST['stu'] , $_POST['ser']);
    foreach($seriesInfo as $el) {

        $row=(object)array(
            "specCharSet"=>"",
            "imageType"=>array(),
            "instanceDate"=>"",
            "instanceTime"=>"",
            "SOPClass"=>"",
            "SOPInstance"=>"",
            "studyDate"=>"",
            "seriesDate"=>"",
        );
        $row->specCharSet = $el->{'00080005'}->Value[0];
        foreach($el->{'00080008'}->Value as $sub){
            array_push($row->imageType , $sub);
        }
        $row->instanceDate= $el->{'00080012'}->Value[0];
        $row->instanceTime= $el->{'00080013'}->Value[0];
        $row->SOPClass    = $el->{'00080016'}->Value[0];
        $row->SOPInstance = $el->{'00080018'}->Value[0];
        $row->studyDate   = $el->{'00080020'}->Value[0];
        $row->seriesDate  = $el->{'00080021'}->Value[0];
        // $row->contentDate = $el->{'00080023'}->Value[0];
        array_push($data,$row);
    }
    echo json_encode($data);