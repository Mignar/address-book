<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Form\ContactType;
use AppBundle\Entity\Contact;

class ContactController extends Controller
{
    /**
     * @Route("/contacts", name="contact")
     * @Route("/")
     * 
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function index()
    {
        $contacts = $this->getDoctrine()
                         ->getRepository(Contact::class)
                         ->getAllSortedBy('lastname', 'ASC');

        return $this->render('contact/index.html.twig', [
            'contacts' => $contacts,
        ]);
    }

    /**
     * @Route("/contacts/create", name="contact_create")
     * 
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function create(Request $request)
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact)
                     ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $em = $this->getDoctrine()
                       ->getManager();

            $em->persist($contact);
            $em->flush();

            $this->addFlash(
                'success',
                'Contact successfully created!'
            );

            return $this->redirectToRoute('contact_show', [
                'id' => $contact->getId()
            ]);
        }
        

        return $this->render('contact/add.html.twig', [
            'form'  => $form->createView(),
            'title' => 'New Contact'
        ]);
    }

    /**
     * @Route("/contacts/{id}", name="contact_show")
     * 
     * @param Contact $contact
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function show(Contact $contact)
    {
        return $this->render('contact/show.html.twig', [
            'contact' => $contact
        ]);
    }
    
    /**
     * @Route("/contacts/{id}/edit", name="contact_edit")
     * 
     * @param Request $request
     * @param Contact $contact
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function edit(Request $request, Contact $contact)
    {
        $form = $this->createForm(ContactType::class, $contact)
                     ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash(
                'success',
                'Contact successfully edited!'
            );

            return $this->redirectToRoute('contact_show', [
                'id' => $contact->getId()
            ]);
        }
        

        return $this->render('contact/add.html.twig', [
            'form'  => $form->createView(),
            'title' => 'Edit Contact'
        ]);
    }

    /**
     * @Route("/contacts/{id}/delete", name="contact_destroy")
     * 
     * @param Contact $contact
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function destroy(Contact $contact)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($contact);
        $em->flush();

        $this->addFlash(
            'success',
            'Contact successfully deleted!'
        );

        return $this->redirectToRoute('contact');
    }
}
