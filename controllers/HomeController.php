<?php
function homeAction()
{
    $allStatus = getAllStatus();
    $allUser = [];
    global $isConnected;
    if ($isConnected) {
        $monId = $_SESSION["user"]["id"];
        $allUser = getAllOtherUsers($monId); //Sauf moi même
    }
    //Toutes les personnes où je ne suis pas encore amis
    HomePage($allStatus, $allUser);
}
