<?php 
class OrderDetailsClass{
    private $dbconn;

    function __construct($conn){
        $this->dbconn = $conn;
    }

    public function GetOrderDetailsID($orderID, $productID){
        try{
            $query = $this->dbconn->prepare("SELECT OrderDetailsID FROM OrderDetailsTbl WHERE OrderID=:orderID AND ProductID=:productID");
            $query->bindparam(":orderID", $orderID);
            $query->bindparam(":productID", $productID);
            $query->execute();
            if($query->rowCount() > 0){
                $orderDetailsid = $query->fetch(PDO::FETCH_COLUMN, 0);
            }
            return $orderDetailsid;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    
    public function getOrderDetailsByOrderIDAllData($orderID){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM OrderDetailsTbl LEFT JOIN OrderTbl ON OrderDetailsTbl.OrderID = OrderTbl.OrderID LEFT JOIN ProductTbl ON OrderDetailsTbl.ProductID = ProductTbl.ProductID WHERE OrderDetailsTbl.OrderID=:orderID");
            $query->bindparam(":orderID", $orderID);
            $query->execute();
            if($query->rowCount() > 0){
                $orderDetailsArr = $query->fetchAll(PDO::FETCH_ASSOC);
            }
            return $orderDetailsArr;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function GetOrderDetailsRowData($orderDetailsID){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM OrderDetailsTbl WHERE OrderDetailsID=:OrderDetailsID");
            $query->bindparam(":OrderDetailsID", $orderDetailsID);
            $query->execute();

            $rowData = $query->fetch(PDO::FETCH_ASSOC);
            return $rowData;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function DeleteOrderDetailsRowData($orderDetailsID){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM OrderDetailsTbl WHERE OrderDetailsID=:orderDetailsID");
            $query->bindparam(":orderDetailsID", $orderDetailsID);
            $query->execute();
            if($query->rowCount() > 0){
                $query = $this->dbconn->prepare("DELETE FROM OrderDetailsTbl WHERE OrderDetailsID=:orderDetailsID");
                $query->bindparam(":orderDetailsID", $orderDetailsID);
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

    public function GetAllOrderDetailsData(){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM OrderDetailsTbl");
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

    public function GetAllOrderDetailsFullData(){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM OrderDetailsTbl LEFT JOIN OrderTbl ON OrderDetailsTbl.OrderID = OrderTbl.OrderID LEFT JOIN CustomerTbl ON OrderTbl.CustomerID = CustomerTbl.CustomerID LEFT JOIN ProductTbl ON OrderDetailsTbl.ProductID = ProductTbl.ProductID ORDER BY OrderTbl.Order_DateTime DESC");
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

    public function editOrderDetailsRowData($orderDetailsID, $orderID, $productID, $orderQuantity){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM OrderDetailsTbl WHERE OrderDetailsID=:orderDetailsID");
            $query->bindparam(":orderDetailsID", $orderDetailsID);
            $query->execute();
            if($query->rowCount() > 0){
                $query = $this->dbconn->prepare("UPDATE OrderDetailsTbl SET OrderID=:orderID, ProductID=:productID, OrderQuantity=:orderQuantity WHERE OrderDetailsID=:orderDetailsID");
                $query->bindparam(":orderID", $orderID);
                $query->bindparam(":productID", $productID);
                $query->bindparam(":orderQuantity", $orderQuantity);
                $query->bindparam(":orderDetailsID", $orderDetailsID);
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

    public function addOrderDetails($orderID, $productID, $orderQuantity){
        try{

            $query = $this->dbconn->prepare("INSERT INTO OrderDetailsTbl (OrderID, ProductID, OrderQuantity) VALUES(:orderID, :productID, :orderQuantity)");
            $query->bindparam(":orderID", $orderID);
            $query->bindparam(":productID", $productID);
            $query->bindparam(":orderQuantity", $orderQuantity);
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