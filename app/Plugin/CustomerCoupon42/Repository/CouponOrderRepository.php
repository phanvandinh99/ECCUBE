<?php

namespace Plugin\CustomerCoupon42\Repository;

use Doctrine\ORM\EntityRepository;

class CouponOrderRepository extends EntityRepository
{
    public function findOrdersByCustomer($customerId)
    {
        return $this->createQueryBuilder('co')
            ->where('co.customer_id = :customerId')
            ->setParameter('customerId', $customerId)
            ->getQuery()
            ->getResult();
    }
}
