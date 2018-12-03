create table Users(
    u_code int(4) NOT NULL AUTO_INCREMENT,
    name varchar(18) NOT NULL, 
    last_name varchar(20) NOT NULL,
    phone varchar(10) NOT NULL,
    age int(3) NOT NULL,
    PRIMARY KEY(code)
);
create table Book(
   b_code varchar(8) NOT NULL,
   title varchar(75) NOT NULL,
   num_pages varchar(5) NOT NULL,
   editorial varchar(20) NOT NULL,
   author varchar(30) NOT NULL
)
create table orders(
   order_num int(6) NOT NULL,
   user_code int(4) NOT NULL,
   book_code varchar(8) NOT NULL,
   loan_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
   delivery_date  DATE NOT NULL,
   FOREIGN KEY (user_code) REFERENCES Users(u_code),
   FOREIGN KEY (book_code) REFERENCES Book(b_code)
)
