<?php

namespace App\Listeners;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use Symfony\Component\HttpFoundation\Cookie;

class AuthenticationSuccessListener
{
    private $jwtTokenTTL;

    private $cookieSecure = true;

    public function __construct($ttl)
    {
        $this->jwtTokenTTL = $ttl;
    }

    /**
     * This function is responsible for the authentication part
     *
     * @param AuthenticationSuccessEvent $event
     * @return JWTAuthenticationSuccessResponse
     */
    public function onAuthenticationSuccess(AuthenticationSuccessEvent $event)
    {
        /** @var JWTAuthenticationSuccessResponse $response */
        $response = $event->getResponse();
        $data = $event->getData();
        $tokenJWT = $data['token'];
        unset($data['token']);
        unset($data['refresh_token']);
        $event->setData($data);

        $response->headers->setCookie(new Cookie('BEARER', $tokenJWT, (new \DateTime())
            ->add(new \DateInterval('PT' . $this->jwtTokenTTL . 'S')), '/', $_ENV['DOMAIN'], $this->cookieSecure, true, false, 'strict'));

        return $response;
    }
}
