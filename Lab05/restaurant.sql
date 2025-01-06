CREATE TABLE IF NOT EXISTS customers (
    id int AUTO_INCREMENT,
    name text,
    city text,
    PRIMARY KEY (id)
);

INSERT INTO customers VALUES
  (1,"Amanda","BKK"),
  (2,"Alice","New York"),
  (3,"Kara", "New York"),
  (4,"Kate", "London"),
  (5,"John","London"),
  (6,"Louise","London");

-- create & insert menus
CREATE TABLE IF NOT EXISTS menus (
    menu_id int AUTO_INCREMENT,
    menu_name text,
    price text,
    PRIMARY KEY (menu_id)
);

INSERT INTO menus VALUES
  (1,"Cake", 10.50 ),
  (2,"Waffle", 6.15 ),
  (3,"bread", 5.00),
  (4,"Pie", 9.55 ),
  (5,"Donut", 3.20);


-- create & insert receipt
CREATE TABLE IF NOT EXISTS receipt (
    receipt_id int AUTO_INCREMENT,
    customer_id int,
    menu_id int,
    PRIMARY KEY (receipt_id)
);

INSERT INTO receipt VALUES
  (1,6,2),(2,5,3),(3,2,4),
  (4,5,3),(5,6,4),(6,6,3),
  (7,2,1), (8,1,2), (9,1,3),
  (10,6,3), (11,5,4), (12,4,3),
  (13,1,4),(14,5,1),(15,3,1);