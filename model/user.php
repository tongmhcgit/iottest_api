<?php
class User{
    //ตัวแปรที่จะใช้ติดต่อกับ Database
    private $conn;

    //ตัวแปรที่จะทำงานคู่กับแต่ละฟิวล์หรือคอลัมน์ในตาราง
    public $userId;
    public $userFullname;
    public $userName;
    public $userPassword;
    public $userStatus;

    //ตัวแปรที่จะเก็บข้้อมูลใด เผื่อเอาไว้ใช้งานเฉยๆ
    public $message;

    //คอนสตรักเตอร์ที่จะที่คำสั่งที่ใช้ในการติดต่อกับ Database
    public function __construct($db){
        $this->conn = $db;
    }

    //ฟังชันต่างๆ ที่จะทำงานกับ Database ตาม API ที่เราจะสร้างขึ้นมา ซึ้งมีมากน้อยก็แล้วแต่
    //function loginUser ที่ทำงานกับ api_loginuser.php
    function loginUser(){
        //คำสั่งSQl
        $strSQL = "SELECT * FROM user_tb WHERE userName = :userName and userPassword = :userPassword";

        //กำหนด Statement ที่จะทำงานกับคำสั่ง SQL
        $stmt = $this ->conn->prepare($strSQL);

        //ตรวจสอบข้อมูล
        $this->userName = htmlspecialchars(strip_tags($this->userName));
        $this->userPassword = htmlspecialchars(strip_tags($this->userPassword));

        //กำหนดข้อมูลให้กับ พารามิเตอร์
        $stmt->bindParam(":userName",$this->userName);
        $stmt->bindParam(":userPassword",$this->userPassword);
        
        //ส่งให้ SQL ทำงาน
        $stmt->execute();

        //ส่งค่าผลลัพธ์ที่ได้จากคำสั่ง SQL ไปใช้งาน
        return $stmt;

    }

    //function registerUser ที่ทำงานกับ api_registerUser.php
    function registerUser(){
        //คำสั่ง SQL
        $strSQL = "INSERT INTO user_tb (userFullname, userName, userPassword, userStatus)"; //  กำหนด tabal
        $strSQL .= "VALUES(:userFullname, :userName, :userPassword, :userStatus)";          // กำหนด parameter

        //กำหนด Statement ที่จะทำงานกับคำสั่ง SQL
        $stmt = $this ->conn->prepare($strSQL);

        //ตรวจสอบข้อมูล
        $this->userFullname = htmlspecialchars(strip_tags($this->userFullname));
        $this->userName = htmlspecialchars(strip_tags($this->userName));
        $this->userPassword = htmlspecialchars(strip_tags($this->userPassword));
        $this->userStatus = 1;

        //กำหนดข้อมูลให้กับ พารามิเตอร์
        $stmt->bindParam(":userFullname",$this->userFullname);
        $stmt->bindParam(":userName",$this->userName);
        $stmt->bindParam(":userPassword",$this->userPassword);
        $stmt->bindParam(":userStatus",$this->userStatus);

        //สั่งให้ SQL ทำงาน
        if($stmt->execute()){
            //สำเร็จ
            return true;
        }else{
            //ไม่สำเร็จ
            return false;
        }
    }


    //function updateUser ที่ทำงานกับ api_updateUser.php
    function updateUser(){

        //คำสั่ง SQL
        $strSQL = "UPDATE user_tb SET userFullname = :userFullname, userName = :userName, userPassword = :userPassword WHERE userId = :userId";

        //กำหนด Statement ที่จะทำงานกับคำสั่ง SQL
        $stmt = $this ->conn->prepare($strSQL);

        //ตรวจสอบข้อมูล
        $this->userId = intval(htmlspecialchars(strip_tags($this->userId)));
        $this->userFullname = htmlspecialchars(strip_tags($this->userFullname));
        $this->userName = htmlspecialchars(strip_tags($this->userName));
        $this->userPassword = htmlspecialchars(strip_tags($this->userPassword));

        //กำหนดข้อมูลให้กับ พารามิเตอร์
        $stmt->bindParam(":userId",$this->userId);
        $stmt->bindParam(":userFullname",$this->userFullname);
        $stmt->bindParam(":userName",$this->userName);
        $stmt->bindParam(":userPassword",$this->userPassword);

        //สั่งให้ SQL ทำงาน
        if($stmt->execute()){
            //สำเร็จ
            return true;
        }else{
            //ไม่สำเร็จ
            return false;
        }    
    }
}