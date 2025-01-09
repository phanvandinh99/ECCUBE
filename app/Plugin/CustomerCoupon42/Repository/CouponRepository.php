<?php

namespace Plugin\CustomerCoupon42\Repository;

use Eccube\Repository\AbstractRepository;
use Doctrine\Persistence\ManagerRegistry;
use Plugin\CustomerCoupon42\Entity\Coupon;

class CouponRepository extends AbstractRepository
{
    /**
     * CouponRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coupon::class);
    }

    /**
     * Hiển thị danh sách coupon Active.
     *
     * @return array
     */
    public function findActiveCouponAll()
    {
        $currenDateTime = new \DateTime();

        // Set time is 0
        $currenDateTime->setTime(0, 0, 0);

        $qb = $this->createQueryBuilder('c')->select('c')->Where('c.enable_flag = true');

        // $qb->andWhere('c.available_from_date <= :cur_date_time OR c.available_from_date IS NULL')
        //     ->setParameter('cur_date_time', $currenDateTime);

        // $qb->andWhere(':cur_date_time <= c.available_to_date OR c.available_to_date IS NULL')
        //     ->setParameter('cur_date_time', $currenDateTime);

        return $qb->getQuery()->getResult();
    }

    /**
     * Delete coupon information.
     *
     * @param Coupon $Coupon
     *
     * @return bool
     */
    public function deleteCoupon(Coupon $Coupon)
    {
        $em = $this->getEntityManager();

        $Coupon->setEnableFlag(false);
        $em->persist($Coupon);
        $em->flush($Coupon);

        return true;
    }
}
