<?php

namespace App\Controller;
use App\Entity\Score;
use App\Entity\User;
use App\Repository\ScoreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ScoreController extends AbstractController
{
    #[Route('/score', name: 'app_score')]
    public function index(ScoreRepository $scoreRepository): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }else{
            $scores = $scoreRepository->findBy(['user' => $user], ['score' => 'DESC']);
        }

        $highScore = $scoreRepository->findTopScore();

        return $this->render('score/index.html.twig', [
            'controller_name' => 'ScoreController',
            'scores' => $scores,
            'highScore' => $highScore,
        ]);
    }
}
