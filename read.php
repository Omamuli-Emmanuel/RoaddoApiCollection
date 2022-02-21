<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	include_once 'allFunctions.php';
	include_once 'connect.php';

	$database = new Dbh();
	$db = $database->connect();

	$all = new apiFunctions($db);

	$result = $all->getAllBooks();


	if ($result->rowCount()) {
		$records = array();
		$records["all"] = array();
			while ($all = $result->fetch()) {
				extract($all);

				$dets = array(
					"id" => $id, 
					"title" => $title, 
					"author" => $author,
					"summary" => $summary, 
					"amount" => $amount,
					"publishDate" => $publishedDate, 
					"status" => $status
				);

				array_push($records["all"], $dets);
			}
			http_response_code(200);
			echo json_encode($records);
	}else{
		http_response_code(404);
		echo json_encode(array("message" => "No item found"));
	}


?>