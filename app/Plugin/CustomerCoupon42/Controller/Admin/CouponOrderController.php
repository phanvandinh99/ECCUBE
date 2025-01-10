<?php

namespace Plugin\CustomerCoupon42\Controller\Admin;

use Eccube\Controller\AbstractController;
use Plugin\CustomerCoupon42\Entity\CouponOrder;
use Plugin\CustomerCoupon42\Form\Type\Admin\CouponType;
use Plugin\CustomerCoupon42\Repository\CouponOrderRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Plugin\CustomerCoupon42\Service\CouponOrderService;
use Eccube\Common\Constant;

/**
 * @Route("/%eccube_admin_route%/customer_coupon_order", name="CustomerCoupon42_admin_coupon_order_")
 */
class CouponOrderController extends AbstractController
{
    /**
     * @var CouponOrderRepository
     */
    private $couponOrderRepository;

    /**
     * @var CouponOrderService
     */
    private $couponOrderService;

    /**
     * CouponController constructor.
     *
     * @param CouponOrderRepository $couponOrderRepository
     * @param CouponService $couponService
     */
    public function __construct(
        CouponOrderRepository $couponOrderRepository,
        CouponOrderService $couponOrderService,
    ) {
        $this->couponOrderRepository = $couponOrderRepository;
        $this->couponOrderService = $couponOrderService;
    }

    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(): Response
    {
        $couponOrders = $this->couponOrderRepository->findActiveCouponOrderAll();

        return $this->render('@CustomerCoupon42/admin/CouponOrder/index.twig', [
            'CouponOrders' => $couponOrders,
        ]);
    }

    /**
     * Create or Update Coupon Order.
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

            $couponOrder = null;

            if (!$id) {
                $couponOrder = new CouponOrder();
                $couponOrder->setEnableFlag(Constant::ENABLED);
            } else {
                $couponOrder = $this->couponOrderRepository->find($id);
                if (!$couponOrder) {
                    $this->addError('plugin_customer_coupon_order.admin.notfound', 'admin');
                    return $this->redirectToRoute('CustomerCoupon42_admin_coupon_order_index');
                }
            }

            $form = $this->formFactory->createBuilder(CouponType::class, $couponOrder)->getForm();
            $form->handleRequest($request);

            if ($form->isSubmitted()) {
                if ($form->isValid()) {
                    if (!$id) {
                        $entityManager->persist($couponOrder);
                    }

                    $entityManager->flush();

                    $entityManager->commit();

                    $this->addSuccess('plugin_customer_coupon_order.admin.regist.success', 'admin');
                    return $this->redirectToRoute('CustomerCoupon42_admin_coupon_order_index');
                } else {
                    $this->addError('plugin_customer_coupon_order.admin.form.invalid', 'admin');
                }
            }

            return $this->render('@CustomerCoupon42/admin/CouponOrder/regist.twig', [
                'form' => $form->createView(),
                'couponOrder' => $couponOrder,
            ]);
        } catch (\Exception $e) {
            $entityManager->rollback();
            $this->addError('plugin_customer_coupon_order.admin.error', 'admin');

            return $this->redirectToRoute('CustomerCoupon42_admin_coupon_order_index');
        }
    }

    /**
     * emove coupon.
     *
     * @param Request $request
     * @param CouponOrder  $couponOrder
     *
     * @return RedirectResponse
     * @Route("/{id}/delete", name="delete", requirements={"id" = "\d+"}, methods={"delete"})
     */
    public function delete(Request $request, CouponOrder $couponOrder)
    {
        $this->isTokenValid();
        $this->couponOrderRepository->deleteCouponOrder($couponOrder);
        $this->addSuccess('plugin_customer_coupon_order.admin.delete.success', 'admin');
        log_info('Delete a coupon order with ', ['ID' => $couponOrder->getCouponOrderId()]);

        return $this->redirectToRoute('CustomerCoupon42_admin_coupon_order_index');
    }
}
