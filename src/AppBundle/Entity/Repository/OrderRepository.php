<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

/**
 * Description of OrderItemRepository
 *
 * @author mindfire
 */
class OrderRepository extends EntityRepository {

    public function getAllOrders() {
        $qb = $this->createQueryBuilder('o');
        $qb->select('o.id as orderID')
                ->addSelect('o.created_date_time as createdDateTime')
                ->addSelect('o.status as orderStatus')
                ->addSelect('o.total_cost as totalCost')
                ->addSelect('oi.quantity as quantity')
                ->addSelect('oi.price as orderItemPrice')
                ->addSelect('fi.name as foodItemName')
                ->addSelect('fic.name as foodItemCategoryName')
                ->leftJoin('AppBundle:OrderItem', 'oi', Join::WITH, 'oi.order = o.id')
                ->leftJoin('AppBundle:FoodItem', 'fi', Join::WITH, 'oi.food_item = fi.id')
                ->leftJoin('AppBundle:FoodItemCategory', 'fic', Join::WITH, 'fi.food_item_category = fic.id')
        ;
        $result = $qb->getQuery()->getArrayResult();

        return $result;
    }

}
