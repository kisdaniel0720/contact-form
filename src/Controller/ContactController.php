<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/', name: 'contact')]
    public function index(Request $request): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $newContact = $form->getData();

            $form->getErrors();

            $this->em->persist($newContact);
            $this->em->flush();
            $this->addFlash('success', 'Köszönjük szépen a kérdésedet. Válaszunkkal hamarosan keresünk a megadott e-mail címen.');

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [
            'title' => 'Kapcsolat',
            'form' => $form->createView(),
        ]);
    }
}
