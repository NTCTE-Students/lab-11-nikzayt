<?php
function validateCreditCard($cardNumber) {
    // Удаляем все нецифровые символы
    $cardNumber = preg_replace('/\D/', '', $cardNumber);
    
    // Проверяем длину (обычно 13-19 цифр) и начало номера
    if (!preg_match('/^[4-6]\d{12,18}$/', $cardNumber)) {
        return false;
    }
    
    // Проверяем алгоритм Луна
    $sum = 0;
    $length = strlen($cardNumber);
    for ($i = 0; $i < $length; $i++) {
        $digit = (int)$cardNumber[$length - $i - 1];
        if ($i % 2 == 1) {
            $digit *= 2;
            if ($digit > 9) {
                $digit -= 9;
            }
        }
        $sum += $digit;
    }
    
    return ($sum % 10 == 0);
}

$cards = [
    '4111 1111 1111 1111', // Верный номер (Visa тестовый)
    '5500 0000 0000 0004', // Верный номер (MasterCard тестовый)
    '1234 5678 9012 3456', // Неверный номер
    '6011 0000 0000 0004', // Верный номер (Discover тестовый)
    '3782 822463 10005'    // Верный номер (American Express тестовый)
];

foreach ($cards as $card) {
    echo "$card - " . (validateCreditCard($card) ? "верный" : "неверный") . "\n";
}
?>