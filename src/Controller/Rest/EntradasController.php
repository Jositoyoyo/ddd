<?php

namespace App\Controller\Rest;

use App\Entity\Entradas;
use App\Entity\Tags;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Utils\GenerateTags\GenerateTags;

/**
 * @Route("/rest")
 */
class EntradasController extends AbstractController {

    /**
     * @Route("/", name="rest_index", methods={"GET"}, defaults={"_format"="xml"})
     */
    public function index(): Response {

        $entradas = $this->getDoctrine()
                ->getRepository(Entradas::class)
                ->findAll();

        return $this->render('rest/xml/entradas/index.xml.twig', [
                    'entradas' => $entradas,
        ]);
    }

    /**
     * @Route("/entrada-nueva", name="rest_entrada_nueva", methods={"POST"})
     */
    public function entradaNueva(Request $request, GenerateTags $generateTags): Response {

        if ($request->isMethod('POST')) {

            $name = $request->get('name', null);
            $description = $request->get('description', null);

            $entrada = new Entradas();
            $entrada->setName($name);
            $entrada->setDescription($description);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entrada);
            $entityManager->flush();

            $tags = $generateTags->generate($entrada->getDescription());
            $this->getDoctrine()->getRepository(Tags::class)
                    ->updateTagsCloud($tags, $entrada);

            return $this->render('rest/xml/entradas/entrada_mostrar.xml.twig', [
                        'entrada' => $entrada,
            ]);
        }
    }

    /**
     * @Route("/entrada/{id}/mostrar", name="rest_entrada_mostrar", methods={"GET"}, defaults={"_format"="xml"})
     */
    public function entradaMostrar(Entradas $entrada): Response {
        return $this->render('rest/xml/entradas/entrada_mostrar.xml.twig', [
                    'entrada' => $entrada,
        ]);
    }

    /**
     * @Route("/entrada/{id}/editar", name="entrada_editar", methods={"GET","POST"})
     */
    public function entradaEditar(Request $request, Entradas $entrada, GenerateTags $generateTags): Response {

        if ($request->isMethod('POST')) {

            $name = $request->get('name', null);
            $description = $request->get('description', null);

            $entrada->setName($name);
            $entrada->setDescription($description);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entrada);
            $entityManager->flush();

            $tags = $generateTags->generate($entrada->getDescription());
            $this->getDoctrine()->getRepository(Tags::class)
                    ->updateTagsCloud($tags, $entrada);
        }

        return $this->render('rest/xml/entradas/entrada_mostrar.xml.twig', [
                    'entrada' => $entrada,
        ]);
    }

    /**
     * @Route("/entrada/{id}/borrar", name="entrada_borrar", methods={"DELETE"})
     */
    public function entradaBorrar(Request $request, Entradas $entrada): Response {
        if ($request->isMethod('DELETE')) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($entrada);
            $entityManager->flush();
            return $this->render('rest/xml/entradas/respuesta.html.twig', [
                'estado' => 'OK',
                'operacion' => 'eliminar entrada',
                'mensaje' => 'Entrada borrada con exito'
            ]);
        }
    }

}
