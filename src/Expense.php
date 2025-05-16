<?php

class Expense {
    private $id;
    private $date;
    private $description;
    private $amount;

    public function __construct($id, $description, $amount) {
        $this->id = $id;
        $this->date = date('Y-m-d');
        $this->description = $description;
        $this->amount = $amount;
    }

    public function getId() {
        return $this->id;
    }

    public function getDate() {
        return $this->date;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }
}