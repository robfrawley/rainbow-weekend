<?php
/*
 * This file is part of the Rob Frawley application
 *
 * (c) Rob Frawley 2nd <rmf@robfrawley.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Rw\WebBundle\Templating\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface,
    Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Rw\WebBundle\Utility\Container\ContainerAwareTrait;
use Twig_Extension;

/**
 * AbstractExtension
 */
abstract class AbstractExtension extends Twig_Extension implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @return string
     */
    public function getName()
    {
        return get_called_class();
    }
}