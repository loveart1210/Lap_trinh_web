<?php
function calculateSum($num1, $num2) {
    return $num1 + $num2;
}

function calculateDifference($num1, $num2) {
    return $num1 - $num2;
}

function calculateProduct($num1, $num2) {
    return $num1 * $num2;
}

function calculateQuotient($num1, $num2) {
    if ($num2 == 0) {
        return "Cannot divide by zero";
    }
    return $num1 / $num2;
}

function isPrime($num) {
    if ($num <= 1) return "Không phải số nguyên tố";
    for ($i = 2; $i <= sqrt($num); $i++) {
        if ($num % $i == 0) return "Không phải số nguyên tố";
    }
    return "Số nguyên tố";
}

function isEvenOrOdd($num) {
    if (!is_numeric($num)) return "Không phải số chẵn/lẻ";
    return ($num % 2 == 0) ? "Số chẵn" : "Số lẻ";
}
?>