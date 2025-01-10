<?php

namespace Plugin\CustomerCoupon42\Service;

use Plugin\CustomerCoupon42\Repository\CouponOrderRepository;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class CouponOrderService.
 */
class CouponOrderService
{
    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @var CouponOrderRepository
     */
    private $couponOrderRepository;


    /**
     * CouponOrderService constructor.
     *
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param CouponOrderRepository $couponOrderRepository
     *
     */
    public function __construct(
        AuthorizationCheckerInterface $authorizationChecker,
        CouponOrderRepository $couponOrderRepository,
    ) {
        $this->authorizationChecker = $authorizationChecker;
        $this->couponOrderRepository = $couponOrderRepository;
    }

    /**
     * Generate coupon code.
     *
     * @param int $length
     *
     * @return string
     */
    public function generateCouponCd($length = 12)
    {
        $couponCd = substr(base_convert(md5(uniqid()), 16, 36), 0, $length);

        return $couponCd;
    }
}
