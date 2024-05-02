<?php 
class CustomerClass{
    private $dbconn;
    public $emailExists, $usernameExists, $accountDeactivated;

    public function __construct($conn){
        $this->dbconn = $conn;
    }

    public function getCustomerID($customerUsername){
        try{
            $query = $this->dbconn->prepare("SELECT CustomerID FROM CustomerTbl WHERE CustomerUsername=:username");
            $query->bindparam(":username", $customerUsername);
            $query->execute();
            if($query->rowCount() > 0){
                $customer_id = $query->fetch(PDO::FETCH_COLUMN, 0);
            }
            return $customer_id;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getCustomerAllFavoriteProducts($customerID){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM FavoriteTbl RIGHT JOIN ProductTbl WHERE FavoriteTbl.CustomerID=:CustomerID");
            $query->bindparam(":CustomerID", $customerID);
            $query->execute();

            $rowData = $query->fetch(PDO::FETCH_ASSOC);
            return $rowData;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getCustomerRowData($customerID){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM CustomerTbl WHERE CustomerID=:CustomerID");
            $query->bindparam(":CustomerID", $customerID);
            $query->execute();

            $rowData = $query->fetch(PDO::FETCH_ASSOC);
            return $rowData;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function deleteCustomerRowData($customerID){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM CustomerTbl WHERE CustomerID=:CustomerID");
            $query->bindparam(":CustomerID", $customerID);
            $query->execute();
            if($query->rowCount() > 0){
                $query = $this->dbconn->prepare("DELETE FROM OrderTbl WHERE CustomerID=:CustomerID");
                $query->bindparam(":CustomerID", $customerID);
                $query->execute();

                $query = $this->dbconn->prepare("DELETE FROM FavoriteTbl WHERE CustomerID=:CustomerID");
                $query->bindparam(":CustomerID", $customerID);
                $query->execute();

                $query = $this->dbconn->prepare("DELETE FROM CustomerTbl WHERE CustomerID=:CustomerID");
                $query->bindparam(":CustomerID", $customerID);
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

    public function getAllCustomerData(){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM CustomerTbl");
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

    public function hashPassword($password){
        $pass = password_hash($password, PASSWORD_DEFAULT);
        return $pass;
    }

    public function editCustomerRowData($customerID, $username, $password, $emailAddress, $firstName, $middleName, $lastName, $birthdate, $contactNumber, $accountStatus){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM CustomerTbl WHERE CustomerID=:customerID");
            $query->bindparam(":customerID", $customerID);
            $query->execute();
            if($query->rowCount() > 0){
                $query = $this->dbconn->prepare("UPDATE CustomerTbl SET CustomerUsername=:customerUsername, CustomerPassword=:password, EmailAddress=:emailAddress, FirstName=:firstName, MiddleName=:middleName, LastName=:lastName, BirthDate=:birthDate, ContactNum=:contactNum, AccountStatus=:accountStatus WHERE CustomerID=:customerID");
                $query->bindparam(":customerUsername", $username);
                $query->bindParam(':password', $this->hashPassword($password));
                $query->bindparam(":emailAddress", $emailAddress);
                $query->bindparam(":firstName", $firstName);
                $query->bindparam(":middleName", $middleName);
                $query->bindparam(":lastName", $lastName);
                $query->bindparam(":birthDate", $birthdate);
                $query->bindparam(":contactNum", $contactNumber);
                $query->bindparam(":accountStatus", $accountStatus);
                $query->bindparam(":customerID", $customerID);
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

    public function createCustomerAccount($username, $password, $emailAddress, $firstName, $middleName, $lastName, $birthdate, $contactNumber, $accountStatus){
        try{
            if($this->emailAlreadyExists($emailAddress)){
                $this->emailExists = true;
                return false;
            }
            if($this->usernameAlreadyExists($username)){
                $this->usernameExists = true;
                return false;
            }
            $query = $this->dbconn->prepare("INSERT INTO CustomerTbl (CustomerUsername,CustomerPassword,EmailAddress,FirstName,MiddleName,LastName,BirthDate,ContactNum,AccountStatus) VALUES(:username,:password,:email,:firstName,:middleName,:lastName,:birthdate,:contactNum,:accountStatus)");

            $query->bindParam(':username', $username);
            $query->bindParam(':password', $this->hashPassword($password));
            $query->bindParam(':email', $emailAddress);
            $query->bindParam(':firstName', $firstName);
            $query->bindParam(':middleName', $middleName);
            $query->bindParam(':lastName', $lastName);
            $query->bindParam(':birthdate', $birthdate);
            $query->bindParam(':contactNum', $contactNumber);
            $query->bindParam(':accountStatus', $accountStatus);
            $query->execute();
            return true;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function emailAlreadyExists($emailAddress){
        $query = $this->dbconn->prepare("SELECT EmailAddress FROM CustomerTbl WHERE EmailAddress=:email");
        $query->bindParam(':email', $emailAddress);
        $query->execute();
        if($query->rowCount() > 0){
            return true;
        }
        return false;
    }

    public function usernameAlreadyExists($username){
        $query = $this->dbconn->prepare("SELECT CustomerUsername FROM CustomerTbl WHERE CustomerUsername=:username");
        $query->bindParam(':username', $username);
        $query->execute();

        if($query->rowCount() > 0){
            return true;
        }
        return false;
    }

    public function accountCheck($username, $password){
        try{
            $query = $this->dbconn->prepare("SELECT AccountStatus FROM CustomerTbl WHERE CustomerUsername=:username");
            $query->bindParam(':username', $username);
            $query->execute();
            if($query->rowCount() > 0){ 
                $statusAcc = $query->fetchColumn(); 
                if($statusAcc == 1){
                    $query = $this->dbconn->prepare("SELECT CustomerPassword FROM CustomerTbl WHERE CustomerUsername=:username");
                    $query->bindParam(':username', $username);
                    $query->execute();
                    if($query->rowCount() > 0){ 
                        $pw = $query->fetchColumn(); 
                        if(password_verify($password, $pw)){ 
                            return true;
                        }
                    }
                }
                else{
                    $this->accountDeactivated = true;
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