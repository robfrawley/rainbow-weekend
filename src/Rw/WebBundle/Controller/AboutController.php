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
 * AboutController
 */
class AboutController extends AbstractController
{
    public function historyAction()
    {
        return $this->render(
            'RwWebBundle:About:history.html.twig'
        );
    }

    public function committeeAction()
    {
        list($em) = $this->getServices(['em']);

        $committee_admin = $em
            ->getRepository('RwWebBundle:Position')
            ->getByContextOrderByWeight('admin')
        ;
        $committee_chair = $em
            ->getRepository('RwWebBundle:Position')
            ->getByContextOrderByPosition('chair')
        ;
        $committee_representative = $em
            ->getRepository('RwWebBundle:Position')
            ->getByContextOrderByPosition('rep')
        ;

        return $this->render(
            'RwWebBundle:About:committee.html.twig', 
            [
                'committee_admin'          => $committee_admin,
                'committee_chair'          => $committee_chair,
                'committee_representative' => $committee_representative,
            ]
        );
    }
}
