<?php
function findMax($arr) {
    return !empty($arr) ? max($arr) : "Mảng rỗng";
}

function findMin($arr) {
    return !empty($arr) ? min($arr) : "Mảng rỗng";
}

function calculateSum($arr) {
    return !empty($arr) ? array_sum($arr) : "Mảng rỗng";
}

function sortAscending($arr) {
    $sorted = $arr;
    sort($sorted);
    return !empty($sorted) ? $sorted : "Mảng rỗng";
}

function sortDescending($arr) {
    $sorted = $arr;
    rsort($sorted);
    return !empty($sorted) ? $sorted : "Mảng rỗng";
}

function if_available($arr, $number) {
    return in_array($number, $arr, true) ? "Phần tử $number có trong mảng" : "Phần tử $number không có trong mảng";
}

function getOriginalArray($arr) {
    return !empty($arr) ? implode(", ", $arr) : "Mảng rỗng";
}
?>