<?php
namespace App\Controller\admin;

use App\Entity\User;
use App\Form\UserformType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class UsersController extends AbstractController
{
    function index() {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('App:User')->findAll();

       /** $formatted = [];
        foreach ($users as $user) {
            $formatted[] = [
                'id' => $user->getId(),
                'name' => $user->getNom(),
                'Email'=> $user->getEmail()

            ];
        }

        return new JsonResponse($formatted);**/

        return $this->render('admin\users\index.html.twig', ['users' => $users]);
    }

    function add() {
        $user = new User();
        $form = $this->createForm(UserFormType::class, $user);

        $request = Request::createFromGlobals();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('admin_users');

        }

        return $this->render('admin\users\add.html.twig', [
            'formUseer' => $form->createView()
        ]);
    }


    function delete($id) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('App:User')->find($id);
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('admin_users');
    }

    function updateUser(Request $request, User $user)
    {
         $form = $this->createForm(UserFormType::class, $user);

         $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('admin_users');

        }

         return $this->render('admin\users\update.html.twig', [
             'updateUser' => $form->createView()
         ]);
    }
}