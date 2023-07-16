<?php
//เป็นไฟล์กลางที่จะใช้รวมกับ API ต่างๆ เพื่อที่จะใช้ติดต่อและทำงานกับ Database

class DatabaseConnect
{
    //ประกาศตัวแปรเก็บค่าต่างๆ ที่จะต้องใช้ในกาติดต่อกับฐานข้อมูล
    private $host = "localhost";   //ชื่อ Server ของ DB Server
    private $uname = "root";  //username ที่เข้าใช้งานฐานข้อมูล
    private $pword = "";   //password ที่เข้าใช้งานฐานข้อมูล
    private $dbname = "iottest_db";  //ชื่อฐานข้อมูลที่จะทำงานด้วย
 
    //ประกาศตัวแปรเพื่อใช้สำหรับการติดต่อกับฐานข้อมูล
    public $conn;
 
    //ฟังก์ชันสำหรับการติดต่อไปยังฐานข้อมูล
    public function getConnection()
    {
        $this->conn = null;
 
        try
        {
            //ติดต่อฐานข้อมูล
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}" , $this->uname, $this->pword);
            //log ดูผลว่าติดต่อฐานข้อมูลได้หรือไม่ได้ แล้วอย่าลืม comment
            //echo "Connect OK";
        }
        catch(PDOException $ex)
        {
            //log ดูผลว่าติดต่อฐานข้อมูลได้หรือไม่ได้ แล้วอย่าลืม comment
            //echo "Connect NOT OK";
        }
 
        return $this->conn;
    }
}


