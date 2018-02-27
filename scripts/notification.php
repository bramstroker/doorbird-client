<?php
/**
 * Created by PhpStorm.
 * User: Bram
 * Date: 15-2-2018
 * Time: 21:59
 */

use Doorbird\Client;

include __DIR__ . '/../vendor/autoload.php';

$client = new Client();
$domoticzSwitchUrl = 'http://domoticz.home:8080/json.htm?type=command&param=switchlight&idx=1138&switchcmd=On';
$response = $client->notification($domoticzSwitchUrl, Client::EVENT_TYPE_DOORBELL, true, 10, true);