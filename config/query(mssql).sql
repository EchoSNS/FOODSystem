CREATE DATABASE FOODSSystemDB;

USE FOODSSystemDB;

CREATE TABLE CustomerTbl(
	CustomerID INT NOT NULL IDENTITY(1,1) PRIMARY KEY,
	CustomerUsername VARCHAR(30) NOT NULL,
	CustomerPassword VARCHAR(255) NOT NULL,
	EmailAddress VARCHAR(320) NOT NULL,
	FirstName VARCHAR(100),
	MiddleName VARCHAR(100),
	LastName VARCHAR(100),
	Birthdate DATE,
	ContactNum VARCHAR(50),
	AccountStatus INT(1)
);

CREATE TABLE CategoryTbl(
	CategoryID INT NOT NULL IDENTITY(1,1) PRIMARY KEY,
	CategoryName VARCHAR(50) NOT NULL
);


CREATE TABLE ProductTbl(
	ProductID INT NOT NULL IDENTITY(1,1) PRIMARY KEY,
	CategoryID INT NOT NULL FOREIGN KEY REFERENCES CategoryTbl(CategoryID),
	ProductName VARCHAR(50) NOT NULL,
	ProductDescription VARCHAR(255),
	ProductPrice DECIMAL(15,2) NOT NULL,
	ProductStock INT NOT NULL,
	ProductImage VARCHAR(500)
);

CREATE TABLE FavoriteTbl(
	FavoriteID INT NOT NULL IDENTITY(1,1) PRIMARY KEY,
	ProductID INT NOT NULL FOREIGN KEY REFERENCES ProductTbL(ProductID),
	CustomerID INT NOT NULL FOREIGN KEY REFERENCES CustomerTbl (CustomerID)
	
);

CREATE TABLE OrderTbl(
	OrderID INT NOT NULL IDENTITY(1,1) PRIMARY KEY,
	CustomerID INT NOT NULL FOREIGN KEY REFERENCES CustomerTbl(CustomerID),
	Order_DateTime DATETIME NOT NULL,
	OrderStatus INT NOT NULL
	
);

CREATE TABLE OrderDetailsTbl(
	OrderDetailsID INT NOT NULL IDENTITY(1,1) PRIMARY KEY,
	OrderID INT NOT NULL FOREIGN KEY REFERENCES OrderTbl(OrderID),
	ProductID INT NOT NULL FOREIGN KEY REFERENCES ProductTbl(ProductID),
	OrderQuantity INT NOT NULL
);

CREATE TABLE Admintbl(
	UserID INT NOT NULL IDENTITY(1,1) PRIMARY KEY,
	AdminUsername VARCHAR(255) NOT NULL,
	AdminPassword VARCHAR(255) NOT NULL
);

