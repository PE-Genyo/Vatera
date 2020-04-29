<?php
include "db_config.php";

class User
{

    public $db;

    public function __construct()
    {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

        if (mysqli_connect_errno()) {
            echo "Error: Could not connect to database.";
            exit;
        }
    }


    public function searchByName($keresendo){
        $sql = "SELECT * FROM items where  nev LIKE '%$keresendo%'";
        $result = mysqli_query($this->db, $sql);
        $count_row = $result->num_rows;
        if($count_row != 0)
        {
            while ( $item = mysqli_fetch_array($result)){
                $items[] = $item;
            }
            foreach ($items as $oneItem){
    
                print "<a href=\"item.php?itemID=".$oneItem['id']."\">" . $oneItem['nev'] . "</a>"  . 
                    " - " . $oneItem['mennyiseg']. " db, " . "  Ár: " . $oneItem['ar'] . " Ft, " . "  Aktuális licit: " . $oneItem['aktualisLicit'] . " Ft " . "<br><br>"; 
                    

            }
        }
        else{
            print "Nincs találat.";
        }


    }

    public function listMyItems($uid){

        $sql = "SELECT * FROM items WHERE uid='$uid'";
        $result = mysqli_query($this->db, $sql);
        $count_row = $result->num_rows;
        if ($count_row != 0)
        {
            while ( $item = mysqli_fetch_array($result)){
                $items[] = $item;
            }
            foreach ($items as $oneItem){
                //print $oneItem['nev']."<br>";
                print "<a href=\"item.php?itemID=".$oneItem['id']."\">" . $oneItem['nev'] . "</a>" . "<br>";

            }
        }
        else{
            print "Még nincs felvitt hirdetésed!";
        }


    }

    public function addItem($nev, $mennyiseg, $ar, $idopont, $licitkulonbseg, $aktualislicit, $leiras, $uid){
            $sql = "INSERT INTO items SET nev='$nev',mennyiseg='$mennyiseg',ar='$ar',
                    idopont='$idopont',licitkulonbseg='$licitkulonbseg',aktualisLicit='$aktualislicit',leiras='$leiras', uid='$uid' ";
            $result = mysqli_query($this->db, $sql) or die(mysqli_connect_errno() . "Data cannot be inserted");
            return $result;


    }

    /*** for registration process ***/
    public function reg_user($name, $username, $password, $email)
    {

        $password = md5($password);
        $sql = "SELECT * FROM users WHERE uname='$username' OR uemail='$email'";

//checking if the username or email is available in db
        $check = $this->db->query($sql);
        $count_row = $check->num_rows;

//if the username is not in db then insert to the table
        if ($count_row == 0) {
            $sql1 = "INSERT INTO users SET uname='$username', upass='$password', fullname='$name', uemail='$email'";
            $result = mysqli_query($this->db, $sql1) or die(mysqli_connect_errno() . "Data cannot inserted");
            return $result;
        } else {
            return false;
        }
    }

    /*** for login process ***/
    public function check_login($emailusername, $password)
    {

        $password = md5($password);
        $sql2 = "SELECT uid from users WHERE uemail='$emailusername' or uname='$emailusername' and upass='$password'";

//checking if the username is available in the table
        $result = mysqli_query($this->db, $sql2);
        $user_data = mysqli_fetch_array($result);
        $count_row = $result->num_rows;

        if ($count_row == 1) {
// this login var will use for the session thing
            $_SESSION['login'] = true;
            $_SESSION['uid'] = $user_data['uid'];
            return true;
        } else {
            return false;
        }
    }

    /*** for showing the username or fullname ***/
    public function get_fullname($uid)
    {
        $sql3 = "SELECT fullname FROM users WHERE uid = $uid";
        $result = mysqli_query($this->db, $sql3);
        $user_data = mysqli_fetch_array($result);
        echo $user_data['fullname'];
    }

    /*** starting the session ***/
    public function get_session()
    {
        return $_SESSION['login'];
    }

    public function user_logout()
    {
        $_SESSION['login'] = FALSE;
        session_destroy();
    }

}

?>

