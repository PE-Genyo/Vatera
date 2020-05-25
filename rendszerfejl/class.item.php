<link rel="stylesheet" type="text/css" href="class_item.css">

<?php
include "class.user.php";

class Item{

  
    private $conn;

    private $itemID;
    private $nev; 
    private $mennyiseg;  
    private $ar;
    private $nyertes;  
    private $idopont; 
    private $licitkulonbseg;  
    private $aktualisLicit;
    private $leiras;
    private $uid;

    public function __construct($itemID)
    {
        $this->conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
       
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        $sql = "SELECT * FROM items where id = $itemID";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
 
            $row = $result->fetch_assoc(); 
                $this->itemID = $row["id"];
                $this->nev = $row["nev"];
                $this->mennyiseg = $row["mennyiseg"];
                $this->ar = $row["ar"];
                $this->idopont = $row["idopont"];
                $this->licitkulonbseg = $row["licitkulonbseg"];
                $this->aktualisLicit = $row["aktualisLicit"];
                $this->leiras = $row["leiras"];
                $this->uid = $row["uid"];
                $this->nyertes = $row["nyertesID"];

            $sql = "SELECT uname FROM users WHERE uid=$this->nyertes";
            $result = $this->conn->query($sql);
            
            if (empty($result))
                $this->nyertes="Még senki sem licitált";   
            else{
                $row = $result->fetch_assoc();
                $this->nyertes=$row["uname"];
            }
                
        }       
        else 
            echo "Woops, valami nem jó :-/";
          
    }

    public function printInfo(){
        
        print"
        <table class=\"tg\" width=20%>
        <thead>
          <tr>
            <th class=\"tg-6oj4\" colspan=\"2\">$this->nev</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class=\"tg-eqqf\">Mennyiség</td>
            <td class=\"tg-2klh\">$this->mennyiseg "." db"."</td>
          </tr>
          <tr>
            <td class=\"tg-eqqf\">Aktuális licit</td>
            <td class=\"tg-2klh\">$this->aktualisLicit "." Ft"."</td>
          </tr>
          <tr>
            <td class=\"tg-eqqf\">Jelenlegi nyertes</td>
            <td class=\"tg-2klh\">$this->nyertes</td>
          </tr>
          <tr>
            <td class=\"tg-eqqf\">Min. különbség:</td>
            <td class=\"tg-2klh\">$this->licitkulonbseg "." Ft"."</td>
          </tr>
          <tr>
            <td class=\"tg-eqqf\">Ár</td>
            <td class=\"tg-2klh\">$this->ar "." Ft"."</td>
          </tr>
          <tr>
            <td class=\"tg-eqqf\">Lejár</td>
            <td class=\"tg-2klh\">$this->idopont</td>
          </tr>
          <tr>
            <td class=\"tg-i8xh\" colspan=\"2\">$this->leiras</td>
          </tr>
        </tbody>
        </table>
        " . "<br>";
    }

    public function licit($osszeg){
         
        if($osszeg < $this->aktualisLicit || $osszeg==$this->aktualisLicit)
            print "<div class=\"alert\">A megadott összeg nem haladja meg az aktuális licitet!</div>";
        
        else if($osszeg - $this->aktualisLicit < $this->licitkulonbseg)
            print "<div class=\"alert\">A megadott összeg kisebb mint a minimális különbség!</div>";

        else{
            $current_user = $_SESSION['uid'];
            $sql = "UPDATE items SET aktualisLicit=$osszeg, nyertesID=$current_user WHERE id=$this->itemID";
            $this->conn->query($sql);

            header("Refresh:0");
        }    

    }

    public function getUserId(){

        return $this->uid;

    }

    public function addComment($comment){

        if(!preg_match('/^(?!\s*$).+/',$comment) || strlen($comment)>500){
            print "<div class=\"alert\">Érvénytelen hozzászólás</div>";
        }
        else{
            
            $current_user = $_SESSION['uid'];
            $sql = "INSERT INTO comments VALUES($this->itemID,$current_user,'$comment',CURRENT_TIMESTAMP())";
            $this->conn->query($sql);
            header("Refresh:0");
        }   
    }

    public function printComments(){
        $sql= "SELECT fullname, comment, time FROM comments c join users u on c.userID=u.uid WHERE itemID=$this->itemID ORDER BY time DESC";
        $result = $this->conn->query($sql);
        
        print "<b>Hozzászólások: </b><br><br>";
        if(mysqli_num_rows($result) == 0) 
            print "Még nem érkezett hozzászólás";
        else{
            while ($row = mysqli_fetch_assoc($result)) {
                print "<table class=\"comment\" width=35%>
                <thead>
                    <tr>
                        <th class=\"comment-enyh\"><b>" . $row['fullname'] . "</b>" . " - " . $row['time'] . "</th>" . "
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class=\"comment-ucrh\">" . $row['comment'] . "</td>
                    </tr>
                </tbody>
                </table>" . "<br>";
            }
        }
    }
}


?>