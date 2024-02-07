<?php

class Hitory  {
    // 日付
    private $date;
    // 操作
    private $operation;
    // 金額
    private $amout;
    // 残高
    private $balance;
    // 口座のID
    private $accountId;
    
    public function __construct($date,$operation,$amout,$balance,$accountId){
        $this->date = $date;
        $this->operation = $operation;
        $this->amout = $amout;
        $this->balance = $balance;
        $this->accountId = $accountId;
    }
    
    // 履歴を表示する

    public function show(){
        echo "{$this->date}に.
            {$this->accountId}で.    
            {$this->operation}して.   
            {$this->amout}.
            {$this->balance}円の残高です。\n";
    }
 }

?>