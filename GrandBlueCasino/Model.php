<?php

class PokerModel
{
  public $cardProperty = []; //全カードの基本情報(スートや数字等)
  public $hands = []; //初期手札と交換手札

  function __construct() {
    $this->cardProperty = array(
      0 => array(
        'suit' => 'joker',
        'rank' => 0,
        'index' => 'JK'
      ),
      1 => array(
        'suit' => 'spade',
        'rank' => 1,
        'index' => 'A♠'
      ),
      2 => array(
        'suit' => 'spade',
        'rank' => 2,
        'index' => '2♠'
      ),
      3 => array(
        'suit' => 'spade',
        'rank' => 3,
        'index' => '3♠'
      ),
      4 => array(
        'suit' => 'spade',
        'rank' => 4,
        'index' => '4♠'
      ),
      5 => array(
        'suit' => 'spade',
        'rank' => 5,
        'index' => '5♠'
      ),
      6 => array(
        'suit' => 'spade',
        'rank' => 6,
        'index' => '6♠'
      ),
      7 => array(
        'suit' => 'spade',
        'rank' => 7,
        'index' => '7♠'
      ),
      8 => array(
        'suit' => 'spade',
        'rank' => 8,
        'index' => '8♠'
      ),
      9 => array(
        'suit' => 'spade',
        'rank' => 9,
        'index' => '9♠'
      ),
      10 => array(
        'suit' => 'spade',
        'rank' => 10,
        'index' => '10♠'
      ),
      11 => array(
        'suit' => 'spade',
        'rank' => 11,
        'index' => 'J♠'
      ),
      12 => array(
        'suit' => 'spade',
        'rank' => 12,
        'index' => 'Q♠'
      ),
      13 => array(
        'suit' => 'spade',
        'rank' => 13,
        'index' => 'K♠'
      ),
      14 => array(
        'suit' => 'heart',
        'rank' => 1,
        'index' => 'A♡'
      ),
      15 => array(
        'suit' => 'heart',
        'rank' => 2,
        'index' => '2♡'
      ),
      16 => array(
        'suit' => 'heart',
        'rank' => 3,
        'index' => '3♡'
      ),
      17 => array(
        'suit' => 'heart',
        'rank' => 4,
        'index' => '4♡'
      ),
      18 => array(
        'suit' => 'heart',
        'rank' => 5,
        'index' => '5♡'
      ),
      19 => array(
        'suit' => 'heart',
        'rank' => 6,
        'index' => '6♡'
      ),
      20 => array(
        'suit' => 'heart',
        'rank' => 7,
        'index' => '7♡'
      ),
      21 => array(
        'suit' => 'heart',
        'rank' => 8,
        'index' => '8♡'
      ),
      22 => array(
        'suit' => 'heart',
        'rank' => 9,
        'index' => '9♡'
      ),
      23 => array(
        'suit' => 'heart',
        'rank' => 10,
        'index' => '10♡'
      ),
      24 => array(
        'suit' => 'heart',
        'rank' => 11,
        'index' => 'J♡'
      ),
      25 => array(
        'suit' => 'heart',
        'rank' => 12,
        'index' => 'Q♡'
      ),
      26 => array(
        'suit' => 'heart',
        'rank' => 13,
        'index' => 'K♡'
      ),
      27 => array(
        'suit' => 'diamond',
        'rank' => 1,
        'index' => 'A♢'
      ),
      28 => array(
        'suit' => 'diamond',
        'rank' => 2,
        'index' => '2♢'
      ),
      29 => array(
        'suit' => 'diamond',
        'rank' => 3,
        'index' => '3♢'
      ),
      30 => array(
        'suit' => 'diamond',
        'rank' => 4,
        'index' => '4♢'
      ),
      31 => array(
        'suit' => 'diamond',
        'rank' => 5,
        'index' => '5♢'
      ),
      32 => array(
        'suit' => 'diamond',
        'rank' => 6,
        'index' => '6♢'
      ),
      33 => array(
        'suit' => 'diamond',
        'rank' => 7,
        'index' => '7♢'
      ),
      34 => array(
        'suit' => 'diamond',
        'rank' => 8,
        'index' => '8♢'
      ),
      35 => array(
        'suit' => 'diamond',
        'rank' => 9,
        'index' => '9♢'
      ),
      36 => array(
        'suit' => 'diamond',
        'rank' => 10,
        'index' => '10♢'
      ),
      37 => array(
        'suit' => 'diamond',
        'rank' => 11,
        'index' => 'J♢'
      ),
      38 => array(
        'suit' => 'diamond',
        'rank' => 12,
        'index' => 'Q♢'
      ),
      39 => array(
        'suit' => 'diamond',
        'rank' => 13,
        'index' => 'K♢'
      ),
      40 => array(
        'suit' => 'club',
        'rank' => 1,
        'index' => 'A♣'
      ),
      41 => array(
        'suit' => 'club',
        'rank' => 2,
        'index' => '2♣'
      ),
      42 => array(
        'suit' => 'club',
        'rank' => 3,
        'index' => '3♣'
      ),
      43 => array(
        'suit' => 'club',
        'rank' => 4,
        'index' => '4♣'
      ),
      44 => array(
        'suit' => 'club',
        'rank' => 5,
        'index' => '5♣'
      ),
      45 => array(
        'suit' => 'club',
        'rank' => 6,
        'index' => '6♣'
      ),
      46 => array(
        'suit' => 'club',
        'rank' => 7,
        'index' => '7♣'
      ),
      47 => array(
        'suit' => 'club',
        'rank' => 8,
        'index' => '8♣'
      ),
      48 => array(
        'suit' => 'club',
        'rank' => 9,
        'index' => '9♣'
      ),
      49 => array(
        'suit' => 'club',
        'rank' => 10,
        'index' => '10♣'
      ),
      50 => array(
        'suit' => 'club',
        'rank' => 11,
        'index' => 'J♣'
      ),
      51 => array(
        'suit' => 'club',
        'rank' => 12,
        'index' => 'Q♣'
      ),
      52 => array(
        'suit' => 'club',
        'rank' => 13,
        'index' => 'K♣'
      )
    );
  }

  //初期手札5枚と交換候補5枚の計10枚を生成する
  public function drawCards() {

    //0～52からランダムに10個の数値を取り出す
    $random_array = range(0,52);
    shuffle($random_array);

    $this->hands = [];
    for ($i = 0 ; $i < 10 ; $i++){
      $this->hands[$i] = $random_array[$i];
    }

  }

  //手札を上から5枚表示する
  public function viewHands() {
    for ($i = 0 ; $i < 5 ; $i++){
      $num = $this->hands[$i];
      echo $this->cardProperty[$num]['index'].PHP_EOL;
    }
  }

}


