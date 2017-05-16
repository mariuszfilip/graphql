<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Entity\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GraphQL\GraphQL;
use GraphQL\Schema;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * Class ApiController
 * @package AppBundle\Controller
 */
class ApiController extends Controller
{
    /**
     * @Route("api/client", name="client")
     */
    public function indexAction(Request $request)
    {

        $clientType = new ObjectType([
            'name' => 'Client',
            'description'=>'Zwraca podstawowe informacje o kliencie',
            'fields' => [
                'pesel' => [
                    'type' => Type::string(),
                ],
                'name' => [
                    'type' => Type::string()
                ],
                'surname' => [
                    'type' => Type::string()
                ]
            ]
        ]);

        $addressType = new ObjectType([
            'name' => 'Address',
            'fields' => [
                'id' => [
                    'type' => Type::int(),
                ],
                'city' => [
                    'type' => Type::string()
                ],
                'postalcode' => [
                    'type' => Type::string()
                ],
                'country' => [
                    'type' => Type::string()
                ]
            ]
        ]);



        $queryType = new ObjectType([
            'name' => 'DaneKlienta',
            'fields' => [
                'echo' => [
                    'type' => Type::string(),
                    'description'=>'Dodaje do wiadomości prefix',
                    'args' => [
                        'message' => Type::nonNull(Type::string()),
                    ],
                    'resolve' => function ($root, $args) {
                        return $root['prefix'] . $args['message'];
                    }
                ],
                'client_info' => [
                    'type' => $clientType,
                    'description'=>'Zwraca podstawowe informacje o kliencie',
                    'args' => [
                        'id_client' => Type::nonNull(Type::int()),
                    ],
                    'resolve' => function ($root, $args) {
                        if($args['id_client'] <= 0){
                            throw new \Exception('Klient nie istnieje');
                        }
                        $client = new Client(1, 'Mariusz', 'Filipkowski', 'XXXXXXXXX');
                        return $client->toArray();
                    }
                ],
                'address_info' => [
                    'type' => $addressType,
                    'description'=>'Zwraca informacje o adresie klienta',
                    'args' => [
                        'id_client' => Type::nonNull(Type::int()),
                    ],
                    'resolve' => function ($root, $args) {
                        if($args['id_client'] <= 0){
                            throw new \Exception('Klient nie istnieje');
                        }
                        $address = new Address(2, "Łomża", '18-520', 'Poland', 'XXXXX');
                        return $address->toArray();
                    }
                ]
            ],
        ]);


        $schema = new Schema([
            'query' => $queryType,
        ]);

        $rawInput = file_get_contents('php://input');
        $input = json_decode($rawInput, true);
        $query = $input['query'];
        $variableValues = isset($input['variables']) ? $input['variables'] : null;

        try {
            $rootValue = ['prefix' => 'You said: '];
            $result = GraphQL::execute($schema, $query, $rootValue, null, $variableValues);
        } catch (\Exception $e) {
            $result = [
                'error' => [
                    'message' => $e->getMessage()
                ]
            ];
        }
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($result);
        exit();
    }
}
