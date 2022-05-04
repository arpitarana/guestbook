<?php

namespace App\Controller\User;

use App\Entity\User\User;
use App\Form\User\ChangePasswordType;
use App\Form\User\UserType;
//use App\Form\User\ChangePasswordType;
//use App\Managers\User\MailManager;
use App\Service\User\MailManager;
use App\Service\User\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

/**
 * User controller.
 *
 */
class UserController extends AbstractController
{
    /**
     * Creates a new user entity.
     *
     * @Route("/register", name="user_register")
     */
    public function new(Request $request, UserManager $userManager)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userManager->saveUser($user);
            return $this->redirectToRoute('app_login');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Generates new password
     *
     * @Route("/forgot-password", name="forgot_password")
     */
    public function forgotPassword(Request $request, MailManager $mailManager, UserManager $userManager)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->isMethod('POST')) {
            $email = $request->get('email');

            $user = $em->getRepository(User::class)->findOneByEmail($email);
            if ($user) {
                if ( $userManager->manageUpdatedPassword($user, $user->generatePassword())) {
                    if ( $mailManager->forgotPassword($user) ) {
                        $this->get('session')->getFlashBag()->add('flashSuccess', 'Password changed successfully!');
                        return $this->redirectToRoute('guests_list');
                    }
                    else {
                        $this->get('session')->getFlashBag()->add('flashErros', 'Mailer has some issue!');
                        return $this->redirectToRoute('guests_list');
                    }
                }
                else {
                    $this->get('session')->getFlashBag()->add('flashErros', 'Update password has some issue!');
                    return $this->redirectToRoute('guests_list');
                }

                $this->get('session')->getFlashBag()->set(
                    'flashSuccess',
                    'A new password has been sent to '.$email
                );
            } else {
                $this->get('session')->getFlashBag()->set(
                    'flashError',
                    'This email is not registered.'
                );
            }

            return $this->redirectToRoute('app_login');
        }

        return $this->render(
            'user/forgot_password.html.twig'
        );
    }

    /**
     * Change password of a user
     *
     * @Route("/user/changepassword", name="change_password")
     */
    public function changePassword(Request $request, UserManager $userManager, MailManager $mailManager)
    {
        $form = $this->createForm(ChangePasswordType::class, $this->getUser());
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                /* @var User $user */
                $user = $this->getUser();
                if ( $userManager->manageUpdatedPassword($user, $user->getRawPassword())) {
                    if ( $mailManager->changePasswordEmail($user) ) {
                        $this->get('session')->getFlashBag()->add('flashSuccess', 'Password changed successfully!');
                        return $this->redirectToRoute('guests_list');
                    }
                    else {
                        $this->get('session')->getFlashBag()->add('flashErros', 'Mailer has some issue!');
                        return $this->redirectToRoute('guests_list');
                    }
                }
                else {
                    $this->get('session')->getFlashBag()->add('flashErros', 'Update password has some issue!');
                    return $this->redirectToRoute('guests_list');
                }
            }
        }

        return $this->render(
            'user/change_password.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }
}
