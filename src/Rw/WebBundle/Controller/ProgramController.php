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
 * ProgramController
 */
class ProgramController extends AbstractController
{
    public function indexAction()
    {
        list($em) = $this->getServices(['em']);

        $program_main = $em
            ->getRepository('RwWebBundle:Program')
            ->getByContextOrderByDatetime('main')
        ;
        $program_sat_1 = $em
            ->getRepository('RwWebBundle:Program')
            ->getByContextOrderByDatetime('saturday_track_1')
        ;
        $program_sat_2 = $em
            ->getRepository('RwWebBundle:Program')
            ->getByContextOrderByDatetime('saturday_track_2')
        ;
        $program_sun_1 = $em
            ->getRepository('RwWebBundle:Program')
            ->getByContextOrderByDatetime('sunday_track_1')
        ;

        return $this->render(
            'RwWebBundle:Program:index.html.twig', 
            [
                'program_main'  => $program_main,
                'program_sat_1' => $program_sat_1,
                'program_sat_2' => $program_sat_2,
                'program_sun_1' => $program_sun_1,
            ]
        );
    }
}
