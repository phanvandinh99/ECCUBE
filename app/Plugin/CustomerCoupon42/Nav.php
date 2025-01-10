<?php

namespace Plugin\CustomerCoupon42;

use Eccube\Common\EccubeNav;

class Nav implements EccubeNav
{
    /**
     * @return array
     */
    public static function getNav()
    {
        return [
            'order' => [
                'children' => [
                    'plugin_customer_coupon' => [
                        'name' => 'クーポン顧客',
                        'url' => 'CustomerCoupon42_admin_coupon_index',
                    ],
                ],
            ],
        ];
    }
}
