<?php

namespace Plugin\CustomerCoupon42\Service;

use Plugin\CustomerCoupon42\Repository\CouponRepository;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class CouponService.
 */
class CouponService
{
    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @var CouponRepository
     */
    private $couponRepository;


    /**
     * CouponService constructor.
     *
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param CouponRepository $couponRepository
     *
     */
    public function __construct(
        AuthorizationCheckerInterface $authorizationChecker,
        CouponRepository $couponRepository,
    ) {
        $this->authorizationChecker = $authorizationChecker;
        $this->couponRepository = $couponRepository;
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
