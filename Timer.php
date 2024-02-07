<?php
require_once "BankAccount.php";
$accountA = new BankAccount('123456789', 1000, 'securepassword', 10000, 60, 0.05);
for($i = 1; $i <= 10; $i++){
    for($j = 1; $j <= 12; $j++){
        // 定期預金の入金
        echo $accountA->fixeddeposit(10000);
        // 何秒に一回入金するか
        $date = date('Y/m/d H:i:s');
        echo $date;
        echo "\n";
        sleep(10);
    }
    // 定期預金につける年利
    echo $accountA->charge($i);
    
}

$date2 = date('Y/m/d H:i:s');
echo $date2;
echo "\n";
echo (strtotime($date2) - strtotime($date)) . "秒の差". "\n";

sleep(3);

$date3 = date('Y/m/d H:i:s');
echo $date3;
echo "\n";
echo (strtotime($date3) - strtotime($date)) . "秒の差". "\n";

?>