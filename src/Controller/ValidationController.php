<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ValidationController extends AbstractController
{
    #[Route('/validation', name: 'app_validation', methods: ['POST'])]
    public function index(QuestionRepository $question_repository): Response
    {
        // dd('formulaire reçu');
        if(isset($_POST)) {
            $datas = $_POST;

        //     foreach ($datas as $key => $value) {
        //         if($key == 'question') {
        //             $question = $value;
        //         }
        //         if($key == 'response') {
        //             $response = $value;
        //         }
        //     }
        // } else {
            
        }
        
        return $this->render('validation/index.html.twig', [
            'controller_name' => 'ValidationController',
            'datas' => $datas,
        ]);
    }
}
