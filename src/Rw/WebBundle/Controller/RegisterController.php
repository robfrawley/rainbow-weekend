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
    public function indexAction()
    {
        list($em) = $this->getServices(['em']);

        $post_repo = $em->getRepository('RwWebBundle:Post');
        $posts     = $post_repo->findLatest(3);

        return $this->render(
            'RwWebBundle:Default:index.html.twig', [
                'posts'   => $posts
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
