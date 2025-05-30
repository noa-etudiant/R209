<?php

namespace App\Controller;

use App\Repository\FormSubmissionRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin/submissions', name: 'admin_submissions')]
    public function submissions(FormSubmissionRepository $repo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $submissions = $repo->findAll();

        return $this->render('admin/submissions.html.twig', [
            'submissions' => $submissions,
        ]);
    }
}
