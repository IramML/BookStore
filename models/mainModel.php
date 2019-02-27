<?php
class mainModel extends Model{
    function __construct(){
        parent::__construct();
        $this->createTables();
    }
    function createTables(){
        $this->db->connect()->query('CREATE TABLE IF NOT EXISTS client(
            c_code int(4) NOT NULL,
            c_name varchar(18) NOT NULL, 
            last_name varchar(20) NOT NULL,
            phone varchar(10) NOT NULL,
            age int(3) NOT NULL,
            PRIMARY KEY(c_code)
        )');
        $this->db->connect()->query('CREATE TABLE IF NOT EXISTS clientPhysical(
            cp_code int(4) NOT NULL,
            FOREIGN KEY (cp_code) REFERENCES client(c_code)
        )');
        $this->db->connect()->query('CREATE TABLE IF NOT EXISTS clientApplication(
            ca_code int(4) NOT NULL,
            email varchar(30) UNIQUE NOT NULL,
            password varchar(200) NOT NULL,
            c_image varchar(200) NULL,
            FOREIGN KEY (ca_code) REFERENCES client(c_code)
        )');
        $this->db->connect()->query('create table IF NOT EXISTS Book(
           b_code varchar(8) NOT NULL,
           title varchar(75) NOT NULL,
           num_pages varchar(5) NOT NULL,
           editorial varchar(20) NOT NULL,
           author varchar(30) NOT NULL,
           cost double NOT NULL,
           b_image varchar(200) NOT NULL,
           PRIMARY KEY(b_code)
        )');
        $this->db->connect()->query('create table IF NOT EXISTS PDFBook(
            pdf_code varchar(8) NOT NULL,
            url varchar(200) NOT NULL,
            FOREIGN KEY (pdf_code) REFERENCES Book(b_code)
        )');
        $this->db->connect()->query('create table IF NOT EXISTS PhysicalBook(
            b_physical_code varchar(8) NOT NULL,
            FOREIGN KEY (b_physical_code) REFERENCES Book(b_code)
        )');
        $this->db->connect()->query('create table IF NOT EXISTS orders(
           order_num int(6) NOT NULL AUTO_INCREMENT,
           client_code int(4) NOT NULL,
           book_code varchar(8) NOT NULL,
           buy_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
           PRIMARY KEY(order_num),
           FOREIGN KEY (client_code) REFERENCES client(c_code),
           FOREIGN KEY (book_code) REFERENCES Book(b_code)
        )');
        $this->db->connect()->query('create table IF NOT EXISTS token(
           id_client int(4) NOT NULL UNIQUE,
           token varchar(40) NOT NULL UNIQUE,
           PRIMARY KEY(token),
           FOREIGN KEY (id_client) REFERENCES clientApplication(ca_code)
        )');
        $this->db->connect()->query('create table IF NOT EXISTS domicile(
           domicile_code int(6) NOT NULL AUTO_INCREMENT,
           client_domicile int(4) NOT NULL,
           postal_code int(5) NOT NULL,
           colony varchar(40) NOT NULL,
           state varchar(30) NOT NULL,
           municipality varchar(30) NOT NULL,
           street varchar(50) NOT NULL,
           outdoor_number varchar(20) NOT NULL,
           PRIMARY KEY (domicile_code),
           FOREIGN KEY (client_domicile) REFERENCES clientApplication(ca_code)
        )');
        $this->db->connect()->query('create table IF NOT EXISTS homeDelivery(
           num_order int(6) NOT NULL,
           dom_code int(6) NOT NULL,
           delivered boolean NOT NULL,
           FOREIGN KEY (dom_code) REFERENCES domicile(domicile_code),
           FOREIGN KEY (num_order) REFERENCES orders(order_num)
        )');
    }
    function getNumClients(){
        try{
            $query=$this->db->connect()->query('SELECT * FROM clientphysical');
            return $query->rowCount();
        }catch (PDOException $e){
            return 0;
        }
    }
    function getNumBooks(){
        try{
            $query=$this->db->connect()->query('SELECT * FROM physicalbook');
            return $query->rowCount();
        }catch (PDOException $e){
            return 0;
        }
    }
    function getNumOrders(){
        try{
            $query=$this->db->connect()->query('SELECT * FROM orders');
            return $query->rowCount();
        }catch (PDOException $e){
            return 0;
        }
    }
    function getNumDeliveries(){
        try{
            $query=$this->db->connect()->query('SELECT * FROM homedelivery');
            return $query->rowCount();
        }catch (PDOException $e){
            return 0;
        }
    }
}