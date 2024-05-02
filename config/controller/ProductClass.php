<?php 
class ProductClass{
    private $dbconn;
    function __construct($conn){
        $this->dbconn = $conn;
    }

    public function GetProductID($productName){
        try{
            $query = $this->dbconn->prepare("SELECT ProductID FROM ProductTbl WHERE ProductName=:productName");
            $query->bindparam(":productName", $productName);
            $query->execute();
            if($query->rowCount() > 0){
                $product_id = $query->fetch(PDO::FETCH_COLUMN, 0);
            }
            return $product_id;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function GetProductRowData($productID){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM ProductTbl WHERE ProductID=:ProductID");
            $query->bindparam(":ProductID", $productID);
            $query->execute();

            $rowData = $query->fetch(PDO::FETCH_ASSOC);
            return $rowData;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function GetProductFullRowData($productID){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM ProductTbl LEFT JOIN CategoryTbl ON ProductTbl.CategoryID = CategoryTbl.CategoryID WHERE ProductID=:ProductID");
            $query->bindparam(":ProductID", $productID);
            $query->execute();

            $rowData = $query->fetch(PDO::FETCH_ASSOC);
            return $rowData;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function DeleteProductRowData($productID){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM ProductTbl WHERE ProductID=:ProductID");
            $query->bindparam(":ProductID", $productID);
            $query->execute();
            if($query->rowCount() > 0){
                $query = $this->dbconn->prepare("DELETE FROM FavoriteTbl WHERE ProductID=:ProductID");
                $query->bindparam(":ProductID", $productID);
                $query->execute();

                $query = $this->dbconn->prepare("DELETE FROM OrderDetailsTbl WHERE ProductID=:ProductID");
                $query->bindparam(":ProductID", $productID);
                $query->execute();

                $query = $this->dbconn->prepare("DELETE FROM ProductTbl WHERE ProductID=:ProductID");
                $query->bindparam(":ProductID", $productID);
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

    public function GetAllProductData(){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM ProductTbl");
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

    public function GetAllProductFullData(){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM ProductTbl LEFT JOIN CategoryTbl ON ProductTbl.CategoryID = CategoryTbl.CategoryID");
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

    public function editProductRowData($productID, $categoryID, $productName, $productDescription, $productPrice, $productStock, $productImage){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM ProductTbl WHERE ProductID=:productID");
            $query->bindparam(":productID", $productID);
            $query->execute();
            if($query->rowCount() > 0){
                $query = $this->dbconn->prepare("UPDATE ProductTbl SET CategoryID=:categoryID, ProductName=:productName, ProductDescription=:productDescription, ProductPrice=:productPrice, ProductStock=:productStock, ProductImage=:productImage WHERE ProductID=:productID");
                $query->bindparam(":categoryID", $categoryID);
                $query->bindparam(":productName", $productName);
                $query->bindparam(":productDescription", $productDescription);
                $query->bindparam(":productPrice", $productPrice);
                $query->bindparam(":productStock", $productStock);
                $query->bindparam(":productImage", $productImage);
                $query->bindparam(":productID", $productID);
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

    public function addProduct($categoryID, $productName, $productDescription, $productPrice, $productStock, $productImage){
        try{
            if($this->productNameAlreadyExists($productName)){
                $this->productNameAlreadyExists = true;
                return false;
            }

            $query = $this->dbconn->prepare("INSERT INTO ProductTbl (CategoryID, ProductName, ProductDescription, ProductPrice, ProductStock, ProductImage) VALUES(:categoryID, :productName, :productDescription, :productPrice, :productStock, :productImage)");

            $query->bindParam(':categoryID', $categoryID);
            $query->bindParam(':productName', $productName);
            $query->bindParam(':productDescription', $productDescription);
            $query->bindParam(':productPrice', $productPrice);
            $query->bindParam(':productStock', $productStock);
            $query->bindParam(':productImage', $productImage);
            $query->execute();
            return true;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function productNameAlreadyExists($productName){
        $query = $this->dbconn->prepare("SELECT ProductName FROM ProductTbl WHERE ProductName=:productName");
        $query->bindParam(':productName', $productName);
        $query->execute();

        if($query->rowCount() > 0){
            return true;
        }
        return false;
    }

    public function getNumberOfItemsInCart($customerID){
        $orderStatus = 1;
        $query = $this->dbconn->prepare("SELECT COUNT(OrderDetailsTbl.ProductID) FROM OrderTbl LEFT JOIN OrderDetailsTbl ON OrderTbl.OrderID = OrderDetailsTbl.OrderID WHERE OrderTbl.CustomerID = :customerID AND OrderTbl.OrderStatus = :orderStatus");
        $query->bindParam(':customerID', $customerID);
        $query->bindParam(':orderStatus', $orderStatus);
        $query->execute();
        $nRows = $query->fetchColumn();
        echo $nRows;
    }

    public function getSpecificProductCategory($categoryID){
        try{
            $query = $this->dbconn->prepare("SELECT * FROM ProductTbl LEFT JOIN CategoryTbl ON ProductTbl.CategoryID = CategoryTbl.CategoryID WHERE ProductTbl.CategoryID=:categoryID");
            $query->bindparam(":categoryID", $categoryID);
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

    public function addProductToCart($productID, $orderQuantity, $customerID){
        try{
            $orderStatus = 1;
            $query = $this->dbconn->prepare("SELECT * FROM OrderTbl LEFT JOIN OrderDetailsTbl ON OrderTbl.OrderID = OrderDetailsTbl.OrderID WHERE OrderTbl.CustomerID=:customerID AND OrderDetailsTbl.ProductID =:productID AND OrderTbl.OrderStatus =:orderStatus");
            $query->bindparam(":customerID", $customerID);
            $query->bindparam(":orderStatus", $orderStatus);
            $query->bindparam(":productID", $productID);
            $query->execute();
            if($query->rowCount() > 0){
                $rowData = $query->fetch(PDO::FETCH_ASSOC);
                $totalQuantity = ($orderQuantity + $rowData['OrderQuantity']);
                $query = $this->dbconn->prepare("UPDATE OrderDetailsTbl SET OrderQuantity=:orderQuantity WHERE ProductID=:productID AND OrderID=:orderID");
                $query->bindparam(":productID", $productID);
                $query->bindparam(":orderID", $rowData['OrderID']);
                $query->bindparam(":orderQuantity", $totalQuantity);
                $query->execute();
                return true;
            }
            else{
                $dateNow = date('Y-m-d H:i:s');
                $query = $this->dbconn->prepare("SELECT * FROM OrderTbl LEFT JOIN OrderDetailsTbl ON OrderTbl.OrderID = OrderDetailsTbl.OrderID WHERE OrderTbl.CustomerID=:customerID AND OrderTbl.OrderStatus =:orderStatus");
                $query->bindparam(":customerID", $customerID);
                $query->bindparam(":orderStatus", $orderStatus);
                $query->execute();
                if($query->rowCount() > 0){
                    $query = $this->dbconn->prepare("UPDATE OrderTbl SET Order_DateTime=:orderDateTime WHERE CustomerID=:customerID AND OrderStatus=:orderStatus");
                    $query->bindparam(":orderStatus", $orderStatus);
                    $query->bindparam(":orderDateTime", $dateNow);
                    $query->bindparam(":customerID", $customerID);
                    $query->execute();
                }
                else{
                    $query = $this->dbconn->prepare("INSERT INTO OrderTbl (CustomerID, Order_DateTime, OrderStatus) VALUES(:customerID, :order_DateTime, :orderStatus)");
                    $query->bindparam(":customerID", $customerID);
                    $query->bindparam(":order_DateTime", $dateNow);
                    $query->bindparam(":orderStatus", $orderStatus);
                    $query->execute();
                }
                $query = $this->dbconn->prepare("SELECT * FROM OrderTbl WHERE CustomerID=:customerID AND Order_DateTime=:order_DateTime AND OrderStatus =:orderStatus");
                $query->bindparam(":customerID", $customerID);
                $query->bindparam(":order_DateTime", $dateNow);
                $query->bindparam(":orderStatus", $orderStatus);
                $query->execute();
                if($query->rowCount() > 0){
                    $rowData = $query->fetch(PDO::FETCH_ASSOC);
                    $query = $this->dbconn->prepare("INSERT INTO OrderDetailsTbl (OrderID, ProductID, OrderQuantity) VALUES(:OrderID, :ProductID, :OrderQuantity)");
                    $query->bindparam(":OrderID", $rowData['OrderID']);
                    $query->bindparam(":ProductID", $productID);
                    $query->bindparam(":OrderQuantity", $orderQuantity);
                    $query->execute();
                    return true;
                }
            }
            return false;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function removeProductInCart($customerID, $productID){
        try{
            $orderStatus = 1;
            $query = $this->dbconn->prepare("SELECT * FROM OrderDetailsTbl LEFT JOIN OrderTbl ON OrderDetailsTbl.OrderID = OrderTbl.OrderID WHERE OrderTbl.CustomerID=:customerID AND OrderTbl.OrderStatus =:orderStatus");
            $query->bindparam(":customerID", $customerID);
            $query->bindparam(":orderStatus", $orderStatus);
            $query->execute();
            if($query->rowCount() > 0){
                $rowData = $query->fetch(PDO::FETCH_ASSOC);
                $query = $this->dbconn->prepare("DELETE FROM OrderDetailsTbl WHERE OrderID=:orderID AND ProductID =:productID");
                $query->bindparam(":orderID", $rowData['OrderID']);
                $query->bindparam(":productID", $productID);
                $query->execute();
                return true;
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }

    }

    public function checkOut($customerID, $productID, $orderQuantity, $counter, $stop){
        try{
            $orderStatus = 1;
            $query = $this->dbconn->prepare("SELECT * FROM OrderDetailsTbl LEFT JOIN OrderTbl ON OrderTbl.OrderID = OrderDetailsTbl.OrderID LEFT JOIN ProductTbl ON OrderDetailsTbl.ProductID = ProductTbl.ProductID WHERE OrderDetailsTbl.ProductID =:productID AND OrderTbl.OrderStatus=:orderStatus");
            $query->bindparam(":productID", $productID);
            $query->bindparam(":orderStatus", $orderStatus);
            $query->execute();

            if($query->rowCount() > 0){
                $rowData = $query->fetch(PDO::FETCH_ASSOC);
                if($orderQuantity <= $rowData['ProductStock']){
                    $totalQuantity = ($rowData['ProductStock'] - $orderQuantity);
                    
                    $query = $this->dbconn->prepare("UPDATE OrderDetailsTbl LEFT JOIN OrderTbl ON OrderDetailsTbl.OrderID = OrderTbl.OrderID SET OrderDetailsTbl.OrderQuantity=:orderQuantity WHERE OrderDetailsTbl.ProductID=:productID AND OrderTbl.CustomerID=:customerID AND OrderTbl.OrderStatus =:orderStatus");
                    $query->bindparam(":productID", $productID);
                    $query->bindparam(":customerID", $customerID);
                    $query->bindparam(":orderQuantity", $orderQuantity);
                    $query->bindparam(":orderStatus", $orderStatus);
                    $query->execute();

                    $query = $this->dbconn->prepare("UPDATE ProductTbl SET ProductStock=:productStock WHERE ProductID=:productID");
                    $query->bindparam(":productID", $productID);
                    $query->bindparam(":productStock", $totalQuantity);
                    $query->execute();
                    if($counter == $stop){
                        $query = $this->dbconn->prepare("SELECT * FROM OrderTbl WHERE CustomerID =:customerID AND OrderStatus =:orderStatus");
                        $query->bindparam(":customerID", $customerID);
                        $query->bindparam(":orderStatus", $orderStatus);
                        $query->execute();
                        if($query->rowCount() > 0){
                            $rowData = $query->fetch(PDO::FETCH_ASSOC);
                            $orderStatus = 0;
                            $dateNow = date('Y-m-d H:i:s');
                            $query = $this->dbconn->prepare("UPDATE OrderTbl SET OrderStatus=:orderStatus, Order_DateTime=:orderDateTime WHERE OrderID=:orderID");
                            $query->bindparam(":orderDateTime", $dateNow);
                            $query->bindparam(":orderStatus", $orderStatus);
                            $query->bindparam(":orderID", $rowData['OrderID']);
                            $query->execute();
                            return (int)99;
                        }
                    }
                    return (int)2;
                }
                else{
                    return (int)98;
                }
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

}
?>