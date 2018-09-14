<?php
require "Model.php";

$pokermodel = new PokerModel;

$pokermodel->drawCards();
$pokermodel->viewHands();

echo 'end';