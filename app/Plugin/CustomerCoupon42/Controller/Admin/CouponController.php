<?php

namespace Plugin\CustomerCoupon42\Controller\Admin;

use Eccube\Controller\AbstractController;
use Plugin\CustomerCoupon42\Entity\Coupon;
use Plugin\CustomerCoupon42\Form\Type\Admin\CouponType;
use Plugin\CustomerCoupon42\Repository\CouponRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Plugin\CustomerCoupon42\Service\CouponService;
use Eccube\Common\Constant;

/**
 * @Route("/%eccube_admin_route%/customer_coupon", name="CustomerCoupon42_admin_coupon_")
 */
class CouponController extends AbstractController
{
    /**
     * @var CouponRepository
     */
    private $couponRepository;

    /**
     * @var CouponService
     */
    private $couponService;

    /**
     * CouponController constructor.
     *
     * @param CouponRepository $couponRepository
     * @param CouponService $couponService
     */
    public function __construct(
        CouponRepository $couponRepository,
        CouponService $couponService,
    ) {
        $this->couponRepository = $couponRepository;
        $this->couponService = $couponService;
    }

    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(): Response
    {
        $coupons = $this->couponRepository->findActiveCouponAll();

        return $this->render('@CustomerCoupon42/admin/index.twig', [
            'Coupons' => $coupons,
        ]);
    }

    /**
     * Create or Update Coupon.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return RedirectResponse|Response
     * @Route("/new", name="create", methods={"GET", "POST"})
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, $id = null)
    {
        $entityManager = $this->entityManager;
        try {
            $entityManager->beginTransaction();

            $Coupon = null;

            if (!$id) {
                $Coupon = new Coupon();
                $Coupon->setEnableFlag(Constant::ENABLED);
            } else {
                $Coupon = $this->couponRepository->find($id);
                if (!$Coupon) {
                    $this->addError('plugin_customer_coupon.admin.notfound', 'admin');
                    return $this->redirectToRoute('CustomerCoupon42_admin_coupon_index');
                }
            }

            $form = $this->formFactory->createBuilder(CouponType::class, $Coupon)->getForm();
            $form->handleRequest($request);

            if ($form->isSubmitted()) {
                if ($form->isValid()) {
                    if (!$id) {
                        $entityManager->persist($Coupon);
                    }

                    $entityManager->flush();

                    $entityManager->commit();

                    $this->addSuccess('plugin_customer_coupon.admin.regist.success', 'admin');
                    return $this->redirectToRoute('CustomerCoupon42_admin_coupon_index');
                } else {
                    $this->addError('plugin_customer_coupon.admin.form.invalid', 'admin');
                }
            }

            return $this->render('@CustomerCoupon42/admin/regist.twig', [
                'form' => $form->createView(),
                'coupon' => $Coupon,
            ]);
        } catch (\Exception $e) {
            $entityManager->rollback();
            $this->addError('plugin_customer_coupon.admin.error', 'admin');

            return $this->redirectToRoute('CustomerCoupon42_admin_coupon_index');
        }
    }

    /**
     * emove coupon.
     *
     * @param Request $request
     * @param Coupon  $Coupon
     *
     * @return RedirectResponse
     * @Route("/{id}/delete", name="delete", requirements={"id" = "\d+"}, methods={"delete"})
     */
    public function delete(Request $request, Coupon $Coupon)
    {
        $this->isTokenValid();
        $this->couponRepository->deleteCoupon($Coupon);
        $this->addSuccess('plugin_customer_coupon.admin.delete.success', 'admin');
        log_info('Delete a coupon with ', ['ID' => $Coupon->getCouponId()]);

        return $this->redirectToRoute('CustomerCoupon42_admin_coupon_index');
    }
}
