<?php
	

	include_once 'connect.php';


	class apiFunctions extends Dbh{

		function addBook($title, $author, $summary, $amount){
			$publishedDate = date('d:m:Y', strtotime('now'));
			$status = "pending";

			$pdoStmt = $this->connect()->prepare("INSERT INTO Books (title, author, summary, amount, publishedDate, status) 
				VALUES ('$title', '$author', '$summary', '$amount', '$publishedDate', '$status')");

			if ($pdoStmt->execute()) {
				return true;
			}
			return false;
		}

		function getAllBooks(){
			
			$stmt = $this->connect()->query("SELECT * FROM Books");
			$stmt->execute();
			return $stmt;		
		}

		function deleteBook($id){
			$stmt = $this->connect()->prepare("DELETE FROM Books WHERE id = $id");
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}

		function updateToPublished($id){
			$status = "Published";
			$stmt = $this->connect()->prepare("UPDATE Books SET status = '$status' WHERE id = $id");
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}

		function updateToReview($id){
			$status = "In review";
			$stmt = $this->connect()->prepare("UPDATE Books SET status = '$status' WHERE id = $id");
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}

		function updateToUnpublished($id){
			$status = "Retracted";
			$stmt = $this->connect()->prepare("UPDATE Books SET status = '$status' WHERE id = $id");
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}

		function searchByStatus($status){
			$stmt = $this->connect()->query("SELECT * FROM Books WHERE status = '$status' ");
			$stmt->execute();
			return $stmt;	
		}

		function getThreeBooks(){
			$stmt = $this->connect()->prepare("SELECT * FROM Books ORDER BY RAND() LIMIT 3");
			$stmt->execute();
			return $stmt;	
		}

	}


?>