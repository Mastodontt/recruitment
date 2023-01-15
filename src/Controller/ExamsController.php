<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use App\Entity\Exam;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExamsController extends AbstractController
{

    #[Route('/exams', name: 'app_exams',methods:['GET','HEAD'])]
    public function index(EntityManagerInterface $em,LoggerInterface $logger): Response
    {
        $logger->info('User viewed exams list');
        $examRepository = $em->getRepository(Exam::class);
        $exams = $examRepository->findAll();

        return $this->render('exams/index.html.twig', [
            'exams' => $exams,
            'title' => 'Exams list'
        ]);
    }
}
