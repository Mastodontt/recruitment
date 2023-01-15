<?php

namespace App\Controller;
use Psr\Log\LoggerInterface;
use App\Entity\Exam;
use App\Entity\Param;
use App\Form\ParamType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class ParamsController extends AbstractController
{

    #[Route('/exam/{id}', name: 'app_params_create')]
    public function create(int $id,Request $request,EntityManagerInterface $em,LoggerInterface $logger): Response
    {
        $logger->info('User entered param form');
        $examRepository = $em->getRepository(Exam::class);
        $exam = $examRepository->find($id);

        $param = new Param();
        $param->setExam($exam);
   
        $form = $this->createForm(ParamType::class, $param);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $logger->info('User submitted a form successfully');
            $newParam = $form->getData();

            $em->persist($newParam);
            $em->flush();
           
            return $this->redirectToRoute('app_exams');
        }

        return $this->render('params/create.html.twig', [
            'param_form' => $form->createView(),
            'id' => $id,
            'title' => 'Add param'
        ]);
    }

}
