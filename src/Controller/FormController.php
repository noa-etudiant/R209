<?php
// src/Controller/FormController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\FormSubmission;
use App\Form\FormSubmissionType;

class FormController extends AbstractController
{
    #[Route('/form', name: 'form')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $submission = new FormSubmission();
        $form = $this->createForm(FormSubmissionType::class, $submission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($submission);
            $em->flush();

            $this->addFlash('success', 'Formulaire soumis avec succès.');
            return $this->redirectToRoute('form');
        }

        return $this->render('form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
