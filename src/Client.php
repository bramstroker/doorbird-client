<?php
/**
 * Created by PhpStorm.
 * User: Bram
 * Date: 15-2-2018
 * Time: 21:53
 */

namespace Doorbird;

use GuzzleHttp\Client as GuzzleClient;

class Client
{
    /**
     * @var GuzzleClient
     */
    protected $guzzleClient;

    public function __construct()
    {
        $this->guzzleClient = new GuzzleClient(
            [
                'base_uri' => 'https://192.168.178.165',
                'verify' => false
            ]
        );
    }

    public function request(string $path)
    {
        return $this->guzzleClient->request(
            'GET',
            'bha-api/' . $path,
            [
                'auth' => [
                    'ghamoc0001',
                    'vpUHc9YeuN'
                ]
            ]
        );
    }

    public function liveImage()
    {
        return $this->request('image.cgi');
    }

    public function openDoor()
    {
        return $this->request('open-door.cgi');
    }

    public function lightOn()
    {
        return $this->request('light-on.cgi');
    }
}