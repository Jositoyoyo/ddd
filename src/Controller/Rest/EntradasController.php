<?php

namespace App\Controller\Rest;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entradas;

/**
 * @Route("/rest")
 */
class EntradasController extends AbstractController
{

    private $entradaRespository;
    private $entrada;

    public function __construct()
    {
        $this->entradaRespository = $this->getDoctrine()
                ->getRepository(Entradas::class);
        $this->entrada = $this->container->get('entrada.service');
    }

    /**
     * @Route("/", name="rest_index", methods={"GET"}, defaults={"_format"="xml"})
     */
    public function index(): Response
    {
        $entradas = $this->entradaRespository->findAll();
        return $this->render('rest/xml/entradas/index.xml.twig', [
                    'entradas' => $entradas,
        ]);
    }

    /**
     * @Route("/entrada/alta", name="rest_entrada_alta", methods={"POST"}, defaults={"_format"="xml"}))
     */
    public function alta(Request $request): Response
    {

        $entrada = $this->entrada->alta(
                $request->request->get('name', null),
                $request->request->get('description', null)
        );

        return $this->render('rest/xml/entradas/entrada_mostrar.xml.twig', [
                    'entrada' => $entrada,
        ]);
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
     * @Route("/entrada/{id}/editar", name="entrada_editar", methods={"POST"}, defaults={"_format"="xml"})
     */
    public function editar(Request $request, Entrada $entrada): Response
    {
        $entrada = $this->entrada->editar(
                $entrada,
                $request->request->get('name', null),
                $request->request->get('description', null)
        );

        return $this->render('rest/xml/entradas/entrada_mostrar.xml.twig', [
                    'entrada' => $entrada,
        ]);
    }

    /**
     * @Route("/entrada/{id}/borrar", name="entrada_borrar", methods={"DELETE"}, defaults={"_format"="xml"})
     */
    public function borrar(Entrada $entrada): Response
    {
        $entrada = $this->entrada->borrar(
                $entrada
        );
        return $this->render('rest/xml/entradas/respuesta.xml.twig', [
                    'entrada' => $entrada,
        ]);
    }

}
