<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, ManagerRegistry $doctrine, MailerInterface $mailer): Response
    {

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setCreateAt(new \DateTime("now"));
            $entityManager = $doctrine->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            $this->sendMail($contact, $mailer);

            $this->addFlash('success', 'Wiadomość została wysłana');
            return $this->redirectToRoute("home");
        } else {
            return $this->render('index.html.twig', [
                'form' => $form->createView(),
                'errors' => $form->getErrors()
            ]);
        }

        return $this->render('index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    private function sendMail($data, MailerInterface $mailer) {
        $email = (new TemplatedEmail())
            ->from(new Address('dawid.mastylak@gmail.com'))
            ->to('kinga.michalak@workeo.co')
            ->addTo('m.kosakowski@h2h.tech')
            ->subject('Wiadomoś z formularza kontaktowego['. $data->getSubiect() .']')
            ->htmlTemplate('email/contact.html.twig')
            ->context([
                'contact' => $data,
            ]);

        $mailer->send($email);
    }
}
