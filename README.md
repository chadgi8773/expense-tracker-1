# Expense Tracker Application

## Overview
The Expense Tracker is a simple command-line application designed to help users manage their finances by tracking their expenses. Users can add, update, delete, and view their expenses, as well as generate summaries for their spending.

## Features
- Add an expense with a description and amount.
- Update an existing expense.
- Delete an expense.
- View all expenses.
- View a summary of total expenses.
- View a summary of expenses for a specific month of the current year.
- (Optional) Add expense categories and filter expenses by category.
- (Optional) Set a monthly budget and receive warnings when exceeding it.
- (Optional) Export expenses to a CSV file.

## Installation
1. Clone the repository:
   ```
   git clone https://github.com/yourusername/expense-tracker.git
   ```
2. Navigate to the project directory:
   ```
   cd expense-tracker
   ```
3. Install dependencies using Composer:
   ```
   composer install
   ```

## Usage
Run the application from the command line using the following syntax:
```
php expense-tracker.php [command] [options]
```

### Commands
- **Add an expense**
  ```
  php expense-tracker.php add --description "Lunch" --amount 20
  ```

- **List all expenses**
  ```
  php expense-tracker.php list
  ```

- **Delete an expense**
  ```
  php expense-tracker.php delete --id 1
  ```

- **View summary of expenses**
  ```
  php expense-tracker.php summary
  ```

- **View summary for a specific month**
  ```
  php expense-tracker.php summary --month 8
  ```

## Data Storage
Expenses are stored in a JSON file located at `data/expenses.json`. The file contains an array of expense objects, each with the following properties:
- `id`: Unique identifier for the expense.
- `date`: Date of the expense.
- `description`: Description of the expense.
- `amount`: Amount of the expense.

## Contributing
Contributions are welcome! Please feel free to submit a pull request or open an issue for any suggestions or improvements.

## License
This project is licensed under the MIT License. See the LICENSE file for more details.