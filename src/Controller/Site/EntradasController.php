<?php

namespace App\Controller\Site;

use App\Entity\Entrada;
use App\Entity\Tags;
use App\Form\EntradasType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Utils\GenerateTags\GenerateTags;

/**
 * @Route("/site")
 */
class EntradasController extends AbstractController
{

    private $entradas;

    public function __construct()
    {
        $this->entradas = $this->getDoctrine()
                ->getRepository(Entradas::class);
    }

    /**
     * @Route("/", name="site_index", methods={"GET"})
     */
    public function index(): Response
    {

        $entradas = $this->entradas->findAll();
        return $this->render('site/entradas/index.html.twig', [
                    'entradas' => $entradas,
        ]);
    }

    /**
     * @Route("/entrada-nueva", name="site_entrada_nueva", methods={"GET","POST"})
     */
    public function entradaNueva(Request $request): Response
    {

        $entrada = new Entrada();
        $form = $this->createForm(EntradasType::class, $entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entrada);
            $entityManager->flush();

            $tags = $generateTags->generate($entrada->getDescription());
            $this->getDoctrine()->getRepository(Tags::class)
                    ->updateTagsCloud($tags, $entrada);

            return $this->redirectToRoute('site_index');
            
        }

        return $this->render('site/entradas/entrada_nueva.html.twig', [
                    'entrada' => $entrada,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/entrada/{id}/mostrar", name="site_entrada_mostrar", methods={"GET"})
     */
    public function entradaMostrar(Entrada $entrada): Response
    {
        return $this->render('site/entradas/entrada_mostrar.html.twig', [
                    'entrada' => $entrada,
        ]);
    }

    /**
     * @Route("/entrada/{id}/editar", name="site_entrada_editar", methods={"GET","POST"})
     */
    public function entradaEditar(Request $request, Entrada $entrada): Response
    {

        $form = $this->createForm(EntradasType::class, $entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entrada);
            $entityManager->flush();

            $tags = $generateTags->generate($entrada->getDescription());
            $this->getDoctrine()->getRepository(Tags::class)
                    ->updateTagsCloud($tags, $entrada);

            return $this->redirectToRoute('site_index');
        }

        return $this->render('site/entradas/entrada_editar.html.twig', [
                    'entrada' => $entrada,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/entrada/{id}/borrar", name="site_entrada_borrar", methods={"DELETE"})
     */
    public function entradaBorrar(Request $request, Entradas $entrada): Response
    {
        if ($this->isCsrfTokenValid('delete' . $entrada->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($entrada);
            $entityManager->flush();
        }

        return $this->redirectToRoute('index');
    }

}
