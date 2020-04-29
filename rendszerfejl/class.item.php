<?php
include "db_config.php";

class Item{

    public $db;

    private $id;
    private $nev; 
    private $mennyiseg;  
    private $ar;  
    private $idopont; 
    private $licitkulonbseg;  
    private $aktualisLicit;
    private $leiras;
    private $uid;

    public function __construct($id)
    {
        $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
       
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM items where id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $this->id = $row["id"];
                $this->nev = $row["nev"];
                $this->mennyiseg = $row["mennyiseg"];
                $this->ar = $row["ar"];
                $this->idopont = $row["idopont"];
                $this->licitkulonbseg = $row["licitkulonbseg"];
                $this->aktualisLicit = $row["aktualisLicit"];
                $this->leiras = $row["leiras"];
                $this->uid = $row["uid"];
            }
        }       
        else {
            echo "Woops, valami nem jó :-/";
        }
        $conn->close();
    }

    public function printInfo(){
        print "<h1>$this->nev</h1>" . "<br>" . $this->mennyiseg . " db" . "<br><br>" . "Ár: " . $this->ar . " Ft" . "<br><br>" . "Aktuális licit: " . $this->aktualisLicit 
            . " Ft" . "<br><br>" . "Min. különbség: " . $this->licitkulonbseg . "<br><br>" . "Leiras: " . "<br>" . $this->leiras . "<br><br>";
    }

    public function licit($osszeg){

        if($osszeg < $this->aktualisLicit || $osszeg==$this->aktualisLicit)
            echo 'A megadott összeg nem haladja meg az aktuális licitet!';
        
        else if($osszeg - $this->aktualisLicit < $this->licitkulonbseg)
            print 'A megadott összeg kisebb mint a minimális különbség!';

        else{

            $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
       
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "UPDATE items SET aktualisLicit=$osszeg WHERE id=$this->id";
            $conn->query($sql);

            header("Refresh:0");
        }    

    }

}


?>