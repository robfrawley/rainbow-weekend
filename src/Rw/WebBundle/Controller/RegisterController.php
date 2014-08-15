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

/**
 * DefaultController
 */
class RegisterController extends AbstractController
{
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

    public function itemCheckoutAction()
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
            'RwWebBundle:Register:convention_checkout.html.twig', [
                'groups'          => $groups,
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
