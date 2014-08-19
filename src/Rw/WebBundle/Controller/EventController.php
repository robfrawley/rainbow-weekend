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
 * EventController
 */
class EventController extends AbstractController
{
    public function indexAction()
    {
        list($em) = $this->getServices(['em']);

        $events = $em
            ->getRepository('RwWebBundle:Event')
            ->findAll()
        ;

        return $this->render(
            'RwWebBundle:Event:index.html.twig', 
            [
                'events' => $events,
            ]
        );
    }
}
