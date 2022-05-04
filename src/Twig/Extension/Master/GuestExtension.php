<?php

namespace App\Twig\Extension\Master;

use Twig\TwigFunction;
use Symfony\Component\DependencyInjection\ContainerInterface;

class GuestbookExtension extends \Twig_Extension
{
//    public function __construct(ContainerInterface $container)
//    {
//        $this->container = $container;
//    }

    public function getFunctions()
    {
        return [
            new TwigFunction('gravator_image_url', [$this, 'getGravator']),
        ];
    }

    public function getGravator($email)
    {
        $url = 'https://www.gravatar.com/avatar/';
        $email = md5( strtolower( trim( $email ) ) );
        $gravatorURL = $url.$email;
        return $gravatorURL;
    }
}
