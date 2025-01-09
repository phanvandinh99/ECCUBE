<?php

namespace Plugin\CustomerCoupon42\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Entity\AbstractEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Plugin\CustomerCoupon42\Repository\CouponRepository")
 * @ORM\Table(name="plg_customer_coupon")
 */
class Coupon extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $coupon_id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     */
    private $coupon_name;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     */
    private $discount_price;

    /**
     * @ORM\Column(type="integer")
     */
    private $discount_rate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enable_flag;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $available_from_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $available_to_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $create_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $update_date;

    // Getters and Setters
    public function getCouponId(): ?int
    {
        return $this->coupon_id;
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

    public function getDiscountPrice(): ?float
    {
        return $this->discount_price;
    }

    public function setDiscountPrice(float $discount_price): self
    {
        $this->discount_price = $discount_price;
        return $this;
    }

    public function getDiscountRate(): ?int
    {
        return $this->discount_rate;
    }

    public function setDiscountRate(int $discount_rate): self
    {
        $this->discount_rate = $discount_rate;
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

    public function getAvailableFromDate(): ?\DateTime
    {
        return $this->available_from_date;
    }

    public function setAvailableFromDate(?\DateTime $available_from_date): self
    {
        $this->available_from_date = $available_from_date;
        return $this;
    }

    public function getAvailableToDate(): ?\DateTime
    {
        return $this->available_to_date;
    }

    public function setAvailableToDate(?\DateTime $available_to_date): self
    {
        $this->available_to_date = $available_to_date;
        return $this;
    }

    public function getCreateDate(): ?\DateTime
    {
        return $this->create_date;
    }

    public function setCreateDate(?\DateTime $create_date): self
    {
        $this->create_date = $create_date;
        return $this;
    }

    public function getUpdateDate(): ?\DateTime
    {
        return $this->update_date;
    }

    public function setUpdateDate(?\DateTime $update_date): self
    {
        $this->update_date = $update_date;
        return $this;
    }
}
