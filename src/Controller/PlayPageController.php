<?php

namespace App\Controller;

use App\Form\ResponseUserType;
use App\Repository\QuestionRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PlayPageController extends AbstractController
{
    #[Route('/play', name: 'app_play_page')]
    public function index(QuestionRepository $question_repository, SessionInterface $session): Response
    {
        $session->remove('ids');
        $session->remove('response');
        $AllQuestions = $question_repository->findAllValid();
        shuffle($AllQuestions);
        $question = array_slice($AllQuestions, 0, 5);
        $ids = array_map(function ($q) {
            return $q->getId();
        }, $question);
        $session->set('ids', $ids);
        $categories =[];
        // $test =$question[0]->getCategories()[0]->getname();
        foreach ($question as $index=>$q) {
            $cat='';
            foreach($q->getCategories() as $category) {
                $newCat = $category->getName();
                $cat = $cat . ' ' . $newCat;
            }
            $categories[$index] = $cat;
        }

        
        $form = $this->createForm(ResponseUserType::class);

        return $this->render('play_page/index.html.twig', [
            
            'questions' => $question,
            'form' => $form->createView(),
            'categories' => $categories,
            // 'test' => $test,
        ]);
    }
}
