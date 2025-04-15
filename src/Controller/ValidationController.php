<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Score;
use App\Entity\User;
use App\Form\ResponseUserType;
use App\Repository\QuestionRepository;
use App\Repository\ScoreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ValidationController extends AbstractController
{
    #[Route('/validation', name: 'app_validation')]
    public function index(Request $request, SessionInterface $session): Response
    {
        $form = $this->createForm(ResponseUserType::class);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $session->set('response', $data);
            
        }
        
        return $this->redirectToRoute('app_validation_result');
    }

    #[Route('/validation/result', name: 'app_validation_result')]
    public function result(SessionInterface $session, QuestionRepository $questionRepository, EntityManagerInterface $entityManager, ScoreRepository $scoreRepository): Response
    {
    $responses = $session->get('response', []);
    $ids = $session->get('ids', []);
    
    $score = 0;
    $sortedQuestions = []; // Un tableau pour stocker les questions avec leur statut
    
    foreach ($ids as $index => $id) {
        $question = $questionRepository->find($id);
        $responseKey = 'response' . ($index + 1);
        $userResponse = $responses[$responseKey] ?? '';

        // Compare la réponse de l'utilisateur à la bonne réponse
        $isCorrect = (strtolower(trim($userResponse)) === strtolower(trim($question->getResponse())));
        // $isCorrect = false;

        // Ajoute la question au tableau avec l'info si la réponse est correcte
        $sortedQuestions[] = [
            'question' => $question,
            'isCorrect' => $isCorrect,
        ];

        if ($isCorrect) {
            $score++;
        }

        // stocker la variable score dans la table User
    }
    $user = $this->getUser();

    if ($user instanceof User) {
        $scoreEntity = new Score();
        $scoreEntity->setUser($user);
        $scoreEntity->setScore($score);
        $scoreEntity->setTimestamp(new \DateTime());
        $entityManager->persist($scoreEntity);
        $entityManager->flush();
        
    }


        return $this->render('validation/index.html.twig', [
            'responses' => $responses,
            'questions' => $sortedQuestions,
            'session' => $session,
            'score' => $score,
            'scoreEntity' => $scoreEntity,
        ]);
    }
}
