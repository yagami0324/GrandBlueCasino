<?php

class PokerModel
{
  private $hand = []; //初期手札と交換手札
  private $card_property = []; //カードの基本情報(スートや数字、絵柄)
  private $poker_hand_property = []; //上がり役の基本情報(役の名前、得点倍率)

  private $num_joker = 0; //手札に存在するジョーカーの枚数
  private $array_same_rank = []; //手札にある同じ数字の組の配列
  private $flg_flush = false; //手札がフラッシュかどうかの判定フラグ
  private $flg_straight = false;  //手札がストレートかどうかの判定フラグ

  private $poker_hand = 0; //手札で成立している役を保持する変数

  //カードの基本情報作成用
  const RANK_NAME = ['A','2','3','4','5','6','7','8','9','10','J','Q','K'];
  const SUIT_NAME = ['spade', 'heart', 'diamond', 'club'];
  const SUIT_MARK = ['♠', '♡', '♢', '♣'];

  function __construct() 
  {
    
    
    //カードの基本情報(card_property)を作成
    $i=1; //i枚目のカード
    foreach (self::SUIT_NAME as $suit_no =>  $suit_name) 
    {
        foreach (self::RANK_NAME as $rank_no => $rank_name)
        {
          $this->card_property[$i] = 
          array(
            'suit' => $suit_name,
            'rank' => $rank_no + 1,
            'index' => $rank_name.self::SUIT_MARK[$suit_no]
          );
          $i++;
        }
    }
    //53枚目以降にジョーカーを追加
    $this->card_property[$i] = 
    array(
      'suit' => 'joker',
      'rank' => 'joker',
      'index' => 'JK'
    );


    $this->poker_hand_property= array(
      0 => array(
        'name_en' => 'No Pair',
        'name_ja' => 'ノーペア',
        'mag' => 0,
      ),
      1 => array(
        'name_en' => 'Royal Straight Flush',
        'name_ja' => 'ロイヤルストレートフラッシュ',
        'mag' => 250,
      ),
      2 => array(
        'name_en' => 'Five Card',
        'name_ja' => 'ファイブカード',
        'mag' => 60,
      ),
      3 => array(
        'name_en' => 'Straight Flush',
        'name_ja' => 'ストレートフラッシュ',
        'mag' => 25,
      ),
      4 => array(
        'name_en' => 'Four of a Kind',
        'name_ja' => 'フォーカード',
        'mag' => 20,
      ),
      5 => array(
        'name_en' => 'Full House',
        'name_ja' => 'フルハウス',
        'mag' => 10,
      ),
      6 => array(
        'name_en' => 'Flush',
        'name_ja' => 'フラッシュ',
        'mag' => 4,
      ),
      7 => array(
        'name_en' => 'Straight',
        'name_ja' => 'ストレート',
        'mag' => 3,
      ),
      8 => array(
        'name_en' => 'Three of a Kind',
        'name_ja' => 'スリーカード',
        'mag' => 1,
      ),
      9 => array(
        'name_en' => 'Two Pair',
        'name_ja' => 'ツーペア',
        'mag' => 1,
      ),
      10 => array(
        'name_en' => 'One Pair',
        'name_ja' => 'ワンペア',
        'mag' => 0,
      )
    );


  }

  //初期手札5枚と交換候補5枚の計10枚を生成する
  public function makeHand()
  {

    //全カードからランダムに10枚取り出す
    $random_array = range(1,count($this->card_property));
    shuffle($random_array);

    $this->hand = [];
    for ($i = 0 ; $i < 10 ; $i++)
    {
      $this->hand[$i] = $random_array[$i];
    }

  }

  //選択した手札を交換手札と入れ替える
  //1桁目から一番左の手札に対応する
  //2進数で指定する
  public function changeHand(int $chg_flag) 
  {
    
    for ($i=0; $i<5 ; $i++) 
    { 

      //一の位が1だった場合、5個先の要素と値を交換する
      if ($chg_flag & 0b1) 
      {
        list( $this->hand[$i] , $this->hand[$i+5] ) = [ $this->hand[$i+5] , $this->hand[$i] ];
      }

      $chg_flag = $chg_flag>>1; //2進数の値を右に1桁ズラす
    }
  }

  //手札で成立している役を判定する
  public function checkPokerHand() 
  {

    //役の判定を行う前に複数回参照するものを予め実施して記録しておく
    $this->setNumJoker();      //ジョーカーの枚数
    $this->setArraySameRank(); //手札にある同じ数字の組の配列
    $this->setFlgFlush();      //フラッシュが成立しているか
    $this->setFlgStraight();   //ストレートが成立しているか

    //高い役から順番に判定し、成立していたらその時点で終了する
    $this->poker_hand=0;
    if ( $this->isRoyalStraightFlush() === true ) {$this->poker_hand=1;  return $this->poker_hand;} 
    if ( $this->isFiveCard() === true ) {$this->poker_hand=2;  return $this->poker_hand;} 
    if ( $this->isStraightFlush() === true ) {$this->poker_hand=3;  return $this->poker_hand;} 
    if ( $this->isFourOfAKind() === true ) {$this->poker_hand=4;  return $this->poker_hand;} 
    if ( $this->isFullHouse() === true ) {$this->poker_hand=5;  return $this->poker_hand;} 
    if ( $this->isFlush() === true ) {$this->poker_hand=6;  return $this->poker_hand;} 
    if ( $this->isStraight() === true ) {$this->poker_hand=7;  return $this->poker_hand;} 
    if ( $this->isThreeOfAKind() === true ) {$this->poker_hand=8;  return $this->poker_hand;} 
    if ( $this->isTwoPair() === true ) {$this->poker_hand=9;  return $this->poker_hand;} 
    if ( $this->isOnePair() === true ) {$this->poker_hand=10;  return $this->poker_hand;} 
    
    //どの役も成立しなかった場合はノーペア
    $this->poker_hand=0;
    return $this->poker_hand;

  }

  //手札の数値部分のみ(ジョーカーは除く)を抽出した配列を作成する
  public function createArrayNumbers()
  {

    $array_num = [];
    for ($i=0; $i < 5; $i++) 
    { 
      $num = $this->hand[$i];
      if ( is_int($this->card_property[$num]['rank']) ) 
      {
        array_push( $array_num , $this->card_property[$num]['rank'] );
      }
    }

    return $array_num;
  }

  //ジョーカーの枚数を数えて$num_jokerに代入する
  public function setNumJoker() 
  {
    $this->num_joker=0;

    for ($i=0; $i <5 ; $i++) 
    { 
      $num = $this->hand[$i];
      if($this->card_property[$num]['suit']==='joker')
      {
        $this->num_joker+=1;
      }
    }

    return $this->num_joker;
  }

  //重複しているカードを数える
  //返り値はそれぞれの数字の重複枚数の配列 例：[3,1,1,0,0]
  public function setArraySameRank(){

    $this->array_same_rank = [];

    //カードの数値のみを抽出する
    $array_num = [];
    $array_num = $this->createArrayNumbers();

    //ジョーカー処理部分
    //ジョーカーの枚数が4枚以上の時はファイブカードと判定して終了する
    //1～3枚の場合はジョーカーを一番枚数が多いカードのコピーにする
    if ($this->num_joker>=4) 
    {

      $this->array_same_rank=[5,0,0,0,0];
      return $this->array_same_rank;

    } elseif ( (1<=$this->num_joker) && ($this->num_joker<=4) ) 
    {
      
      //一番枚数の多いカードをジョーカーの枚数だけ増やす
      $array_tmp = [];
      $array_tmp = array_count_values($array_num);  //数字とその枚数の連想配列
      arsort($array_tmp); //枚数の降順に並べる
      $array_tmp = array_keys($array_tmp); //連想配列からキー(カードの数字)のみを抜き出す

      $most_num = 0;
      $most_num = $array_tmp[0];  //一番枚数の多い数字を取り出す
      
      for ($i=0; $i < $this->num_joker ; $i++) 
      { 
        array_push( $array_num , $most_num ); //ジョーカーの枚数だけ一番多い数字を配列に足す
      }

    }

    //ジョーカー変換後の数値群に対し、それぞれ何枚重複しているかを数える
    $array_pairs = [];
    $array_pairs = array_count_values($array_num);
    foreach ($array_pairs as $rank => $pair) 
    {
      array_push( $this->array_same_rank , $pair );
    }
    //それぞれ何枚ずつかの配列を降順に並べる
    rsort($this->array_same_rank);

    //5組になるまで残りの項目を0枚で満たして完成
    for ($i=count($this->array_same_rank); $i<5  ; $i++) 
    { 
      array_push($this->array_same_rank,0);
    }

    return $this->array_same_rank;

  }

  //フラッシュを判定し$flg_flushに真偽値を代入する
  public function setFlgFlush()
  {

    //手札5枚のスートを抽出する
    $array_suit = [];
    for ($i=0; $i < 5; $i++) 
    { 
      $num = $this->hand[$i];
      $array_suit[$i]=$this->card_property[$num]['suit'];
    }
    $array_suit = array_unique($array_suit);
    $num_suit = count($array_suit);

    //スートが1種類のみならばフラッシュ成立
    //ジョーカーが1枚以上ある場合は、ジョーカー込み2種類でもフラッシュ成立
    if ($this->num_joker>0) 
    {
      if( ($num_suit===1) || ($num_suit===2) ) 
      {
        $this->flg_flush=true;
        return true;
      }else 
      {
        $this->flg_flush=false;
        return false;
      }      
    } else 
    {
      if($num_suit===1) 
      {
        $this->flg_flush=true;
        return true;
      }else 
      {
        $this->flg_flush=false;
        return false;
      }      
    }
    $this->flg_flush=false;
    return false;

  } 

  //ストレートを判定し$flg_straightに真偽値を代入する
  public function setFlgStraight() 
  {

    //カードの数値のみを抽出する
    $array_num = [];
    $array_num = $this->createArrayNumbers();


    //ジョーカーが3枚以下なら2ステップで判定する
    //STEP1 数値が全てユニーク
    //STEP2 最大値と最小値の差が4以下

    //ジョーカーの枚数が4枚以上ならストレート成立確定
    if ($this->num_joker>=4) 
    {
      $this->flg_straight=true;
      return true;
    } 
    
    //ジョーカーが3枚以下の場合
    if( count($array_num) === count(array_unique($array_num)) ) 
    {
    
      sort($array_num);
      if ( ($array_num[count($array_num)-1] - $array_num[0]) <=4 ) 
      {
        $this->flg_straight=true;
        return true;
      } 
      
      //10,J,Q,K,Aのストレートを拾い上げる
      //Aを14として扱い、最大値と最小値の差が4以下かどうかで判定する
      if ($array_num[0]===1)
      {
        $array_num[0]=14;
        sort($array_num);
        if ( ($array_num[count($array_num)-1] - $array_num[0]) <=4 ) 
        {
          $this->flg_straight=true;
          return true;
        } 
      }
    }

    $this->flg_straight=false;
    return false;
  
  }

  //ロイヤルストレートフラッシュを判定する
  public function isRoyalStraightFlush() 
  {

    //フラッシュとストレートのどちらかを満たしていない場合は終了する
    if ( ($this->flg_flush!==true) || ($this->flg_straight!==true) ) 
    {
      return false;
    } 

    //10～Aのストレートであるかを判定する
    $array_royal = [10,11,12,13,1]; //ロイヤルストレート判定用の配列
    $array_num = $this->createArrayNumbers(); //手札の数字部分のみを抽出した配列
    //10～Aのうち持っているカードの配列
    $array_exist = array_intersect($array_royal,$array_num);  
    //10～Aのうち持っているカードの枚数
    $num_exist = count($array_exist);
    //ジョーカーの枚数によって必要枚数が減る
    $num_required = 5 - $this->num_joker;
    //持っているカードの枚数が必要枚数以上の場合はロイヤルストレートフラッシュが成立
    if ($num_exist >= $num_required) 
    {
      return true;
    }
    return false;    

  } 

  //ファイブカードを判定する
  public function isFiveCard() 
  {

    //一番多いカードの枚数が5枚以上ならファイブカード成立
    if ( $this->array_same_rank[0] >= 5 ) 
    {
      return true;
    }
    return false;

  }

  //ストレートフラッシュを判定する
  public function isStraightFlush() 
  {

    //フラッシュかつストレートならストレートフラッシュ成立
    if ( ($this->flg_flush === true) && ($this->flg_straight === true) ) 
    {
      return true;
    }
    return false;

  }

  //フォーカードを判定する
  public function isFourOfAKind() 
  {

    //一番多いカードの枚数が4枚以上ならフォーカード成立
    if ( $this->array_same_rank[0] >= 4 ) 
    {
      return true;
    }
    return false;

  }

  //フルハウスを判定する
  public function isFullHouse() 
  {

    //一番多いカードの枚数が3枚以上かつ
    //二番目に多いカードが2枚以上ならフルハウス成立
    if ( ($this->array_same_rank[0] >= 3) && ($this->array_same_rank[1] >= 2) ) 
    {
      return true;
    }
    return false;

  }  

  //フラッシュを判定する
  public function isFlush() 
  {

    if ($this->flg_flush === true) 
    {
      return true;
    }
    return false;

  }
  
  //ストレートを判定する
  public function isStraight() 
  {

    if ($this->flg_straight === true) 
    {
      return true;
    }
    return false;

  }  

  //スリーカードを判定する
  public function isThreeOfAKind() 
  {

    //一番多いカードの枚数が3枚以上ならスリーカード成立
    if ( $this->array_same_rank[0] >= 3 ) 
    {
      return true;
    }
    return false;

  }

  //ツーペアを判定する
  public function isTwoPair() 
  {
 
    //一番多いカードの枚数が2枚以上かつ
    //二番目に多いカードが2枚以上ならツーペア成立
    if ( ($this->array_same_rank[0] >= 2) && ($this->array_same_rank[1] >= 2) ) 
    {
      return true;
    }
    return false;
   

  }

  //ワンペアを判定する
  public function isOnePair() 
  {

    //一番多いカードの枚数が2枚以上ならワンペア成立
    if ( $this->array_same_rank[0] >= 2 ) 
    {
      return true;
    }
    return false;

  }
  
  //デバッグ用関数 指定の手札に変更
  public function setDebugHand(array $newHand )
  {
    $this->hand=[];
    $this->hand=$newHand;

    //念の為10枚になるまで1♠で満たしておく
    for ($i=count($this->hand); $i<10  ; $i++) 
    { 
      array_push($this->hand,1);
    }
  }

  //手札を上から5枚表示する
  public function viewHand() 
  {
    $hands=$this->hand;
    for ($i = 0 ; $i < 5 ; $i++)
    {
      $num = $hands[$i];
      echo $this->card_property[$num]['index']." ";
    }
    echo PHP_EOL;
  }

  //手札で成立している役の名前(日本語)を表示する
  public function viewPokerHandNameJa() 
  {
    $num=$this->poker_hand;
    echo $this->poker_hand_property[$num]['name_ja'].PHP_EOL;
  }
  
  //手札で成立している役の名前(英語)を表示する
  public function viewPokerHandNameEn() 
  {
    $num=$this->poker_hand;
    echo $this->poker_hand_property[$num]['name_en'].PHP_EOL;
  }

}


