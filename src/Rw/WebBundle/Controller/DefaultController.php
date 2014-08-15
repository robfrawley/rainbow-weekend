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

use Swift_Message;

/**
 * DefaultController
 */
class DefaultController extends AbstractController
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

    public function redirectAction()
    {
        return $this->redirect('https://sites.google.com/site/rweekend17/');
    }

    public function contactAction()
    {
        list($request, $mailer) = 
            $this->getServices(['request', 'mailer'])
        ;

        $contact = $this
            ->createForm('contact_type')
            ->handleRequest($request)
        ;

        if ($contact->isValid()) {
            $message = Swift_Message::newInstance()
                ->setSubject('RW Website: Visitor Message')
                ->setFrom(['no-reply@rainbowweekend.org' => 'Rainbow Weekend Website'])
                ->setTo(['committee@rainbowweekend.org' => 'Rainbow Weekend Committee'])
                ->setReplyTo([$contact->get('email')->getData() => $contact->get('name')->getData()])
                ->setBody(
                    $this->renderView(
                        'RwWebBundle:Mail:contact.html.twig', 
                        [
                            'name'    => $contact->get('name')->getData(),
                            'phone'   => $contact->get('phone')->getData(),
                            'email'   => $contact->get('email')->getData(),
                            'message' => $contact->get('message')->getData(),
                        ]
                    ),
                    'text/html'
                )
            ;

            $mailer->send($message);

            $form_submitted = true;
        } else {
            $form_submitted = false;
        }

        return $this->render(
            'RwWebBundle:Default:contact.html.twig', 
            [
                'form_submitted'           => $form_submitted,
                'form_contact'             => $contact->createView(),
            ]
        );
    }
}
