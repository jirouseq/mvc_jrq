<?php

namespace library;

use DateTime;

class Log
{

    /**
     * method set
     * @param string message
     */

    public function set($message): void
    {
        $log = ROOT . 'errors' . DS . 'log.txt';
        $logMessage = 'time: ' . (new DateTime())->format('Y-m-d H:i:s') . ' message: ' . $message;
        $lockHandle = fopen($log, 'a');
        if (flock($lockHandle, LOCK_EX)) {
            fwrite($lockHandle, $logMessage . PHP_EOL);
            flock($lockHandle, LOCK_UN);
        }
        fclose($lockHandle);
    }
}
