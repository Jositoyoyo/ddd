<?php

namespace App\Controller\Rest;

use App\Entity\Entradas;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rest")
 */
class EntradasController extends AbstractController
{
    private $entrada;
    
    public function __construct()
    {
        $this->entrada = $this->getDoctrine()
                ->getRepository(Entradas::class);
        $this->entradaService= $this->container->get('entradaService');
    }

    /**
     * @Route("/", name="rest_index", methods={"GET"}, defaults={"_format"="xml"})
     */
    public function index(): Response
    {
        $entradas = $this->entrada->findAll();
        return $this->render('rest/xml/entradas/index.xml.twig', [
                    'entradas' => $entradas,
        ]);
    }

    /**
     * @Route("/entrada/alta", name="rest_entrada_alta", methods={"POST"}, defaults={"_format"="xml"}))
     */
    public function alta(Request $request): Response
    {

        if ($request->isMethod('POST')) {

            $entrada = $this->entradaService(
                    $request->request->get('name', null),
                    $request->request->get('description', null)
            );

            return $this->render('rest/xml/entradas/entrada_mostrar.xml.twig', [
                        'entrada' => $entrada,
            ]);
            
        }
    }

    /**
     * @Route("/entrada/{id}/mostrar", name="rest_entrada_mostrar", methods={"GET"}, defaults={"_format"="xml"})
     */
    public function mostrar(Entradas $entrada): Response
    {
        return $this->render('rest/xml/entradas/entrada_mostrar.xml.twig', [
                    'entrada' => $entrada,
        ]);
    }

    /**
     * @Route("/entrada/{id}/editar", name="entrada_editar", methods={"GET","POST"}, defaults={"_format"="xml"})
     */
    public function editar(Request $request, Entradas $entrada, GenerateTags $generateTags): Response
    {

        if ($request->isMethod('POST')) {

        }

        return $this->render('rest/xml/entradas/entrada_mostrar.xml.twig', [
                    'entrada' => $entrada,
        ]);
    }

    /**
     * @Route("/entrada/{id}/borrar", name="entrada_borrar", methods={"DELETE"}, defaults={"_format"="xml"})
     */
    public function borrar(Request $request, Entradas $entrada): Response
    {
        if ($request->isMethod('DELETE')) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($entrada);
            $entityManager->flush();
            return $this->render('rest/xml/entradas/respuesta.xml.twig', [
                    'entrada' => $entrada,
        ]);
        }
    }

}
