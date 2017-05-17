<?php

namespace AppBundle\Controller;

use EUAutomation\GraphQL\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $client = new Client($request->getUri().'api/client');

        $response = $client->response('{client_info
        (id_client:1)
        {
        name
    pesel
    surname
  }}');
        var_dump($response->all());
        var_dump($response->toJson());
        var_dump($response->errors());
        var_dump($response->hasErrors());
        var_dump($response->all()->client_info->name);


        exit();

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }


}
