<?php

namespace App\Controller\WebService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Utils\WebServices\AdysaGroup\AdysaGroupWebServiceService;

/**
 * @Route("/webservice")
 */
class WebServiceController extends AbstractController {

    /**
     * @Route("/", name="webservice_index", methods={"GET", "POST"})
     */
    public function index(Request $request): Response {

        $resultado = '';

        if ($request->isMethod('POST')) {
            
            $searchterms = $request->get('searchterms', null);
            $search = new AdysaGroupWebServiceService();
            $resultado = $search->search($searchterms);

            if (!$resultado) {
                $this->addFlash('danger', 'No hay resultados en la busqueda');
            }
            
        }
        
        return $this->render('webservice/index.html.twig', [
                    'resultado' => $resultado
        ]);
        
    }

}
