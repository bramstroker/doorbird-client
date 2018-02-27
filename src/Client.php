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
    const EVENT_TYPE_DOORBELL = 'doorbell';
    const EVENT_TYPE_MOTION = 'motionsensor';
    const EVENT_TYPE_DOOROPEN = 'dooropen';

    /**
     * @var GuzzleClient
     */
    protected $guzzleClient;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $pass;

    /**
     * Client constructor.
     */
    public function __construct(string $host, string $user, string $pass)
    {
        $this->guzzleClient = new GuzzleClient(
            [
                'base_uri' => 'https://' . $host,
                'verify' => false
            ]
        );
        $this->user = $user;
        $this->pass = $pass;
    }

    /**
     * @param string $path
     * @param array $params
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function request(string $path, array $params = [])
    {
        return $this->guzzleClient->request(
            'GET',
            'bha-api/' . $path,
            [
                'auth' => [
                    $this->user,
                    $this->pass
                ],
                'query' => $params
            ]
        );
    }

    /**
     * Request a live image
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function liveImage()
    {
        return $this->request('image.cgi');
    }

    /**
     * Open the door using the dooropener relay
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function openDoor()
    {
        return $this->request('open-door.cgi');
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function lightOn()
    {
        return $this->request('light-on.cgi');
    }

    /**
     * Register a notification hook
     *
     * @param string $url
     * @param string $event
     * @param bool $subscribe
     * @param int $relaxation
     * @param string|null $test
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function notification(string $url, string $event, bool $subscribe = true, int $relaxation = 10, string $test = null)
    {
        $params = [
            'url' => $url,
            'event' => $event,
            'subscribe' => ($subscribe) ? 1 : 0,
            'relaxation' => $relaxation,
        ];
        if ($test !== null) {
            $params['test'] = $test;
        }
        return $this->request('notification.cgi', $params);
    }
}