<?php

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	include_once 'allFunctions.php';
	include_once 'connect.php';


	$database = new Dbh();
	$db = $database->connect();

	$all = new apiFunctions($db);

	$data = json_decode(file_get_contents("php://input"));

	$all->id = $data->id;

	if ($all->updateToPublished($all->id)) {
		http_response_code(201);
		echo json_encode(array("message" => "Book published successfully"));
	}else{
		http_response_code(503);        
        echo json_encode(array("message" => "Unable to publish book... try again"));
	}


?>