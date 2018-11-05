<?php
require "Model.php";

test

$poker_model = new PokerModel;

echo '【初期手札】'.PHP_EOL;
$poker_model->makeHand();
$poker_model->viewHand();
$poker_model->checkPokerHand();
$poker_model->viewPokerHandNameJa();
echo PHP_EOL;

echo '【マリガン後】'.PHP_EOL;
$poker_model->changeHand(0b10101);
$poker_model->viewHand();
$poker_model->checkPokerHand();
$poker_model->viewPokerHandNameJa();
echo PHP_EOL;

echo '【デバッグ用手札】'.PHP_EOL;
$poker_model->setDebugHand( [14,10,11,1,13] );
$poker_model->viewHand();
$poker_model->checkPokerHand();
$poker_model->viewPokerHandNameJa();
echo PHP_EOL;

//確認用
$a_num_joker = $poker_model->setNumJoker();
$b_array_sameRank = $poker_model->setArraySameRank();
$c_flg_flush = $poker_model->setFlgFlush();
$d_flg_straight = $poker_model->setFlgStraight();
$e_royal = $poker_model->isRoyalStraightFlush();
$f_five = $poker_model->isFiveCard();
$g_straightflush = $poker_model->isStraightFlush();
$h_four = $poker_model->isFourOfAKind();
$i_fullhouse = $poker_model->isFullHouse();
$j_flush = $poker_model->isFlush();
$k_straight = $poker_model->isStraight();
$l_three = $poker_model->isThreeOfAKind();
$m_two = $poker_model->isTwoPair();
$n_one = $poker_model->isOnePair();

echo 'end';
