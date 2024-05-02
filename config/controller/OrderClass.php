<?php 
class OrderClass{
    private $dbconn;

    function __construct($conn){
        $this->dbconn = $conn;
    }
    
    public function getLastOrderData($customerID){
        try{
            $orderStatus = 0;
            $query = $this->dbconn->prepare("SELECT * FROM OrderTbl WHERE CustomerID=:customerID AND OrderStatus =:orderStatus ORDER BY Order_DateTime DESC LIMIT 1");
            $query->bindparam(":customerID", $customerID);
            $query->bindparam(":orderStatus", $orderStatus);
            $query->execute();
            if($query->rowCount() > 0){
                $orderData = $query->fetch(PDO::FETCH_ASSOC);
            }
            return $orderData;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function GetOrderID($customerID){
        try{
            $query = $this->dbconn->prepare("SELECT OrderID FROM OrderTbl WHERE CustomerID=:customerID");
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

    public function GetOrderRowData($orderID){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM OrderTbl WHERE OrderID=:OrderID");
            $query->bindparam(":OrderID", $orderID);
            $query->execute();

            $rowData = $query->fetch(PDO::FETCH_ASSOC);
            return $rowData;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getCustomerOrderFullRowData($customerID){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM OrderDetailsTbl LEFT JOIN OrderTbl ON OrderDetailsTbl.OrderID = OrderTbl.OrderID LEFT JOIN ProductTbl ON OrderDetailsTbl.ProductID = ProductTbl.ProductID WHERE OrderTbl.CustomerID=:customerID ORDER BY OrderTbl.Order_DateTime DESC");
            $query->bindparam(":customerID", $customerID);
            $query->execute();

            $rowData = $query->fetchAll(PDO::FETCH_ASSOC);
            return $rowData;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function DeleteOrderRowData($orderID){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM OrderTbl WHERE OrderID=:orderID");
            $query->bindparam(":orderID", $orderID);
            $query->execute();
            if($query->rowCount() > 0){
                $query = $this->dbconn->prepare("DELETE FROM OrderDetailsTbl WHERE OrderID=:orderID");
                $query->bindparam(":orderID", $orderID);
                $query->execute();

                $query = $this->dbconn->prepare("DELETE FROM OrderTbl WHERE OrderID=:orderID");
                $query->bindparam(":orderID", $orderID);
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

    public function GetAllOrderData(){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM OrderTbl ORDER BY Order_DateTime DESC");
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

    public function GetAllOrderFullData(){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM OrderTbl LEFT JOIN CustomerTbl ON OrderTbl.CustomerID = CustomerTbl.CustomerID ORDER BY OrderTbl.Order_DateTime DESC");
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

    public function editOrderRowData($orderID, $customerID, $orderDateTime, $orderStatus){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM OrderTbl WHERE OrderID=:orderID");
            $query->bindparam(":orderID", $orderID);
            $query->execute();
            if($query->rowCount() > 0){
                $query = $this->dbconn->prepare("UPDATE OrderTbl SET CustomerID=:customerID, Order_DateTime=:orderDateTime, OrderStatus=:orderStatus WHERE OrderID=:orderID");
                $query->bindparam(":customerID", $customerID);
                $query->bindparam(":orderDateTime", $orderDateTime);
                $query->bindparam(":orderID", $orderID);
                $query->bindparam(":orderStatus", $orderStatus);
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

    public function addOrder($customerID, $orderDateTime, $orderStatus){
        try{

            $query = $this->dbconn->prepare("INSERT INTO OrderTbl (CustomerID, Order_DateTime, OrderStatus) VALUES(:customerID, :orderDateTime, :orderStatus)");

            $query->bindParam(':customerID', $customerID);
            $query->bindParam(':orderDateTime', $orderDateTime);
            $query->bindParam(':orderStatus', $orderStatus);
            $query->execute();
            return true;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function listProductInCart($customerID){
        try{
            $orderStatus= 1;
            $query = $this->dbconn->prepare("SELECT * FROM OrderDetailsTbl LEFT JOIN OrderTbl ON OrderDetailsTbl.OrderID = OrderTbl.OrderID LEFT JOIN CustomerTbl ON OrderTbl.CustomerID = CustomerTbl.CustomerID LEFT JOIN ProductTbl ON OrderDetailsTbl.ProductID = ProductTbl.ProductID WHERE OrderTbl.CustomerID=:customerID AND OrderTbl.OrderStatus = :orderStatus");
            $query->bindparam(":customerID", $customerID);
            $query->bindparam(":orderStatus", $orderStatus);
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

}
?>