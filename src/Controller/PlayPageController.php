<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PlayPageController extends AbstractController
{
    #[Route('/play', name: 'app_play_page')]
    public function index(QuestionRepository $question_repository): Response
    {
        $AllQuestions = $question_repository->findAll();
        shuffle($AllQuestions);
        $question = array_slice($AllQuestions, 0, 5);

        return $this->render('play_page/index.html.twig', [
            'valideResponses' => false,
            'questions' => $question,
        ]);
    }
}
