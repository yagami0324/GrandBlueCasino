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

    //ポーカー開始時にpoker_entryテーブルにポーカー開始の情報を作成する
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
        
   
    //ポーカー開始時にpoker_handテーブルに初期手札を作成する
    //$id:ポーカー1ゲーム毎のID 
    //$card_id:カードの絵柄
    public function insertPokerHand(int $id,int $user_id, int $card_id, datetime $start_time)
    {

        $stmt = null;

        $stmt = $this->pdo->prepare("
            INSERT INTO poker_hand (
                id,
                user_id,
                card_id,
                status,
                start_time,
                finish_time
            )
            VALUES (  
                :id,
                :user_id,
                :card_id,
                0,
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
                    ":id" => $id ,
                    ":user_id" => $user_id ,
                    ":card_id" => $card_id ,
                    ":start_time" => $start_time->format("Y-m-d H:i:s")
                ]
            );

    } 

    //カード交換時にpoker_handテーブルを更新する
    //$new_card_idと$finish_timeは更新する値
    //$user_idと$card_idは更新条件
    public function updatePokerHand(int $new_card_id, datetime $finish_time, int $user_id, int $card_id)
    {

        $stmt = null;

        $stmt = $this->pdo->prepare("
            UPDATE poker_hand SET
            card_id = :new_card_id,
            status = 1,
            finish_time = :finish_time
            WHERE   user_id = :user_id
            AND     card_id = :card_id
            AND     status = 0
        ");

        if (!$stmt){
            $info = $pdo->errorInfo();
            exit($info[2]);
        }

        $stmt->execute( 
                [ 
                    ":new_card_id" => $new_card_id ,
                    ":finish_time" => $finish_time->format("Y-m-d H:i:s") ,
                    ":user_id" => $user_id ,
                    ":card_id" => $card_id
                ]
            );

    } 



}
