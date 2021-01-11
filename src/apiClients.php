<?php

include 'client.php';

class apiClients
{

    public function getAll()
    {
        $client = new Client();
        $clients = array();
        $clients['register'] = array();

        $result = $client->getClients();

        if ($result->rowCount()) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $register = array(
                    "clientID" => $row['clientID'],
                    "clientEmail" => $row['clientEmail'],
                    "date" => $row['date'],
                    "orderQty" => $row['orderQty'],

                );
                array_push($clients['register'], $register);
            }
            http_response_code(200);
            echo json_encode($clients);
        } else {
            http_response_code(404);
            echo json_encode(array('message' => 'Element not found'));
        }
    }
}


$api = new apiClients();
$api->getAll();
