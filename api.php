<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config.php';
include_once 'states.php';

$database = new Database();
$db = $database->getConnection();
$states = new States($db);

$requestMethod = $_SERVER["REQUEST_METHOD"];
switch ($requestMethod) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $states->id = $_GET["id"];
            $response = $states->readOne();
        } else {
            $response = $states->readAll();
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        $states->name = $data->name;
        $states->nickname = $data->nickname;
        $response = $states->create();
        break;
    case 'PUT':
        $data = json_decode(file_get_contents("php://input"));
        $states->id = $data->id;
        $states->name = $data->name;
        $states->nickname = $data->nickname;
        $response = $states->update();
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"));
        $states->id = $data->id;
        $response = $states->delete();
        break;
    default:
        http_response_code(405);
        $response = array("message" => "Invalid request method");
}

echo json_encode($response);
