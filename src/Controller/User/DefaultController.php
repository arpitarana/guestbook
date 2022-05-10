<?php

namespace App\Controller\User;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class DefaultController
 * @package App\Controller\User
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function loginRedirect(Request $request)
    {
        return $this->redirectToRoute('app_login');
    }
}
