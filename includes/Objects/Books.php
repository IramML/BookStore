<?php
    include_once '/xampp/htdocs/bookstore/includes/db.php';
    class Books extends DB{
        function getBooks(){
            $query = $this->connect()->query('SELECT * FROM book');
            return $query;
        }
        function getBook($id){
            $query = $this->connect()->prepare('SELECT * FROM book where b_code=:code');
            $query->execute(['code'=>$id]);
            return $query;
        }
        function registerPhysicalAndPDF($code, $title, $numPages, $editorial, $author, $cost, $fileImage, $filePDF){
            $query=$this->connect()->prepare('INSERT INTO book(b_code, title, num_pages, editorial, author, cost, b_image) 
                                              VALUES(:code, :title, :num_pages, :editorial, :author, :cost,
                                              :url)');
            $query->execute(['code'=>$code, 'title'=>$title, 'num_pages'=>$numPages, 'editorial'=>$editorial,
                            'author'=>$author, 'cost'=>$cost, 'url'=>$fileImage]);

            $query=$this->connect()->prepare('INSERT INTO physicalbook(b_physical_code)
                                              VALUES(:code)');
            $query->execute(['code'=>$code]);

            $query=$this->connect()->prepare('INSERT INTO pdfbook(pdf_code, url)
                                              VALUES(:code, :url)');
            $query->execute(['code'=>$code, 'url'=>$filePDF]);
        }
        function registerPDF($code, $title, $numPages, $editorial, $author, $cost, $fileImage, $filePDF){
            $query=$this->connect()->prepare('INSERT INTO book(b_code, title, num_pages, editorial, author, cost, b_image) 
                                              VALUES(:code, :title, :num_pages, :editorial, :author, :cost,
                                              :url)');
            $query->execute(['code'=>$code, 'title'=>$title, 'num_pages'=>$numPages, 'editorial'=>$editorial,
                'author'=>$author, 'cost'=>$cost, 'url'=>$fileImage]);

            $query=$this->connect()->prepare('INSERT INTO pdfbook(pdf_code, url)
                                              VALUES(:code, :url)');
            $query->execute(['code'=>$code, 'url'=>$filePDF]);
        }
        function registerPhysical($code, $title, $numPages, $editorial, $author, $cost, $fileImage){
            $query=$this->connect()->prepare('INSERT INTO book(b_code, title, num_pages, editorial, author, cost, b_image) 
                                              VALUES(:code, :title, :num_pages, :editorial, :author, :cost,
                                              :url)');
            $query->execute(['code'=>$code, 'title'=>$title, 'num_pages'=>$numPages, 'editorial'=>$editorial,
                'author'=>$author, 'cost'=>$cost, 'url'=>$fileImage]);

            $query=$this->connect()->prepare('INSERT INTO physicalbook(b_physical_code)
                                              VALUES(:code)');
            $query->execute(['code'=>$code]);
        }
        function existPhysical($id){
            $query=$this->connect()->prepare('SELECT * FROM physicalbook WHERE b_physical_code=:id');
            $query->execute(['id'=>$id]);
            return $query->rowCount()>0;
        }
        function existPDF($id){
            $query=$this->connect()->prepare('SELECT * FROM pdfbook WHERE pdf_code=:id');
            $query->execute(['id'=>$id]);
            return $query->rowCount()>0;
        }
    }
?>