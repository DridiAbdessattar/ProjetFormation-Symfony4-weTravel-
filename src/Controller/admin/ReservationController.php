<?php
namespace App\Controller\admin;

use App\Entity\Reservation;
use App\Entity\User;
use App\Form\ReservationType;
use App\Form\UserformType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReservationController extends AbstractController
{
    function index() {
        $em = $this->getDoctrine()->getManager();

        $reservation = $em->getRepository('App:Reservation')->findAll();

        return $this->render('admin\reservations\index.html.twig', ['reservations' => $reservation]);
    }

    function add() {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);

        $request = Request::createFromGlobals();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();

            return $this->redirectToRoute('admin_reservation');

        }

        return $this->render('admin\reservations\add.html.twig', [
            'FormReservation' => $form->createView()
        ]);
    }


    function delete($id) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('App:Reservation')->find($id);
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('admin_reservation');
    }

    function updateReservation(Request $request, Reservation $reservation)
    {
        $form = $this->createForm(ReservationType::class, $reservation);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('admin_reservation');

        }

        return $this->render('admin\reservations\update.html.twig', [
            'updateReservation' => $form->createView()
        ]);
    }
}