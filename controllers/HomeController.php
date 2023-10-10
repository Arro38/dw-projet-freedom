<?php
function homeAction()
{
    $allStatus = getAllStatus();
    HomePage($allStatus);
}
