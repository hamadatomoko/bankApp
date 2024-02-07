<?php
require_once "History.php";
class BankAccount {
    // 口座番号
    private $accountNumber;
    // 残高
    private $balance;
    // パスワード
    private $password;
    // 定期預金一回の振込金額
    private $unit_money;
    // 満期までの振り込み回数
    private $count;

    //現在までの振り込み回数
    private $number;
    // 定期預金の残高
    private $fixedBalance = 0;
    // 金利計算用の日付
    private $fixedBalanceDate;
    // 定期預金の一年あたりの金利
    private $rate = 0.05;
    // 編集の履歴
    private $list;

    public function __construct($accountNumber, $initialBalance, $password,$unit_money, $count,$rate ) {
        $this->accountNumber = $accountNumber;
        $this->balance = $initialBalance;
        $this->password = $password;
        $this->unit_money = $unit_money;
        $this->count = $count;
        $this->number = 0;
        $this->rate = $rate ;
        $this->fixedBalance = 0;
        $this->list = array();
    }

    public function getAccountNumber($inputPassword) {
        if ($this->authenticate($inputPassword)) {
            return $this->accountNumber;
            
        } else {
            return "Passwordが間違っているので口座番号が表示できません";
        }   
    }
    // 残高の表示
    public function getBalance() {
        return $this->balance;
    }
    // 普通預金にお金を預ける操作
    public function deposit($amount) {
        if ($amount > 0) {
            $this->balance += $amount;
            return true;
        } else {
            return false;
        }
    }
    // 普通預金からお金を引き出す操作
    public function withdraw($amount) {
        if ($amount > 0 && $amount <= $this->balance) {
            $this->balance -= $amount;
            $history= new History('2月1日','入金','30000','120000','123456');
         array_push($this->list,$history);
            return true;
        } else {
            // 失敗した履歴
            return false;
        }
    }
    // 送金する
    public function remittance($amount,$accountA){
        // 送金金額（$amount）,誰に送るか送信先 BankAccount のインスタンスが必要この二つが引数
        if($this->withdraw($amount)){
            if($accountA->deposit($amount)){

                return "{$this->accountNumber}送金しました";
            }
            // 相手のアカウントに送金額が送れなかった場合：depositのメソッドに対してのelse
            else {
            // 自分の口座に送金金額を戻す。    
                return false;


            }
        } else {
            // 送金が失敗した処理
            return "{$this->accountNumber}送金できませんでした";
        }

    }
    // 定期預金に入金する(１年分)for文を使いましょう。　
    public function fixeddeposit($unit_money){
        
        $this->fixedBalance += $unit_money;
        return "{$unit_money}円分の定期預金に入金がありました";
    }
    // 定期預金を出金する

    
    // 定期預金に年利をつける　　　　年利は10秒ごと。
    public function charge($year){
    // 何年経過した時に金利がついていくらになったか？
        $this->fixedBalance *= ($this->rate + 1);

        return "{$year}年分の金利がついて残高が{$this->fixedBalance}円になりました";
    }
 
    public function setPassword($currentPassword, $newPassword) {
        if ($this->authenticate($currentPassword)) {
            $this->password = $newPassword;
            return true;
        } else {
            return false;
        }
    }

    private function authenticate($inputPassword) {
        return $inputPassword === $this->password;
    }
    // 全ての履歴を表示する関数
    public function showtHistories(){
        foreach($this->list as $history){
            $history-> show();  
        }

    }
}

// 使用例
// new BankAccount('123456789', 1000, 'securepassword');
// $accountA = new BankAccount('123456789', 1000, 'securepassword', 10000, 60);
// $accountB = new BankAccount('987654321', 5000, 'curentpassword', 30000, 24);
// // １回目の入金が終わった。
// $accountA->fixeddeposit();
// echo $accountA->charge(3). "\n";

// echo "Account Number: " . $account->getAccountNumber("securepassword") . "\n";
// echo $account->remittance (1000,$accountA). "\n";



// echo "Balance: " . $account->getBalance() . "\n";

// if ($account->deposit(500)) {
//     echo "Deposit successful.\n";
// } else {
//     echo "Deposit failed.\n";
// }

// if ($account->withdraw(200)) {
//     echo "Withdrawal successful.\n";
// } else {
//     echo "Withdrawal failed.\n";
// }

// if ($account->setPassword('securepassword', 'newpassword')) {
//     echo "Password change successful.\n";
// } else {
//     echo "Password change failed.\n";
// }
?>