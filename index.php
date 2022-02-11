<?php

require_once(__DIR__ . '/vendor/autoload.php');

$config = Finnhub\Configuration::getDefaultConfiguration()->setApiKey('token', 'c82gfkaad3ia12592920');
$client = new Finnhub\Api\DefaultApi(
    new GuzzleHttp\Client(),
    $config
);
$x = "";
$display = ["TSLA", "AAPL", "GME", "NVDA"];

if (isset($_GET["add"])) {
    $x = $_GET["add"];

}

if (!empty($x)) {
    $display = [$x];
}


?>


<form method="get" action="/">
    <label>
        <input style="background: #676e84" name="add" value=""/>
    </label>
    <button type="submit"> Submit</button>
</form>

<style>
    table, th {

        border: 1px solid;
        text-align: center;
        color: whitesmoke;
        background: #212121;

    }

    th {
        padding: 5px;
    }

    body, table, td {
        background: #191d28

    }

    td {
        text-align: center;
        color: white;
    }

</style>


<table>
    <thead>
    <tr>
        <th>
            Index
        </th>
        <th>
            Current Price
        </th>
        <th>
            Close Price
        </th>
        <th>
            Change
        </th>
    </tr>
    </thead>

    <?php foreach ($display

    as $list): ?>
    <tr>
        <?php $data = $client->quote($list); ?>
        <td><?= $list ?>
        <td><?= round($data["c"], 2); ?></td>
        <td><?= round($data["pc"], 2); ?></td>
        <?php if ($data["dp"] < 0) : ?>
            <td style="color: red"><?= round($data["dp"], 2) . "%"; ?></td>
        <?php else: ?>
            <td style="color: green"><?= round($data["dp"], 2) . "%"; ?></td>
        <?php endif ?>
        <?php endforeach; ?>
    </tr>


</table>