<?php
	require_once "loginObject.php";

	class blog
	{
		//This function will create a new blog post needs to be supplied with the post title and body
		function create($title, $body, $pageassoc){
			if(!$pageassoc == 0){
			if (filter_var($pageassoc, FILTER_VALIDATE_INT) == false){
	    		return "Pageassoc must be a valid integer";
			}
		}
			include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
			if(isset($_SESSION['LOGIN'])){
				$login = new user();
				$fetch = $login->fetchSingle($_SESSION['USER']);
				foreach($fetch as $fetched){
					$author = $fetched['userName'];
				}
			}
			else{
				$author = "Cheif Geek";
			}
			$date =date('Y-m-d H:i:s');
			$stmt =$conn->prepare("INSERT INTO blog (blogDate, blogTitle, blogBody, blogPage, blogAuthor) VALUES (?,?,?,?,?)");
			$stmt->bind_param("sssss", $date, $newTitle, $newBody, $newPageassoc, $newAuthor);

			$newTitle = mysqli_real_escape_string($conn, $title);
			$newBody =mysqli_real_escape_string($conn, $body);
			$newPageassoc =mysqli_real_escape_string($conn, $pageassoc);
			$newAuthor =mysqli_real_escape_string($conn, $author);

			$stmt->execute();
			$stmt->close();
			$conn->close();
		}

		//This function will a delete a blog row when provided with an row id
		function deleteByID($id){
			include "var.php";
			if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("DELETE FROM blog WHERE blogID=?");
			$stmt->bind_param("i", $id);

			$stmt->execute();
			$stmt->close();
			$conn->close();
		}

		//this function will deletea all rows with a given title
		function deleteByTitle($title){
			include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("DELETE FROM blog WHERE blogTitle=?");
			$stmt->bind_param("s", $title);

			$stmt->execute();
			$stmt->close();
			$conn->close();
		}

		//This function updates both the body and title of a specified row
		function updateAll($title, $body, $id){
			include "var.php";
			if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE blog SET blogTitle=?, blogBody=? WHERE blogID=$id");
			$stmt->bind_param("ss", $newTitle, $newBody);

			$newTitle = mysqli_real_escape_string($conn, $title);
			$newBody = mysqli_real_escape_string($conn, $body);
			$stmt->execute();
			$stmt->close();
			$conn->close();
		}

		//This function updates title of a specified row
		function updateTitle($title, $id){
			include "var.php";
			if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE blog SET blogTitle=? WHERE blogID=$id");
			$stmt->bind_param("s", $title);

			$newTitle = mysqli_real_escape_string($conn, $title);
			$stmt->execute();
			$stmt->close();
			$conn->close();
		}

		//This function updates body of a specified row
		function updateBody($body, $id){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
    		return "ID must be a valid integer";
			}
			include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE blog SET blogBody=? WHERE blogID=$id");
			$stmt->bind_param("s", $newBody);

			$newBody = mysqli_real_escape_string($conn, $body);
			$stmt->execute();
			$stmt->close();
			$conn->close();
		}

		//this function allows you to assotiacte a specific row with a page
		function setPage($page, $id){
			include "var.php";
			if(!$page == 0){
			if (filter_var($page, FILTER_VALIDATE_INT) == false){
	    		return "Page must be a valid integer";
			}
		}
			if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE blog SET blogPage=? WHERE blogID=$id");
			$stmt->bind_param("i", $newPage);

			$newPage = mysqli_real_escape_string($conn, $page);
			$stmt->execute();
			$stmt->close();
			$conn->close();
		}

		//This function returns a single row given its ID the row is returned as an associtavie array
		function fetchSingle($id){
			include "var.php";
			if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query = "SELECT * FROM blog WHERE blogID=$id";
			$results = $conn->query($query);
			$return = $results->fetch_all(MYSQLI_ASSOC);
			$conn->close();
			return $return;
		}

		//This function returns all rows the rows are returned as an associtavie array
		function fetchAll(){
			include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query ="SELECT * FROM blog";
			$results = $conn->query($query);
			$return = $results->fetch_all(MYSQLI_ASSOC);
			$conn->close();
			return $return;
		}

		//This function returns a all rows ordered by date the row are is returned as an associtavie array
		function fetchDate(){
			include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query ="SELECT * FROM blog ORDER BY blogDate DESC";
			$results = $conn->query($query);
			$return = $results->fetch_all(MYSQLI_ASSOC);
			$conn->close();
			return $return;
		}

		//This function returns all rows ordered by date for a specific page the row are is returned as an associtavie array
		function fetchDateAndPage($page){
			include "var.php";
			if(!$page == 0){
			if (filter_var($page, FILTER_VALIDATE_INT) == false){
	    		return "Page must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query ="SELECT * FROM blog Where blogPage = $page ORDER BY blogDate ASC";
			$results = $conn->query($query);
			$return = $results->fetch_all(MYSQLI_ASSOC);
			$conn->close();
			return $return;
		}
		//This function returns all rows ordered by date for a specific page the row are is returned as an associtavie array
		function fetchDateAndPageReverse($page){
			include "var.php";
			if(!$page == 0){
			if (filter_var($page, FILTER_VALIDATE_INT) == false){
	    		return "Page must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query ="SELECT * FROM blog Where blogPage = $page ORDER BY blogDate ASC";
			$results = $conn->query($query);
			$return = $results->fetch_all(MYSQLI_ASSOC);
			$conn->close();
			return $return;
		}

		//This function returns all for a specific page the row are is returned as an associtavie array
		function fetchByPage($page){
			include "var.php";
			if(!$page == 0){
			if (filter_var($page, FILTER_VALIDATE_INT) == false){
	    		return "Page must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query ="SELECT * FROM blog WHERE blogPage=$page";
			$results = $conn->query($query);
			$return = $results->fetch_all(MYSQLI_ASSOC);
			$conn->close();
			return $return;
		}
		
	}

	?>