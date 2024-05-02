<?php 
class FavoriteClass{
    private $dbconn;

    function __construct($conn){
        $this->dbconn = $conn;
    }

    public function GetFavoriteID($productID, $customerID){
        try{
            $query = $this->dbconn->prepare("SELECT FavoriteID FROM FavoriteTbl WHERE ProductID=:productID AND CustomerID=:customerID");
            $query->bindparam(":productID", $productID);
            $query->bindparam(":customerID", $customerID);
            $query->execute();
            if($query->rowCount() > 0){
                $orderid = $query->fetch(PDO::FETCH_COLUMN, 0);
            }
            return $orderid;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function GetFavoriteRowData($favoriteID){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM FavoriteTbl WHERE FavoriteID=:favoriteID");
            $query->bindparam(":favoriteID", $favoriteID);
            $query->execute();

            $rowData = $query->fetch(PDO::FETCH_ASSOC);
            return $rowData;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function DeleteFavoriteRowData($favoriteID){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM FavoriteTbl WHERE FavoriteID=:favoriteID");
            $query->bindparam(":favoriteID", $favoriteID);
            $query->execute();
            if($query->rowCount() > 0){
                $query = $this->dbconn->prepare("DELETE FROM FavoriteTbl WHERE FavoriteID=:favoriteID");
                $query->bindparam(":favoriteID", $favoriteID);
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

    public function GetAllFavoriteData(){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM FavoriteTbl");
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

    public function GetAllFavoriteFullData(){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM FavoriteTbl LEFT JOIN ProductTbl ON FavoriteTbl.ProductID = ProductTbl.ProductID LEFT JOIN CustomerTbl ON FavoriteTbl.CustomerID = CustomerTbl.CustomerID");
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

    public function editFavoriteRowData($favoriteID, $productID, $customerID){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM FavoriteTbl WHERE FavoriteID=:favoriteID");
            $query->bindparam(":favoriteID", $favoriteID);
            $query->execute();
            if($query->rowCount() > 0){
                $query = $this->dbconn->prepare("UPDATE FavoriteTbl SET ProductID=:productID, CustomerID=:customerID WHERE FavoriteID=:favoriteID");
                $query->bindparam(":productID", $productID);
                $query->bindparam(":customerID", $customerID);
                $query->bindparam(":favoriteID", $favoriteID);
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

    public function addFavorite($productID, $customerID){
        try{

            $query = $this->dbconn->prepare("INSERT INTO FavoriteTbl (ProductID, CustomerID) VALUES(:productID, :customerID)");
            $query->bindparam(":productID", $productID);
            $query->bindparam(":customerID", $customerID);
            $query->execute();
            return true;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

}
?>