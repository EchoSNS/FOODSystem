<?php 
class CategoryClass{
    private $dbconn;
    public $categoryNameExists;

    function __construct($conn){
        $this->dbconn = $conn;
    }

    public function getCategoryID($categoryName){
        try{
            $query = $this->dbconn->prepare("SELECT CategoryID FROM CategoryTbl WHERE CategoryName=:categoryName");
            $query->bindparam(":categoryName", $categoryName);
            $query->execute();
            if($query->rowCount() > 0){
                $categoryid = $query->fetch(PDO::FETCH_COLUMN, 0);
            }
            return $categoryid;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getCategoryRowData($categoryID){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM CategoryTbl WHERE CategoryID=:CategoryID");
            $query->bindparam(":CategoryID", $categoryID);
            $query->execute();

            $rowData = $query->fetch(PDO::FETCH_ASSOC);
            return $rowData;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function deleteCategoryRowData($categoryID){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM CategoryTbl WHERE CategoryID=:CategoryID");
            $query->bindparam(":CategoryID", $categoryID);
            $query->execute();
            if($query->rowCount() > 0){
                $query = $this->dbconn->prepare("DELETE FROM ProductTbl WHERE CategoryID=:CategoryID");
                $query->bindparam(":CategoryID", $categoryID);
                $query->execute();

                $query = $this->dbconn->prepare("DELETE FROM CategoryTbl WHERE CategoryID=:CategoryID");
                $query->bindparam(":CategoryID", $categoryID);
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

    public function getAllCategoryData(){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM CategoryTbl");
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

    public function getAllCategoryDataList(){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM CategoryTbl");
            $query->execute();
            if($query->rowCount() > 0){
                while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                        echo "<a onclick='option".$row['CategoryID']."()' class='btn1'>" .$row['CategoryName']. "</a>";
                }
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function editCategoryRowData($categoryID, $categoryName){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM CategoryTbl WHERE CategoryID=:categoryID");
            $query->bindparam(":categoryID", $categoryID);
            $query->execute();
            if($query->rowCount() > 0){
                $query = $this->dbconn->prepare("UPDATE CategoryTbl SET CategoryName=:categoryName WHERE CategoryID=:categoryID");
                $query->bindparam(":categoryName", $categoryName);
                $query->bindparam(":categoryID", $categoryID);
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

    public function categoryNameAlreadyExists($categoryName){
        $query = $this->dbconn->prepare("SELECT CategoryName FROM CategoryTbl WHERE CategoryName=:categoryName");
        $query->bindParam(':categoryName', $categoryName);
        $query->execute();

        if($query->rowCount() > 0){
            return true;
        }
        return false;
    }

    public function addCategoryRowData($categoryName){
        try{
            if($this->categoryNameAlreadyExists($categoryName)){
                $this->categoryNameAlreadyExists = true;
                return false;
            }

            $query = $this->dbconn->prepare("INSERT INTO CategoryTbl (CategoryName) VALUES(:categoryName)");

            $query->bindParam(':categoryName', $categoryName);
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