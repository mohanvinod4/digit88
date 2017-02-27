<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Controller\BaseController;

/**
 * Description of IndexController
 *
 * @author mindfire
 */
class IndexController extends BaseController {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        $session = $request->getSession();
        $user = $session->get('user');
        $email = trim($request->get('inputEmail'));
        $password = trim($request->get('inputPassword'));
        $error['emailData'] = $email;
        $error['emailError'] = '';
        $error['passwordData'] = $password;
        $error['passwordError'] = '';

        // If none of the details present show log in form
        if (!$user && !$email && !$password) {
            return $this->render('AppBundle::index.html.twig', $error);
        }

        // Check session is present or not
        if (!$user) {

            // Validate email
            if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['emailError'] = 'Invalid Email';
            }

            // Validate password
            if (strlen($password) < 5) {
                $error['passwordError'] = 'Invalid Password';
            }

            $em = $this->getDoctrine()->getManager();
            $userObj = $em->getRepository('AppBundle:User')->findOneBy(array('email' => $email, 'enabled' => true));
            if (!$userObj || md5($password) != $userObj->getPassword()) {
                $error['emailError'] = 'Email/Password Is not valid';
                return $this->render('AppBundle::index.html.twig', $error);
            }
        } else {
            $userObj = $user['userObj'];
        }
        $userData = $this->setUserSessionData($session, $userObj);
        $orderData = $this->getOrderData();

        return $this->render('AppBundle::dashboard.html.twig', array('user' => $userData, 'order' => $orderData));
    }

}
