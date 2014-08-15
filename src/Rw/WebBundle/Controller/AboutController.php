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
        list($em, $request, $mailer) = 
            $this->getServices(['em', 'request', 'mailer'])
        ;

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
            'RwWebBundle:About:committee.html.twig', 
            [
                'form_submitted'           => $form_submitted,
                'form_contact'             => $contact->createView(),
                'committee_admin'          => $committee_admin,
                'committee_chair'          => $committee_chair,
                'committee_representative' => $committee_representative,
            ]
        );
    }
}
