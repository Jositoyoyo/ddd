<?php

namespace App\Controller\Site;

use App\Entity\Entradas;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class IndexController extends AbstractController {

    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(): Response {
        return $this->render('index.html.twig', []);
    }

}
