<?php
//определение ассоциативного массива транзакций
$transactions = [
    [
        "transaction_id" => 1,
        "transaction_date" => "2019-01-01",
        "transaction_amount" => 100.00,
        "transaction_description" => "Payment for groceries",
        "merchant_name" => "SuperMart",
    ],
    [
        "transaction_id" => 2,
        "transaction_date" => "2020-02-15",
        "transaction_amount" => 75.50,
        "transaction_description" => "Dinner with friends",
        "merchant_name" => "Local Restaurant",
    ],
    [
        "transaction_id" => 3,
        "transaction_date" => "2021-03-20",
        "transaction_amount" => 250.00,
        "transaction_description" => "Electronics purchase",
        "merchant_name" => "Tech Store",
    ],
    [
        "transaction_id" => 4,
        "transaction_date" => "2022-04-05",
        "transaction_amount" => 60.25,
        "transaction_description" => "Books and Stationery",
        "merchant_name" => "Bookstore",
    ],
];

function calculateTotalAmount($transactions) {
    return array_reduce($transactions, function($carry, $item) {
        return $carry + $item['transaction_amount'];
    }, 0);
}

function calculateAverage($transactions) {
    $total = calculateTotalAmount($transactions);
    return count($transactions) ? $total / count($transactions) : 0;
}

function mapTransactionDescriptions($transactions) {
    return array_map(function($item) {
        return $item['transaction_description'];
    }, $transactions);
}
?>

<table border="1" cellpadding="5" cellspacing="0">
    <tr style="background-color: #a6a6a6; color: #252525">
        <th colspan="5">Транзакции</th>
    </tr>
    <tr style="background-color: #cccccc;">
        <th>ID</th>
        <th>Дата</th>
        <th>Сумма</th>
        <th>Описание</th>
        <th>Организация</th>
    </tr>
    <?php foreach ($transactions as $t): ?>
        <tr>
            <td><?= $t["transaction_id"] ?></td>
            <td><?= $t["transaction_date"] ?></td>
            <td><?= number_format($t["transaction_amount"], 2) ?></td>
            <td><?= $t["transaction_description"] ?></td>
            <td><?= $t["merchant_name"] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<p><strong>Общая сумма:</strong> <?= calculateTotalAmount($transactions) ?></p>
<p><strong>Среднее значение:</strong> <?= number_format(calculateAverage($transactions), 2) ?></p>
<p><strong>Описания транзакций:</strong> <?= implode(', ', mapTransactionDescriptions($transactions)) ?></p>

<!-- Дополнительное задание  -->
<?php
class Transaction {
    public $id;
    public $date;
    public $amount;
    public $description;
    public $merchant;

    public function __construct($id, $date, $amount, $description, $merchant) {
        $this->id = $id;
        $this->date = $date;
        $this->amount = $amount;
        $this->description = $description;
        $this->merchant = $merchant;
    }

    public static function totalAmount($transactions) {
        return array_reduce($transactions, function($carry, $item) {
            return $carry + $item->amount;
        }, 0);
    }

    public static function averageAmount($transactions) {
        $total = self::totalAmount($transactions);
        return count($transactions) ? $total / count($transactions) : 0;
    }
}

$transactionObjects = [
    new Transaction(1, "2019-01-01", 100.00, "Payment for groceries", "SuperMart"),
    new Transaction(2, "2020-02-15", 75.50, "Dinner with friends", "Local Restaurant"),
    new Transaction(3, "2021-03-20", 250.00, "Electronics purchase", "Tech Store"),
    new Transaction(4, "2022-04-05", 60.25, "Books and Stationery", "Bookstore"),
];

?>

<table border="1" cellpadding="5" cellspacing="0">
    <tr style="background-color: #a6a6a6; color: #252525">
        <th colspan="5">Транзакции (объекты)</th>
    </tr>
    <tr style="background-color: #cccccc;">
        <th>ID</th>
        <th>Дата</th>
        <th>Сумма</th>
        <th>Описание</th>
        <th>Организация</th>
    </tr>
    <?php foreach ($transactionObjects as $t): ?>
        <tr>
            <td><?= $t->id ?></td>
            <td><?= $t->date ?></td>
            <td><?= number_format($t->amount, 2) ?></td>
            <td><?= $t->description ?></td>
            <td><?= $t->merchant ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<p><strong>Общая сумма (объекты):</strong> <?= Transaction::totalAmount($transactionObjects) ?></p>
<p><strong>Среднее значение (объекты):</strong> <?= number_format(Transaction::averageAmount($transactionObjects), 2) ?></p>