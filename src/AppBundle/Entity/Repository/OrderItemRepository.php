<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of OrderItemRepository
 *
 * @author mindfire
 */
class OrderItemRepository extends EntityRepository {
    
    public function getAllOrders() {
        $qb = $this->createQueryBuilder('oi');
        $qb->select('oi.order');
        $result = $qb->getQuery()->getArrayResult();

        return $result;
    }
}
