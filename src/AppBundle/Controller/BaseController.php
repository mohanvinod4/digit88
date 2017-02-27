<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Description of BaseController
 *
 * @author mindfire
 */
class BaseController extends Controller {

    function setUserSessionData(Session $session, User $user) {
        $userArray = array('userID' => $user->getId(), 'userName' => $user->getUsername(), 'userObj' => $user);
        $session->set('user', $userArray);

        return $userArray;
    }

    function getOrderData() {
        $em = $this->get('doctrine')->getManager();
        $orderData = $em->getRepository('AppBundle:Order')->getAllOrders();
        
        return $this->parseOrderData($orderData);
    }

    function parseOrderData(array $orderData) {

        $orderDetails = array();
        $orderID = '';
        $i = $j = 0;
        foreach ($orderData as $value) {
            if ($orderID != $value['orderID']) {
                $j = $i;
                $i++;
                $orderID = $value['orderID'];
                $orderDetails[$j]['orderID'] = $orderID;
                //ladybug_dump_die($value['createdDateTime']);
                $orderDetails[$j]['orderDate'] = $value['createdDateTime'];
                $orderDetails[$j]['orderStatus'] = $value['orderStatus'];
                $orderDetails[$j]['totalCost'] = $value['totalCost'];
            }
            $orderDetails[$j]['orderDesc'] .= $value['foodItemCategoryName'] . ' : ' . $value['foodItemName'] . '(cost 1 Qty =' . $value['orderItemPrice'] . '): Qty = ' . $value['quantity'] . ' \n ';
        }
        
        return $orderDetails;
    }

}
