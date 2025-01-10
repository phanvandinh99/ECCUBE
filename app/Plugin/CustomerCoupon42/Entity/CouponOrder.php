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

    // Getters and Setters

    public function getCouponOrderId(): ?int
    {
        return $this->coupon_order_id;
    }

    public function setCouponOrderId(int $coupon_order_id): self
    {
        $this->coupon_order_id = $coupon_order_id;
        return $this;
    }

    public function getCoupon(): ?Coupon
    {
        return $this->coupon;
    }

    public function setCoupon(Coupon $coupon): self
    {
        $this->coupon = $coupon;
        return $this;
    }

    public function getCustomerId(): ?int
    {
        return $this->customer_id;
    }

    public function setCustomerId(int $customer_id): self
    {
        $this->customer_id = $customer_id;
        return $this;
    }

    public function getCouponCd(): ?string
    {
        return $this->coupon_cd;
    }

    public function setCouponCd(string $coupon_cd): self
    {
        $this->coupon_cd = $coupon_cd;
        return $this;
    }

    public function getCouponName(): ?string
    {
        return $this->coupon_name;
    }

    public function setCouponName(string $coupon_name): self
    {
        $this->coupon_name = $coupon_name;
        return $this;
    }

    public function getAvailableFromDate(): ?\DateTimeInterface
    {
        return $this->available_from_date;
    }

    public function setAvailableFromDate(?\DateTimeInterface $available_from_date): self
    {
        $this->available_from_date = $available_from_date;
        return $this;
    }

    public function getAvailableToDate(): ?\DateTimeInterface
    {
        return $this->available_to_date;
    }

    public function setAvailableToDate(?\DateTimeInterface $available_to_date): self
    {
        $this->available_to_date = $available_to_date;
        return $this;
    }

    public function getPreOrderId(): ?int
    {
        return $this->pre_order_id;
    }

    public function setPreOrderId(?int $pre_order_id): self
    {
        $this->pre_order_id = $pre_order_id;
        return $this;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->order_date;
    }

    public function setOrderDate(?\DateTimeInterface $order_date): self
    {
        $this->order_date = $order_date;
        return $this;
    }

    public function getDiscount(): ?string
    {
        return $this->discount;
    }

    public function setDiscount(?string $discount): self
    {
        $this->discount = $discount;
        return $this;
    }

    public function getEnableFlag(): ?bool
    {
        return $this->enable_flag;
    }

    public function setEnableFlag(bool $enable_flag): self
    {
        $this->enable_flag = $enable_flag;
        return $this;
    }

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->create_date;
    }

    public function setCreateDate(?\DateTimeInterface $create_date): self
    {
        $this->create_date = $create_date;
        return $this;
    }

    public function getUpdateDate(): ?\DateTimeInterface
    {
        return $this->update_date;
    }

    public function setUpdateDate(?\DateTimeInterface $update_date): self
    {
        $this->update_date = $update_date;
        return $this;
    }
}
