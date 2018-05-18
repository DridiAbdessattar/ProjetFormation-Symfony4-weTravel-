<?php

namespace App\Controller\admin;

use App\Entity\Image;
use App\Entity\VaoyageOrganise;
use App\Form\VaoyageOrganiseType;
use App\Repository\VaoyageOrganiseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/vaoyage/organise")
 */
class VaoyageOrganiseController extends Controller
{
    /**
     * @Route("/", name="vaoyage_organise_index", methods="GET")
     */
    public function index(VaoyageOrganiseRepository $vaoyageOrganiseRepository): Response
    {
        return $this->render('admin/vaoyage_organise/index.html.twig', ['vaoyage_organises' => $vaoyageOrganiseRepository->findAll()]);
    }

    /**
     * @Route("/new", name="vaoyage_organise_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {

        $vaoyageOrganise = new VaoyageOrganise();
        /*$images = new Image();
        $images->setUrl('ddddddddddd');
        $vaoyageOrganise->addImage($images);*/


        $form = $this->createForm(VaoyageOrganiseType::class, $vaoyageOrganise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

           if ($vaoyageOrganise->getCover()){ $file = $vaoyageOrganise->getCover();

            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );

            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $vaoyageOrganise->setCover($fileName);
           }
            $em = $this->getDoctrine()->getManager();
            $em->persist($vaoyageOrganise);
            $em->flush();

            return $this->redirectToRoute('vaoyage_organise_index');
        }
        return $this->render('admin/vaoyage_organise/new.html.twig', [
            'vaoyage_organise' => $vaoyageOrganise,
            'form' => $form->createView(),
        ]);
    }
	/**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

    /**
     * @Route("/{id}", name="vaoyage_organise_show", methods="GET")
     */
    public function show(VaoyageOrganise $vaoyageOrganise): Response
    {
        return $this->render('admin/vaoyage_organise/show.html.twig', ['vaoyage_organise' => $vaoyageOrganise]);
    }

    /**
     * @Route("/{id}/edit", name="vaoyage_organise_edit", methods="GET|POST")
     */
    public function edit(Request $request, VaoyageOrganise $vaoyageOrganise): Response
    {

        $oldCover = $vaoyageOrganise->getCover();

        $form = $this->createForm(VaoyageOrganiseType::class, $vaoyageOrganise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

         if($vaoyageOrganise->getCover())
            {

                $file = $vaoyageOrganise->getCover();

                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

                // moves the file to the directory where brochures are stored
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName);

                $vaoyageOrganise->setCover($fileName);

            }
            else{
             $vaoyageOrganise->setCover($oldCover);

            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vaoyage_organise_edit', ['id' => $vaoyageOrganise->getId()]);
        }

        return $this->render('admin/vaoyage_organise/edit.html.twig', [
            'vaoyage_organise' => $vaoyageOrganise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vaoyage_organise_delete", methods="DELETE")
     */
    public function delete(Request $request, VaoyageOrganise $vaoyageOrganise): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vaoyageOrganise->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($vaoyageOrganise);
            $em->flush();
        }

        return $this->redirectToRoute('vaoyage_organise_index');
    }
}
