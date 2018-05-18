<?php

namespace App\Controller\admin;

use App\Entity\Ville;
use App\Form\Ville1Type;
use App\Repository\VilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/ville")
 */
class VilleController extends Controller
{
    /**
     * @Route("/", name="ville_index", methods="GET")
     */
    public function index(VilleRepository $villeRepository): Response
    {
        return $this->render('admin/ville/index.html.twig', ['villes' => $villeRepository->findAll()]);
    }

    /**
     * @Route("/new", name="ville_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $ville = new Ville();
        $form = $this->createForm(Ville1Type::class, $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ville);
            $em->flush();

            return $this->redirectToRoute('ville_index');
        }

        return $this->render('admin/ville/new.html.twig', [
            'ville' => $ville,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ville_show", methods="GET")
     */
    public function show(Ville $ville): Response
    {
        return $this->render('admin/ville/show.html.twig', ['ville' => $ville]);
    }

    /**
     * @Route("/{id}/edit", name="ville_edit", methods="GET|POST")
     */
    public function edit(Request $request, Ville $ville): Response
    {
        $form = $this->createForm(Ville1Type::class, $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ville_edit', ['id' => $ville->getId()]);
        }

        return $this->render('admin/ville/edit.html.twig', [
            'ville' => $ville,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ville_delete", methods="DELETE")
     */
    public function delete(Request $request, Ville $ville): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ville->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ville);
            $em->flush();
        }

        return $this->redirectToRoute('ville_index');
    }
}