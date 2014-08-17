<?php
/*
 * This file is part of the Rob Frawley application
 *
 * (c) Rob Frawley 2nd <rmf@robfrawley.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rw\WebBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Rw\WebBundle\Entity\RegisterPurchase;

/**
 * DefaultController
 */
class RegisterController extends AbstractController
{
    public function verifyStateAction()
    {
        list($request) = $this->getServices(['request']);

        $us_states = [
            // uppercase
            'AL', 'AK', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'FL', 'GA', 'HI', 'ID', 'IL', 
            'IN', 'IA', 'KS', 'KY', 'LA', 'ME', 'MD', 'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 
            'NE', 'NV', 'NH', 'NJ', 'NM', 'NY', 'NC', 'ND', 'OH', 'OK', 'OR', 'PA', 'RI', 
            'SC', 'SD', 'TN', 'TX', 'UT', 'VT', 'VA', 'WA', 'WV', 'WI', 'WY', 'AS', 'DC', 
            'FM', 'GU', 'MH', 'MP', 'PW', 'PR', 'VI', 'AE', 'AA', 'AE', 'AE', 'AE', 'AP', 
            // lowercase
            'al', 'ak', 'az', 'ar', 'ca', 'co', 'ct', 'de', 'fl', 'ga', 'hi', 'id', 'il', 
            'in', 'ia', 'ks', 'ky', 'la', 'me', 'md', 'ma', 'mi', 'mn', 'ms', 'mo', 'mt', 
            'ne', 'nv', 'nh', 'nj', 'nm', 'ny', 'nc', 'nd', 'oh', 'ok', 'or', 'pa', 'ri', 
            'sc', 'sd', 'tn', 'tx', 'ut', 'vt', 'va', 'wa', 'wv', 'wi', 'wy', 'as', 'dc', 
            'fm', 'gu', 'mh', 'mp', 'pw', 'pr', 'vi', 'ae', 'aa', 'ae', 'ae', 'ae', 'ap', 
        ];

        $submitted_state = $request->get('addressState');

        if (in_array($submitted_state, $us_states)) {
            $return = true;
        } else {
            $return = false;
        }

        return new JsonResponse([
            'valid' => $return,
        ]);
    }

    public function itemClearAction()
    {
        list($em, $session) = $this->getServices(['em', 'session']);

        if ($session->has('selected_items')) {
            $session->set('selected_items', []);
        }

        return $this->redirect(
            $this->generateUrl('rw_register_convention')
        );
    }

    public function itemAddAction($item)
    {
        list($em, $session) = $this->getServices(['em', 'session']);

        $repo = $em->getRepository('RwWebBundle:RegisterItem');
        $item = $repo->findOneById($item);

        if ($session->has('selected_items')) {
            $selected_items = $session->get('selected_items');
        } else {
            $selected_items = [];
        }

        if (array_key_exists($item->getId(), $selected_items)) {
            $selected_items[$item->getId()]++;
        } else {
            $selected_items[$item->getId()] = 1;
        }

        $session->set('selected_items', $selected_items);

        return $this->redirect(
            $this->generateUrl('rw_register_convention')
        );
    }

    public function itemListAction()
    {
        list($em, $session) = $this->getServices(['em', 'session']);

        $groups = $em
            ->getRepository('RwWebBundle:RegisterItemGroup')
            ->findAllOrderByWeight()
        ;

        $selected_items    = $session->has('selected_items') ? $session->get('selected_items') : [];
        $displayable_items = [];
        $countable_items   = [];
        $cart_total        = 0;
        $metadata_items    = [];

        foreach ($selected_items as $id => $count) {
            $item = $em
                ->getRepository('RwWebBundle:RegisterItem')
                ->findOneById($id)
            ;
            $displayable_items[$id] = $item;
            $countable_items[$id]   = $count;

            $cart_total += $item->getCostDollars()*$count;
        }

        return $this->render(
            'RwWebBundle:Register:convention.html.twig', [
                'groups'          => $groups,
                'selected_items'  => $displayable_items,
                'countable_items' => $countable_items,
                'cart_total'      => $cart_total,
            ]
        );
    }

    public function itemCheckoutSuccessAction()
    {
        list($em, $session) = $this->getServices(['em', 'session']);

        $groups = $em
            ->getRepository('RwWebBundle:RegisterItemGroup')
            ->findAllOrderByWeight()
        ;

        $selected_items    = $session->has('selected_items') ? $session->get('selected_items') : [];
        $displayable_items = [];
        $countable_items   = [];
        $cart_total        = 0;
        $metadata_items    = [];

        foreach ($selected_items as $id => $count) {
            $item = $em
                ->getRepository('RwWebBundle:RegisterItem')
                ->findOneById($id)
            ;
            $displayable_items[$id] = $item;
            $countable_items[$id]   = $count;

            $cart_total += $item->getCostDollars()*$count;
        }

        if ($session->has('selected_items')) {
            $session->set('selected_items', []);
        }

        return $this->render(
            'RwWebBundle:Register:convention_success.html.twig', [
                'groups'          => $groups,
                'selected_items'  => $displayable_items,
                'countable_items' => $countable_items,
                'cart_total'      => $cart_total,
            ]
        );
    }

    public function itemCheckoutAction()
    {
        list($em, $request, $mailer, $session, $charge) = 
            $this->getServices(['em', 'request', 'mailer', 'session', 'scribe.stripe.charge'])
        ;

        $selected_items    = $session->has('selected_items') ? $session->get('selected_items') : [];
        $displayable_items = [];
        $countable_items   = [];
        $cart_total        = 0;
        $metadata_items    = [];

        if (count($selected_items) === 0) {
            return $this->redirect(
                $this->generateUrl('rw_register_convention')
            );
        }

        foreach ($selected_items as $id => $count) {
            $item = $em
                ->getRepository('RwWebBundle:RegisterItem')
                ->findOneById($id)
            ;
            $displayable_items[$id] = $item;
            $countable_items[$id]   = $count;

            for ($j = 0; $j < $count; $j++) {
                $metadata_items[] = $item->getName() . ' @ $' . $item->getCostDollars() . '.00';
            }

            $cart_total += $item->getCostDollars()*$count;
        }

        $checkout = $this
            ->createForm('checkout_type')
            ->handleRequest($request)
        ;

        if ($checkout->isValid()) {
            try {
                $charge
                    ->setAmount($cart_total, 00)
                    ->setCardNumber(preg_replace('/[^\d]/i', '', $checkout->get('cardNumber')->getData()))
                    ->setCardExperation(substr($checkout->get('cardExperation')->getData(), 0, 2), substr($checkout->get('cardExperation')->getData(), 3, 4))
                    ->setCardCvc($checkout->get('cardCvc')->getData())
                    ->setName($checkout->get('fullName')->getData())
                    ->setAddressLine01($checkout->get('addressLine01')->getData())
                    ->setAddressLine02($checkout->get('addressLine02')->getData())
                    ->setCity($checkout->get('addressCity')->getData())
                    ->setState($checkout->get('addressState')->getData())
                    ->setZip($checkout->get('addressZip')->getData())
                    ->setCountry('USA')
                    ->setMetadata([
                        'phone'      => $checkout->get('phone')->getData(),
                        'clean_date' => $checkout->get('cleanDate')->getData()->format('m/d/Y'),
                        'notes'      => $checkout->get('notes')->getData(),
                        'items'      => json_encode($metadata_items),
                    ])
                    ->setDescription(json_encode($metadata_items))
                    ->setReceiptEmail($checkout->get('email')->getData())
                    ->charge();
                ;
            } catch(\Scribe\StripeBundle\Exception\StripeException $e) {
                $session
                    ->getFlashBag()
                    ->add('error', $e->getMessage())
                ;

                return $this->render(
                    'RwWebBundle:Register:convention_checkout.html.twig', [
                        'form'            => $checkout->createView(),
                        'selected_items'  => $displayable_items,
                        'countable_items' => $countable_items,
                        'cart_total'      => $cart_total,
                    ]
                );
            }

            $response = $charge->getResponse();

            $purchase = new RegisterPurchase;
            $purchase
                ->setFullName($checkout->get('fullName')->getData())
                ->setAddressLine01($checkout->get('addressLine01')->getData())
                ->setAddressLine02($checkout->get('addressLine02')->getData())
                ->setAddressCity($checkout->get('addressCity')->getData())
                ->setAddressState($checkout->get('addressState')->getData())
                ->setAddressZip($checkout->get('addressZip')->getData())
                ->setEmail($checkout->get('email')->getData())
                ->setPhone($checkout->get('phone')->getData())
                ->setChargeId($response['id'])
                ->setChargeCvcCheck($response['card']['cvc_check'])
                ->setChargeAddressLine01Check($response['card']['address_line1_check'])
                ->setChargeAddressZipCheck($response['card']['address_zip_check'])
                ->setChargeCardId($response['card']['id'])
                ->setChargeAmount($response['amount'])
                ->setChargeState($response['paid'])
                ->setChargeResponse(json_encode($response))
                ->setCleanDate($checkout->get('cleanDate')->getData())
                ->setNotes($checkout->get('notes')->getData())
            ;

            foreach ($selected_items as $id => $count) {
                $item = $em
                    ->getRepository('RwWebBundle:RegisterItem')
                    ->findOneById($id)
                ;
                $displayable_items[$id] = $item;
                $countable_items[$id]   = $count;

                for ($j = 0; $j < $count; $j++) {
                    $purchase->getItems()->add($item);
                }
            }

            $em->persist($purchase);
            $em->flush();

            return $this->redirect(
                $this->generateUrl('rw_register_convention_checkout_success')
            );
        }

        if ($checkout->isSubmitted() && !$checkout->isValid()) {
            $session
                ->getFlashBag()
                ->add('notice', 'There was an error in your form submission. Please review the details you entered carefully and try again.')
            ;
        }

        return $this->render(
            'RwWebBundle:Register:convention_checkout.html.twig', [
                'form'            => $checkout->createView(),
                'selected_items'  => $displayable_items,
                'countable_items' => $countable_items,
                'cart_total'      => $cart_total,
            ]
        );
    }

    public function hotelAction()
    {
        list($em) = $this->getServices(['em']);

        $post_repo = $em->getRepository('RwWebBundle:Post');
        $posts     = $post_repo->findLatest(3);

        return $this->render(
            'RwWebBundle:Register:hotel.html.twig', [
                'posts'   => $posts
            ]
        );
    }
}
