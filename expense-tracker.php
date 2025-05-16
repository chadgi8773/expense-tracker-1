<?php

require_once 'src/ExpenseTracker.php';
require_once 'src/helpers.php';

$tracker = new ExpenseTracker();

$command = $argv[1] ?? null;

switch ($command) {
    case 'add':
        $description = null;
        $amount = null;

        for ($i = 2; $i < count($argv); $i++) {
            if (strpos($argv[$i], '--description=') === 0) {
                $description = substr($argv[$i], strlen('--description='));
            } elseif ($argv[$i] === '--description' && isset($argv[$i + 1])) {
                $description = $argv[$i + 1];
                $i++;
            } elseif (strpos($argv[$i], '--amount=') === 0) {
                $amount = floatval(substr($argv[$i], strlen('--amount=')));
            } elseif ($argv[$i] === '--amount' && isset($argv[$i + 1])) {
                $amount = floatval($argv[$i + 1]);
                $i++;
            }
        }

        if ($description && $amount > 0) {
            $id = $tracker->addExpense($description, $amount);
            echo "Expense added successfully (ID: $id)\n";
        } else {
            echo "Invalid input. Please provide a valid description and amount.\n";
        }
        break;

    case 'list':
        $expenses = $tracker->listExpenses();
        if (empty($expenses)) {
            echo "No expenses found.\n";
        } else {
            echo "ID  Date       Description  Amount\n";
            foreach ($expenses as $expense) {
                echo "{$expense['id']}   {$expense['date']}  {$expense['description']}        \${$expense['amount']}\n";
            }
        }
        break;

    case 'delete':
        $id = intval($argv[3] ?? 0);
        if ($id > 0) {
            $tracker->deleteExpense($id);
            echo "Expense deleted successfully\n";
        } else {
            echo "Invalid ID. Please provide a valid expense ID.\n";
        }
        break;

    case 'summary':
        $month = null;
        for ($i = 2; $i < count($argv); $i++) {
            if ($argv[$i] === '--month' && isset($argv[$i + 1])) {
                $month = intval($argv[$i + 1]);
                break;
            }
        }
        if ($month !== null && $month > 0 && $month <= 12) {
            $total = $tracker->getMonthlySummary($month);
            echo "Total expenses for month $month: \$$total\n";
        } else {
            $total = $tracker->getSummary();
            echo "Total expenses: \$$total\n";
        }
        break;

    default:
        echo "Invalid command. Please use add, list, delete, or summary.\n";
        break;
}