<?php
function homeAction()
{
    $allStatus = getAllStatus();
    $allUser = [];
    $allRequestedUser = [];
    global $isConnected;
    if ($isConnected) {
        $monId = $_SESSION["user"]["id"];
        $allRequestedUser = getUserRequest($monId);
        $allUser = getAllOtherUsers($monId); //Sauf moi même
    }
    //Toutes les personnes où je ne suis pas encore amis
    HomePage($allStatus, $allUser, $allRequestedUser);
}
