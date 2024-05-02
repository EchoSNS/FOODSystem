<?php 
class AdminClass{
    private $dbconn;
    public $usernameExists;

    public function __construct($conn){
        $this->dbconn = $conn;
    }

    public function getAdminID($adminUsername){
        try{
            $query = $this->dbconn->prepare("SELECT UserID FROM AdminTbl WHERE AdminUsername=:username");
            $query->bindparam(":username", $adminUsername);
            $query->execute();
            if($query->rowCount() > 0){
                $admin_id = $query->fetch(PDO::FETCH_COLUMN, 0);
            }
            return $admin_id;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getAdminRowData($adminID){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM AdminTbl WHERE UserID=:UserID");
            $query->bindparam(":UserID", $adminID);
            $query->execute();

            $rowData = $query->fetch(PDO::FETCH_ASSOC);
            return $rowData;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function deleteAdminRowData($adminID){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM AdminTbl WHERE UserID=:UserID");
            $query->bindparam(":UserID", $adminID);
            $query->execute();
            if($query->rowCount() > 0){
                $query = $this->dbconn->prepare("DELETE FROM AdminTbl WHERE UserID=:UserID");
                $query->bindparam(":UserID", $adminID);
                $query->execute();
                return true;
            }
            return false;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getAllAdminData(){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM AdminTbl");
            $query->execute();
            if($query->rowCount() > 0){
                $rowArr = $query->fetchAll(PDO::FETCH_ASSOC);
                return $rowArr;
            }
            return null;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function editAdminRowData($adminID, $username, $password){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM AdminTbl WHERE UserID=:adminID");
            $query->bindparam(":adminID", $adminID);
            $query->execute();
            if($query->rowCount() > 0){
                $query = $this->dbconn->prepare("UPDATE AdminTbl SET AdminUsername=:adminUsername, AdminPassword=:adminPassword WHERE UserID=:adminID");
                $query->bindparam(":adminUsername", $username);
                $query->bindParam(':adminPassword', $this->hashPassword($password));
                $query->bindparam(":adminID", $adminID);
                $query->execute();
                return true;
            }
            return false;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function createAdminAccount($username, $password){
        try{
            if(usernameAlreadyExists($username)){
                $this->usernameExists = true;
                return false;
            }
            $query = $this->dbconn->prepare("INSERT INTO AdminTbl (AdminUsername,AdminPassword) VALUES(:username,:password)");

            $query->bindParam(':username', $username);
            $query->bindParam(':password', $this->hashPassword($password));
            $query->execute();
            return true;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function usernameAlreadyExists($username){
        $query = $this->dbconn->prepare("SELECT AdminUsername FROM AdminTbl WHERE AdminUsername=:username");
        $query->bindParam(':username', $username);
        $query->execute();

        if($query->rowCount() > 0){
            return true;
        }
        return false;
    }

    public function hashPassword($password){
        $pass = password_hash($password, PASSWORD_DEFAULT);
        return $pass;
    }

    public function accountCheck($username, $password){
        try{
            $query = $this->dbconn->prepare("SELECT AdminPassword FROM AdminTbl WHERE AdminUsername=:username");
            $query->bindParam(':username', $username);
            $query->execute();
            if($query->rowCount() > 0){ 
                $pw = $query->fetchColumn(); 
                if(password_verify($password, $pw)){ 
                    return true;
                }
            }
            return false;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}
?>