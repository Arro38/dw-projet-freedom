<?php
function homeAction()
{
    $allStatus = getAllStatus();
    $allUser = [];
    $allRequestedUser = [];
    $allRequestFromOtherUser = [];
    $allFriends = [];
    global $isConnected;
    if ($isConnected) {
        $monId = $_SESSION["user"]["id"];
        $allRequestedUser = getUserRequest($monId);
        $allUser = getAllOtherUsers($monId); //Sauf moi même
        $allRequestFromOtherUser = getAllRequestFromOtherUser($monId); //Sauf moi même
        $allFriends = getAllFriend($monId);
    }
    //Toutes les personnes où je ne suis pas encore amis
    HomePage($allStatus, $allUser, $allRequestedUser, $allRequestFromOtherUser, $allFriends);
}
