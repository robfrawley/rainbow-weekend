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
use Twig_SimpleFilter;

/**
 * SwimExtension
 */
class SwimExtension extends AbstractExtension implements ContainerAwareInterface
{
    /**
     * @param $container ContainerInterface
     */
    public function __construct(ContainerInterface $container = null)
    {
        parent::__construct($container);
    }

    /**
     * @param $content string
     * @return mixed
     */
    public function swim($content)
    {
        $swim = $this->container->get('scribe.parser.swim');

        return $swim->render($content);
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('swim', [$this, 'swim'], ['is_safe' => ['html']])
        ];
    }
}