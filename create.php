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

	
	if (!empty($data->title) && !empty($data->author) && !empty($data->summary) && !empty($data->amount)) {
		
		$all->title = $data->title;
		$all->author = $data->author;
		$all->summary = $data->summary;
		$all->amount = $data->amount;
		$all->publishedDate = $data->publishedDate;
		$all->status = $data->status;

		

		if ($all->addBook($all->title, $all->author, $all->summary, $all->amount, $all->publishedDate, $all->status)) {
			http_response_code(201);
			echo json_encode(array("message" => "Book added successfully"));
		}else{
			http_response_code(503);        
        echo json_encode(array("message" => "Unable to create item."));

		}

	}else{
		http_response_code(400);
		echo json_encode(array("message" => "Could not upload book, all fields are required"));
	}


?>