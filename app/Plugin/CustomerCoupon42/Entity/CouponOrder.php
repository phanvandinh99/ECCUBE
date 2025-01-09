<?php

namespace Plugin\CustomerCoupon42\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Entity\AbstractEntity;

/**
 * @ORM\Entity(repositoryClass="Plugin\CustomerCoupon42\Repository\CouponOrderRepository")
 * @ORM\Table(name="plg_customer_coupon_order")
 */
class CouponOrder extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $coupon_order_id;

    /**
     * @ORM\ManyToOne(targetEntity="Plugin\CustomerCoupon42\Entity\Coupon")
     * @ORM\JoinColumn(name="coupon_id", referencedColumnName="coupon_id", nullable=false)
     */
    private $coupon;

    /**
     * @ORM\Column(type="integer")
     */
    private $customer_id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $coupon_cd;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $coupon_name;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $available_from_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $available_to_date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pre_order_id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $order_date;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2, nullable=true)
     */
    private $discount;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enable_flag;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $create_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $update_date;

    // Getters and Setters...
}
