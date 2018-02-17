<?php
/**
 * Created by PhpStorm.
 * User: Bram
 * Date: 15-2-2018
 * Time: 21:59
 */

include __DIR__ . '/../vendor/autoload.php';

$client = new \Doorbird\Client();
$response = $client->openDoor();