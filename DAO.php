<?php

class Dao
{

    private $pdo = null;

    function __construct()
    {

        //接続先情報
        $dsn  = 'mysql:dbname=GrandBlueCasino;host=localhost';
        $user = "gbf_master";
        $pass = "GraPass";
        $test = "PDO_Result:";

        //データベース接続
        try{    
            $this->pdo = new PDO($dsn,$user,$pass);
        } catch (PDOException $e) {
            exit('データベースに接続できませんでした。' . $e->getMessage());
        } 

    }


    public function insertPokerEntry(int $user_id, datetime $start_time)
    {

        $stmt = null;

        $stmt = $this->pdo->prepare("
            INSERT INTO poker_entry (
                user_id,
                start_time,
                finish_time
            )
            VALUES (  
                :user_id,
                :start_time,
                ''
            )
        ");

        if (!$stmt){
            $info = $pdo->errorInfo();
            exit($info[2]);
        }

        $stmt->execute( 
                [ 
                    ":user_id" => $user_id ,
                    ":start_time" => $start_time->format("Y-m-d H:i:s")
                ]
            );

    } 
        

}
