<?php

namespace Plugin\CustomerCoupon42\Form\Type\Admin;

use Plugin\CustomerCoupon42\Entity\Coupon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Plugin\CustomerCoupon42\Repository\CouponRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * buildForm.
 *
 * @param FormBuilderInterface $builder
 * @param array                $options
 */
class CouponType extends AbstractType
{
    /**
     * @var CouponRepository
     */
    private $couponRepository;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var ContainerBagInterface
     */
    private $container;

    /**
     * CouponType constructor.
     *
     * @param CouponRepository $couponRepository
     * @param ValidatorInterface $validator
     * @param ContainerBagInterface $container
     */
    public function __construct(
        CouponRepository $couponRepository,
        ValidatorInterface $validator,
        ContainerBagInterface $container
    ) {
        $this->couponRepository = $couponRepository;
        $this->validator = $validator;
        $this->container = $container;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $currency = $this->container->get('currency');

        $builder
            ->add('coupon_name', TextType::class, [
                'label' => 'plugin_customer_coupon.admin.label.coupon_name',
                'required' => true,
                'trim' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('discount_price', MoneyType::class, [
                'label' => 'plugin_customer_coupon.admin.label.discount_price',
                'required' => true,
                'currency' => $currency,
                'constraints' => [
                    new Assert\Range([
                        'min' => 0,
                    ]),
                ],
            ])
            ->add('discount_rate', NumberType::class, [
                'label' => 'plugin_customer_coupon.admin.label.discount_price',
                'required' => true,
                'constraints' => [
                    new Assert\Range([
                        'min' => 1,
                        'max' => 100,
                    ]),
                ],
            ])
            // ->add('enable_flag', CheckboxType::class, [
            //     'label' => 'plugin_customer_coupon.admin.label.enable_flag',
            //     'required' => true,
            //     'value' => true,
            //     'attr' => ['checked' => true],
            //     'constraints' => [
            //         new Assert\Range([
            //             'min' => 0,
            //             'max' => 1,
            //         ]),
            //     ],
            // ])
            ->add('available_from_date', DateTimeType::class, [
                'label' => 'plugin_customer_coupon.admin.label.available_from_date',
                'required' => true,
                'input' => 'datetime',
                'widget' => 'single_text',
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('available_to_date', DateTimeType::class, [
                'label' => 'plugin_customer_coupon.admin.label.available_to_date',
                'required' => true,
                'input' => 'datetime',
                'widget' => 'single_text',
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Coupon::class,
        ]);
    }
}
