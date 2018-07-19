<?php
/**
 * Created by PhpStorm.
 * User: Froz1
 * Date: 7/18/2018
 * Time: 11:46 PM
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AuthenticationController extends Controller
{

    public function loginAction(){
//        if($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_ANONYMOUSLY'))
//            return $this->redirect($this->generateUrl('jira_auth_login_path'));


//        $error = $this->get('session')->get(SecurityContextInterface::AUTHENTICATION_ERROR);
//        $authenticationError = $error instanceof AuthenticationException ? $error->getMessage() : '';

        $authenticationError = 'some error';
        return $this->render('AppBundle:Authentication:login.html.twig', array('error' => $authenticationError));
    }
    /**
     * Firewall перехватит выполнение метода
     */
    public function checkAuthenticationAction(){
    }
    /**
     * Firewall перехватит выполнение метода
     */
    public function logoutAction(){
    }
}