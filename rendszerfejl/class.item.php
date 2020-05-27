<link rel="stylesheet" type="text/css" href="class_item.css">

<?php
include 'db_config.php';

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
    private $image;

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

            $sql = "SELECT hashName FROM images WHERE id=$itemID";
            $result = $this->conn->query($sql);
            $row = $result->fetch_assoc();

            if (empty($row) || is_null($result))
                $this->image="default.jpg";  
            else
                $this->image=$row["hashName"];
                
        }       
        else 
            echo "Woops, valami nem jó :-/";
          
    }

    public function printInfo(){
       
        print"<a href=\"images\\$this->image\"><img src=\"images\\$this->image\" width=\"250px\" height=\"250px\"\></a> ". "<br><br>";

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

        //print "szerver idő: " . date("Y-m-d H:i:s",time());
        if($this->idopont < date("Y-m-d H:i:s",time()))
          print "<div class=\"alert\">A licit véget ért</div>";
    }

    public function licit($osszeg){

      if( date("Y-m-d H:i:s",time()) > $this->idopont)
        print "<div class=\"alert\">Kifutottál az időből :(</div>";
         
      else if($osszeg < $this->aktualisLicit || $osszeg==$this->aktualisLicit)
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

    public function getIdopont(){
      return $this->idopont;
    }

    public function addComment($comment){

        if(!preg_match('/^(?!\s*$).+/',$comment) || strlen($comment)>500){
            print "<div class=\"alert\">Érvénytelen hozzászólás</div>";
        }
        else{
            //$comment="<pre>" . $comment ."</pre>";
            $current_user = $_SESSION['uid'];
            $sql = "INSERT INTO comments(itemID,userID,comment,time) VALUES($this->itemID,$current_user,'$comment',CURRENT_TIMESTAMP())";
            $this->conn->query($sql);
            header("Refresh:0");
        }   
    }

    public function printComments(){
        $sql= "SELECT fullname, comment, c.userID, time, id FROM comments c join users u on c.userID=u.uid WHERE itemID=$this->itemID ORDER BY time DESC";
        $result = $this->conn->query($sql);
       
        print "<div class=\"hozz\"><h3><b>Hozzászólások: </b></h3></div><br><br>";
      
        if(mysqli_num_rows($result) == 0) 
            print "<div class=\"hozz\"><b>Még nem érkezett hozzászólás</b></div>";

        else{
            while ($row = mysqli_fetch_assoc($result)) {
                print "<table class=\"comment\" width=35%>
                <thead>
                    <tr>
                        <th class=\"comment-enyh\"><b>" . $row['fullname'] . "</b>" . " - " . $row['time'] . "</th>" . "
                        <td class=\"comment-xcrh\" style=\"background-color:#ace8ef;\">";

                if($row['userID'] == $_SESSION['uid']){
                    print "<form action=\"\" method=\"post\" name=\"del\">
                    <button class=\"button buttonDel\" type=\"submit\" name=\"del\" value=". $row['id'] ." >Törlés</button>
                    </form>";
                }

                print "</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class=\"comment-ucrh\" colspan=\"2\">" . $row['comment'] . "</td>
                    </tr>
                </tbody>
                </table>" . "<br>";
            }
        }
    }

    public function deleteMyComment($commentID){
        $sql="DELETE FROM comments WHERE id='$commentID'";
        $this->conn->query($sql);
        echo("<script>location.href = 'item.php?itemID=$this->itemID';</script>");
    }

    public function uploadImage($file){
        
        $target_dir = "images/";
        $target_file = $target_dir . basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
          $check = getimagesize($file["tmp_name"]);
          if($check !== false) {

            $uploadOk = 1;
          } else {
            return "File is not an image.";
            $uploadOk = 0;
          }
        }
        
        // Check file size
        if ($file["size"] > 500000) {
          return "Sorry, your file is too large.";
          $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            $hashName = hash('md5',$file["name"]);
            $target_file=$target_dir . $hashName . '.' . $imageFileType;
          if (move_uploaded_file($file["tmp_name"], $target_file)) {
            echo "The file ". basename( $file["name"]). " has been uploaded.";
          } else {
            return "Sorry, there was an error uploading your file.";
          }
        }
        
        $sql="INSERT INTO images VALUES($this->itemID,\"$hashName.$imageFileType\")";
        $result = $this->conn->query($sql);
        if($result)
            return "OK";
    }

    public function printSmall(){
      print"<a href=\"item.php?itemID=$this->itemID\"> 
      <table class=\"tg\" width=25%>
        <thead>
          <tr>
            <th class=\"tg-6oj4\" colspan=\"3\"><a href=\"item.php?itemID=".$this->itemID."\" class=\"aa1\">" . $this->nev . "</a></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class=\"tg-eqqf\"><img src=\"images\\$this->image\" width=\"70px\" height=\"70px\"\></td>
            <td class=\"tg-eqqf\"><b>Jelenlegi licit:" . "<br><br>" . $this->aktualisLicit ." Ft</b></td>
            <td class=\"tg-eqqf\"><b>Határidő:"; 
              if($this->idopont < date("Y-m-d H:i:s",time())) 
                print "<div style=\"color:red;\">(Lejárt)</div>" . $this->idopont ."</b></td>"; 
              else 
                print "<br><br>" . $this->idopont;
        print "
          </tr>
        </tbody>
        </table></a>
        " . "<br>";
    }
}

include("footer.php");
?>