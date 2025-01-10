<?php

namespace Plugin\CustomerCoupon42\Repository;

use Eccube\Repository\AbstractRepository;
use Doctrine\Persistence\ManagerRegistry;
use Plugin\CustomerCoupon42\Entity\CouponOrder;

class CouponOrderRepository extends AbstractRepository
{
    /**
     * CouponOrderRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CouponOrder::class);
    }

    /**
     * Hiển thị danh sách coupon order Active.
     *
     * @return array
     */
    public function findActiveCouponOrderAll()
    {
        $qb = $this->createQueryBuilder('c')->select('c')->Where('c.enable_flag = true');

        return $qb->getQuery()->getResult();
    }

    /**
     * Delete coupon order information.
     *
     * @param CouponOrder $couponOrder
     *
     * @return bool
     */
    public function deleteCouponOrder(CouponOrder $couponOrder)
    {
        $em = $this->getEntityManager();

        $couponOrder->setEnableFlag(false);
        $em->persist($couponOrder);
        $em->flush($couponOrder);

        return true;
    }
}
