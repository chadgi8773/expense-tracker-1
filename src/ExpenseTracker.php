<?php

class ExpenseTracker {
    private $expenses = [];
    private $dataFile = __DIR__ . '/../data/expenses.json';

    public function __construct() {
        $this->loadExpenses();
    }

    private function loadExpenses() {
        if (file_exists($this->dataFile)) {
            $data = json_decode(file_get_contents($this->dataFile), true);
            $this->expenses = $data ? $data : [];
        }
    }

    private function saveExpenses() {
        file_put_contents($this->dataFile, json_encode($this->expenses, JSON_PRETTY_PRINT));
    }

    public function addExpense($description, $amount) {
        $id = count($this->expenses) + 1;
        $expense = [
            'id' => $id,
            'date' => date('Y-m-d'),
            'description' => $description,
            'amount' => $amount
        ];
        $this->expenses[] = $expense;
        $this->saveExpenses();
        return $id;
    }

    public function updateExpense($id, $description, $amount) {
        foreach ($this->expenses as &$expense) {
            if ($expense['id'] == $id) {
                $expense['description'] = $description;
                $expense['amount'] = $amount;
                $this->saveExpenses();
                return true;
            }
        }
        return false;
    }

    public function deleteExpense($id) {
        foreach ($this->expenses as $key => $expense) {
            if ($expense['id'] == $id) {
                unset($this->expenses[$key]);
                $this->saveExpenses();
                return true;
            }
        }
        return false;
    }

    public function listExpenses() {
        return $this->expenses;
    }

    public function getSummary() {
        $total = array_sum(array_column($this->expenses, 'amount'));
        return $total;
    }

    public function getMonthlySummary($month) {
        $total = 0;
        foreach ($this->expenses as $expense) {
            if (date('n', strtotime($expense['date'])) == $month) {
                $total += $expense['amount'];
            } 
        }
        return $total;
    }
}