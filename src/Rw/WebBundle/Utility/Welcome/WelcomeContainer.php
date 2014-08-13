<?php
/*
 * This file is part of the Rob Frawley application
 *
 * (c) Rob Frawley 2nd <rmf@robfrawley.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rw\WebBundle\Utility\Welcome;

use Symfony\Component\DependencyInjection\ContainerInterface,
    Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Rw\WebBundle\Utility\Container\ContainerAwareTrait,
    Rw\WebBundle\Entity\Welcome;

/**
 * WelcomeContainer
 */
class WelcomeContainer
{
    use ContainerAwareTrait;

    /**
     * @var Welcome
     */
    private $welcome = null;

    /**
     * @return mixed
     */
    public function initContext()
    {
        $em      = $this->container->get('doctrine.orm.entity_manager');
        $request = $this->container->get('request');
        $route   = $request->get('_route');

        $welcome_repo  = $em->getRepository('RwWebBundle:Welcome');
        $welcome       = $welcome_repo->findOneForContext($route);

        echo $welcome->getHeader();
        print_r($welcome);
        die();

        $this->welcome = $welcome;

        return $this;
    }

    /**
     * @return string
     */
    public function getHeader()
    {
        if ($this->welcome === null) {
            $this->initContext();
        }

        return $this
            ->welcome
            ->getHeader()
        ;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        if ($this->welcome === null) {
            $this->initContext();
        }

        return $this
            ->welcome
            ->getBody()
        ;
    }
}