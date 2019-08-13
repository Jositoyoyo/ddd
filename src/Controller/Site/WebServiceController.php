<?php

namespace App\Controller\WebService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Utils\WebServices\AdysaGroup\AdysaGroupWebServiceService;
use App\Entity\Entrada\AdysaGroup;

/**
 * @Route("/webservice")
 */
class WebServiceController extends AbstractController
{

    private $adysaGroup;

    public function __construct()
    {
        $this->adysaGroup = new AdysaGroupWebServiceService();
    }

    /**
     * @Route("/", name="webservice_index", methods={"GET", "POST"})
     */
    public function index(Request $request): Response
    {
        return $this->render('webservice/index.html.twig', [
                    'resultado' => null
        ]);
    }

    /**
     * @Route("/consultar", name="webservice_consultar", methods={"GET"})
     */
    public function consultar(Request $request): Response
    {

        $resultado = $this->adysaGroup->search(
                $request->get('searchterms', null)
        );

        if (!$resultado) {
            $this->addFlash('danger', 'No hay resultados en la consulta');
        }

        return $this->render('webservice/index.html.twig', [
                    'resultado' => $resultado
        ]);
    }

    /**
     * @Route("/addService", name="webservice_add", methods={"POST"})
     */
    public function add(Request $request): Response
    {
        $AdysaGroup = new AdysaGroup($title, $url);
    }

}
