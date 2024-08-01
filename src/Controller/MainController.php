<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UserFormType;
use App\Repository\DepartementsRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(Request $request,
     EntityManagerInterface $em,
     UsersRepository $usersRepository  ): Response
    {
        
        $allusers = $usersRepository->findAll();
        $user = new Users();
        $form = $this->createForm(UserFormType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'User created');
            
            return $this->redirectToRoute('main');
            

        }
        

    
        return $this->render('main/index.html.twig', [
            'userform' => $form,
            'users' => $allusers
        ]);
    }

    #[Route('/Departements', name: 'departments')]
    public function getDepartments(Request $request, DepartementsRepository $dp)
    {
        $regionId = $request->query->get('regionId');
        $departments = $dp->findBy(['regiondep' => $regionId]);
        
       
        $responseArray = [];
        foreach ($departments as $department) {
            $responseArray[] = [
                'id' => $department->getId(),
                'name' => $department->getName(),
            ];
        }

        return new JsonResponse($responseArray);
    }
}
