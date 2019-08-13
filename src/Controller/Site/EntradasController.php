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

    private $entradaRepository;
    private $entradaUseCaseAlta;

    public function __construct()
    {
        $this->entradaRepository = $this->getDoctrine()
                ->getRepository(Entradas::class);
        $this->entradaUseCaseAlta = $this->container->get('EntradasUseCaseAlta');
    }

    /**
     * @Route("/", name="site_index", methods={"GET"})
     */
    public function index(): Response
    {

        $entradas = $this->entradaRepository->findAll();
        return $this->render('site/entradas/index.html.twig', [
                    'entradas' => $entradas,
        ]);
    }

    /**
     * @Route("/alta", name="site_entrada_nueva", methods={"GET","POST"})
     */
    public function alta(Request $request): Response
    {

        $form = $this->createForm(EntradasType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entrada = $this->entradaUseCaseAlta(
                    $request->request->get('name', null),
                    $request->request->get('description', null)
            );
            return $this->redirectToRoute('site_entrada_mostrar', [
                        'id', $entrada->getId()
            ]);
        }

        return $this->render('site/entradas/entrada_nueva.html.twig', [
                    'entrada' => null,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/entrada/{id}/mostrar", name="site_entrada_mostrar", methods={"GET"})
     */
    public function mostrar(Entrada $entrada): Response
    {
        return $this->render('site/entradas/entrada_mostrar.html.twig', [
                    'entrada' => $entrada,
        ]);
    }

    /**
     * @Route("/entrada/{id}/editar", name="site_entrada_editar", methods={"GET","POST"})
     */
    public function editar(Request $request, Entrada $entrada): Response
    {

        $form = $this->createForm(EntradasType::class, $entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entrada = $this->entradaUseCaseEditar(
                    $request->request->get('name', null),
                    $request->request->get('description', null)
            );

        }

        return $this->render('site/entradas/entrada_editar.html.twig', [
                    'entrada' => $entrada,
                    'form' => $form->createView(),
        ]);
        
    }

    /**
     * @Route("/entrada/{id}/borrar", name="site_entrada_borrar", methods={"DELETE"})
     */
    public function borrar(Request $request, Entradas $entrada): Response
    {
        
        if ($this->isCsrfTokenValid('delete' . $entrada->getId(), $request->request->get('_token'))) {
            $this->entradaRepository->baja($entrada);
        }

        return $this->redirectToRoute('index');
        
    }

}
