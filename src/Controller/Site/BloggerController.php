<?php

namespace App\Controller\Site;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entrada\AdysaGroup;

/**
 * @Route("/blogger")
 */
class BloggerController extends AbstractController
{

    private $blogger;

    public function __construct()
    {
        $this->blogger = $this->container->get('bloggerUseCase');
    }

    /**
     * @Route("/", name="blogger_index", methods={"GET"})
     */
    public function index(): Response
    {
        $entradas = $this->blogger->listarEntradas();
        return $this->render('webservice/index.html.twig', [
                    'entradas' => $entradas
        ]);
    }

}
