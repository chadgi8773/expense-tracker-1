<?php

function readExpensesFromFile($filename) {
    if (!file_exists($filename)) {
        return [];
    }
    $json = file_get_contents($filename);
    return json_decode($json, true);
}

function writeExpensesToFile($filename, $expenses) {
    $json = json_encode($expenses, JSON_PRETTY_PRINT);
    file_put_contents($filename, $json);
}

function validateExpenseInput($description, $amount) {
    if (empty($description)) {
        throw new InvalidArgumentException("Description cannot be empty.");
    }
    if (!is_numeric($amount) || $amount < 0) {
        throw new InvalidArgumentException("Amount must be a positive number.");
    }
}

function formatExpenseOutput($expenses) {
    $output = "ID  Date       Description  Amount\n";
    foreach ($expenses as $expense) {
        $output .= sprintf("%-3d %-10s %-12s $%s\n", 
            $expense['id'], 
            $expense['date'], 
            $expense['description'], 
            number_format($expense['amount'], 2)
        );
    }
    return $output;
}