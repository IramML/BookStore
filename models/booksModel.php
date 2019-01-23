<?php
require 'models/book.php';
class booksModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function getAll(){
        $items=[];
        try{
            $query=$this->db->connect()->query('SELECT * FROM book');
            while($row=$query->fetch()){
                $book=new Book();
                $book->code=$row['b_code'];
                $book->title=$row['title'];
                $book->numPages=$row['num_pages'];
                $book->editorial=$row['editorial'];
                $book->author=$row['author'];
                $book->cost=$row['cost'];
                $book->bImage=$row['b_image'];
                array_push($items, $book);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    function getAllPhysics(){
        $items=[];
        try{
            $query=$this->db->connect()->query('SELECT * FROM physicalbook');
            while($row=$query->fetch()){
                $book=new Book();
                $book->code=$row['b_physical_code'];

                array_push($items, $book);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    function getBooksByPhysicals($physicalBooks){
        $books=[];
        try{
            foreach ($physicalBooks as $rowPhysical){
                $query=$this->db->connect()->prepare('SELECT * FROM book WHERE b_code=:code');
                $query->execute(['code'=>$rowPhysical->code]);
                while($row=$query->fetch()){
                    $book=new Book();
                    $book->code=$row['b_code'];
                    $book->title=$row['title'];
                    $book->numPages=$row['num_pages'];
                    $book->editorial=$row['editorial'];
                    $book->author=$row['author'];
                    $book->cost=$row['cost'];
                    $book->bImage=$row['b_image'];

                    array_push($books, $book);
                }
            }
            return $books;
        }catch (PDOException $e){
            return [];
        }
    }
    function registerPhysicalAndPDF($data){
        try{
            $query=$this->db->connect()->prepare('INSERT INTO book(b_code, title, num_pages, editorial, author, cost, b_image) 
                                              VALUES(:code, :title, :num_pages, :editorial, :author, :cost,
                                              :url)');
            $query->execute(['code'=>$data['code'], 'title'=>$data['title'], 'num_pages'=>$data['num_pages'], 'editorial'=>$data['editorial'],
                'author'=>$data['author'], 'cost'=>$data['cost'], 'url'=>$data['image']]);

            $query=$this->db->connect()->prepare('INSERT INTO physicalbook(b_physical_code)
                                              VALUES(:code)');
            $query->execute(['code'=>$data['code']]);

            $query=$this->db->connect()->prepare('INSERT INTO pdfbook(pdf_code, url)
                                              VALUES(:code, :url)');
            $query->execute(['code'=>$data['code'], 'url'=>$data['pdf']]);
            return true;
        }catch (PDOException $e){
            return false;
        }
    }
    function registerPhysical($data){
        try{
            $query=$this->db->connect()->prepare('INSERT INTO book(b_code, title, num_pages, editorial, author, cost, b_image) 
                                              VALUES(:code, :title, :num_pages, :editorial, :author, :cost,
                                              :url)');
            $query->execute(['code'=>$data['code'], 'title'=>$data['title'], 'num_pages'=>$data['num_pages'], 'editorial'=>$data['editorial'],
                'author'=>$data['author'], 'cost'=>$data['cost'], 'url'=>$data['image']]);

            $query=$this->db->connect()->prepare('INSERT INTO physicalbook(b_physical_code)
                                              VALUES(:code)');
            $query->execute(['code'=>$data['code']]);
            return true;
        }catch (PDOException $e){
            return false;
        }
    }
    function registerPDF($data){
        try{
            $query=$this->db->connect()->prepare('INSERT INTO book(b_code, title, num_pages, editorial, author, cost, b_image) 
                                              VALUES(:code, :title, :num_pages, :editorial, :author, :cost,
                                              :url)');
            $query->execute(['code'=>$data['code'], 'title'=>$data['title'], 'num_pages'=>$data['num_pages'], 'editorial'=>$data['editorial'],
                'author'=>$data['author'], 'cost'=>$data['cost'], 'url'=>$data['image']]);

            $query=$this->db->connect()->prepare('INSERT INTO pdfbook(pdf_code, url)
                                              VALUES(:code, :url)');
            $query->execute(['code'=>$data['code'], 'url'=>$data['pdf']]);
            return true;
        }catch (PDOException $e){
            return false;
        }
    }
    function getBookByCode($code){
        $items=[];
        try{
            $query=$this->db->connect()->prepare('SELECT * FROM book WHERE b_code=:code');
            $query->execute(['code'=>$code]);
            while($row=$query->fetch()){
                $book=new Book();
                $book->code=$row['b_code'];
                $book->title=$row['title'];
                $book->numPages=$row['num_pages'];
                $book->editorial=$row['editorial'];
                $book->author=$row['author'];
                $book->cost=$row['cost'];
                $book->bImage=$row['b_image'];
                array_push($items, $book);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    function existPDF($bookCode){
        try{
            $query=$this->db->connect()->prepare('SELECT * FROM pdfbook WHERE pdf_code=:code');
            $query->execute(['code'=>$bookCode]);
            if($query->rowCount()>0) return true;
            else return false;
        }catch (PDOException $e){
            return false;
        }
    }
    function existPhysical($bookCode){
        try{
            $query=$this->db->connect()->prepare('SELECT * FROM physicalbook WHERE b_physical_code=:code');
            $query->execute(['code'=>$bookCode]);
            if($query->rowCount()>0) return true;
            else return false;
        }catch (PDOException $e){
            return false;
        }
    }
}