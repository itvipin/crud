<?php
include_once('./Models/Database.php');

class User
{
    private $conn;

    function __construct()
    {
        $this->conn = Database::getConnection();
		
    }

    function getUser($email, $password)
    {
        try
        {
            $sql = "SELECT email_id, password, user_id, is_active FROM user_details WHERE email_id=:email and password=:password";
            $query = $this->conn->prepare($sql);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':password', $password, PDO::PARAM_STR);
            $query->execute();
            return $query->fetch(PDO::FETCH_OBJ);
			
        }
        catch(Exception $e)
        {
            exit("Error: " . __METHOD__ . $e->getMessage());
        }
    }

    function deleteUser($id)
    {
        try
        {
            $sql = "delete FROM user_details WHERE user_id = :id";
            $query = $this->conn->prepare($sql);          
            $query->bindParam(':id', $id, PDO::PARAM_STR);
            $query->execute();
        }
        catch(Exception $e)
        {
            exit("Error: " . __METHOD__ . $e->getMessage());
        }
    }

    function getUsers($userId = null, $roleName = null, $pageNo = null, $page_size = null)
    {
        try
        {
			$limit1 = ($pageNo - 1) * $page_size;
			$sql = "SELECT 
					  ud.username, 
					  ud.mobile, 
					  ud.gender, 
					  ud.city, 
					  ud.user_id, 
					  r.role_name 
					from 
					  user_details as ud
					  join roles as r on r.id = ud.role_id ";

            if (isset($userId))
            {
                $sql = $sql . ' where ud.user_id = :userid';
            }
			
			if (isset($roleName))
            {
                $sql = $sql . ' where r.role_name = :roleName ';
            }
			
			if (isset($pageNo, $page_size))
			{
				$sql = $sql . ' LIMIT :limit1 ,:page_size ';
				
			}
			
			$query = $this->conn->prepare($sql);
			
			if (isset($userId)) {
                $query->bindParam(':userid', $userId, PDO::PARAM_STR);
			}
			
			if (isset($roleName)) {
                $query->bindParam(':roleName', $roleName, PDO::PARAM_STR);
			}
			if (isset($pageNo, $page_size))
			{
				$query->bindParam(':limit1', $limit1, PDO::PARAM_INT);
				$query->bindParam(':page_size', $page_size, PDO::PARAM_INT);
			}
			$query->execute();
			return $query->fetchAll(PDO::FETCH_OBJ);
        }
        catch(Exception $e)
        {
            exit("Error: " . __METHOD__ . $e->getMessage());
        }
    }

    function updateUser($updated_data, $userid)
    {
        try
        {
			extract($updated_data);
            $sql = "UPDATE user_details SET username=:efullname,mobile=:emobile,gender=:egender,city=:ecity WHERE user_id=:userid";
            $query = $this->conn->prepare($sql);
            $query->bindParam(':efullname', $efullname, PDO::PARAM_STR);
            $query->bindParam(':emobile', $emobile, PDO::PARAM_STR);
            $query->bindParam(':ecity', $ecity, PDO::PARAM_STR);
            $query->bindParam(':egender', $egender, PDO::PARAM_STR);
            $query->bindParam(':userid', $userid, PDO::PARAM_STR);
            return $query->execute();
        }
        catch(Exception $e)
        {
            exit("Error: " . __METHOD__ . $e->getMessage());
        }
    }

    function insertUser($new_data, $userid)
    {
        try
        {
			extract($new_data);
			$status=1;
            $sql = "INSERT INTO user_details(user_id, username, mobile, email_id, password, is_active, city, gender, role_id) VALUES(:userid, :fullname, :mobileno, :email, :password, :status, :city, :gender, :role)";
            $query = $this->conn->prepare($sql);
            $query->bindParam(':userid', $userid, PDO::PARAM_STR);
            $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
            $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':password', $password, PDO::PARAM_STR);
            $query->bindParam(':status', $status, PDO::PARAM_STR);
            $query->bindParam(':city', $city, PDO::PARAM_STR);
            $query->bindParam(':gender', $gender, PDO::PARAM_STR);
			$query->bindParam(':role', $role, PDO::PARAM_STR);
            return $query->execute();
        }
        catch(Exception $e)
        {
            exit("Error: " . __METHOD__ . $e->getMessage());
        }
    }
	
	 function getEmail($email)
    {
		
        try
        {
			$sql = "SELECT username FROM user_details WHERE email_id=:email";	
			$query = $this->conn->prepare($sql);
			$query->bindParam(':email', $email, PDO::PARAM_STR);
			$query->execute();
			return $query->fetch(PDO::FETCH_OBJ);	
        }
        catch(Exception $e)
        {
            exit("Error: " . __METHOD__ . $e->getMessage());
        }
    }
	
	 function dataCount()
	 {
		 try
		 {
			$sql = "Select count(*) as user_count from user_details";
			$query = $this->conn->prepare($sql);
			$query->execute();
			return $query->fetch(PDO::FETCH_OBJ);
		 }
		 catch(Exception $e)
		 {
			 exit("Error: " . __METHOD__ . $e->getMessage());
		 }
	 }
	
}

