<?php 



function getPageLog() {
    return $_SERVER['REQUEST_URI'];
} 

function generateLogs() {
    $pageLog = getPageLog();
    $account = isConnected() ? $_SESSION['pseudo'] : 'Unknown';
    file_put_contents('./logs/logs.log',$account  .' :'  .$pageLog.' '.date('d/m/y H:i:s').PHP_EOL, FILE_APPEND);
}