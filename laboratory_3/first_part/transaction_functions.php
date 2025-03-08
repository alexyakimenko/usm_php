<?php 

/**
 * Calculates total amount of transactions
 * 
 * @param array $transactions transaction array
 * @author Alex Yakimenko
 * @return float total sum of amount field
 */
function calculateTotalAmount(array $transactions): float {
    return array_reduce($transactions, function($carry, $item) {
        return $carry + $item['amount'];
    }, 0);
}

/**
 * Returns first transaction by give description
 * 
 * @param string $descriptionPart desired description part
 * @author Alex Yakimenko
 * @return array transaction
 */
function findTransactionByDescription(string $descriptionPart) {
    global $transactions;
    return array_find($transactions, function($value) use ($descriptionPart) {
        return strpos($value['description'], $descriptionPart) !== false;
    });
}

// Using foreach
// function findTransactionById(int $id) {
//     global $transactions;
//     foreach ($transactions as $transaction) {
//         if($transaction['id'] === $id) {
//             return $transaction;
//         }
//     }
// }

// Using filter 
// function findTransactionById(int $id) {
//     global $transactions;
//     return array_filter($transactions, function($value) use ($id) {
//         return $value['id'] === $id;
//     })[0];
// }

/**
 * Finds and returns transaction by given id
 * 
 * @param int $id desired transaction id
 * @author Alex Yakimenko
 * @return array transaction
 */
function findTransactionById(int $id) {
    global $transactions;
    return array_find($transactions, function($value) use ($id) {
        return $value['id'] === $id;
    });
}

/**
 * Calculates amount of days passed since given date
 * 
 * @param string $date desired date
 * @author Alex Yakimenko
 * @return int amount of days
 */
function daysSinceTransaction(string $date): int {
    $startDate = new DateTime($date);
    $endDate = new DateTime();
    $interval = $startDate->diff($endDate);
    return $interval->days;
}

/**
 * Appends new transaction to global variable $transactions
 * 
 * @param int $id transaction id
 * @param string $date transaction date
 * @param float $amount transaction amount
 * @param string $description transaction description
 * @param string $merchant transaction merchant
 * @author Alex Yakimenko
 * @return void
 */
function addTransaction(int $id, string $date, float $amount, string $description, string $merchant): void {
    global $transactions;
    $transactions[] = [
        'id' => $id,
        'date' => $date,
        'amount' => $amount,
        'description' => $description,
        'merchant' => $merchant
    ];
}

/**
 * Sorts global array $transactions by date
 * 
 * @author Alex Yakimenko
 * @return true returns usort return value aka true
 */
function sortTransactionsByDate(): true {
    global $transactions;
    return usort($transactions, function ($a, $b) {
        $dateA = new DateTime($a['date']);
        $dateB = new DateTime($b['date']);
        return $dateA > $dateB ? -1 : 1;
    });
}

/**
 * Sorts global array $transactions by amount
 * 
 * @author Alex Yakimenko
 * @return true returns usort return value aka true
 */
function sortTransactionsByAmount(): bool {
    global $transactions;
    return usort($transactions, function ($a, $b) {
        return $a['amount'] - $b['amount'];
    });
}

/**
 * Returns new array without desired transaction
 * 
 * @param array $transactions transactions array
 * @param int $id transaction id
 * @author Alex Yakimenko
 * @return true returns new array without desired one
 */
function deleteTransactionById($transactions, int $id) {
    return array_filter($transactions, function($value) use ($id) {
        return $value['id'] !== $id;
    });
}