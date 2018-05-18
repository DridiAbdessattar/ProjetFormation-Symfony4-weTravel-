<?php
// src/Controller/DefaultController.php
namespace App\Controller\admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function login()
    {
        return $this->render('admin/login.html.twig');
    }
	
	 public function index()
    {
        return $this->render('admin/index.html.twig');
    }



	}