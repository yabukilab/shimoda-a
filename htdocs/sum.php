<?php
require_once 'db.php';
header('Content-Type: application/json; charset=utf-8');

try {
    $productIds = [];
    foreach ($_GET as $key => $value) {
        if (preg_match('/^id\d+$/', $key)) {
            $productIds[] = (int)$value;
        }
    }

    if (empty($productIds)) {
        echo json_encode(['error' => '商品が選択されていません。']);
        exit;
    }

    $placeholders = implode(',', array_fill(0, count($productIds), '?'));

    // 商品名取得
    $stmt = $db->prepare("SELECT product_id, product_name FROM products WHERE product_id IN ($placeholders)");
    $stmt->execute($productIds);
    $productNames = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $productNames[$row['product_id']] = $row['product_name'];
    }

    $order = strtolower($_GET['order'] ?? 'asc');
    $orderSql = ($order === 'desc') ? 'DESC' : 'ASC';
    $nextOrder = ($order === 'desc') ? 'asc' : 'desc';

    $stmt = $db->prepare("
        SELECT s.store_name, SUM(pz.price) AS total_price
        FROM stores s
        JOIN prices pz ON s.store_id = pz.store_id
        WHERE pz.product_id IN ($placeholders)
        GROUP BY s.store_id
        ORDER BY total_price $orderSql
    ");
    $stmt->execute($productIds);
    $storePrices = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($storePrices as &$row) {
        $store = $row['store_name'];
        $total = (int)$row['total_price'];

        switch ($store) {
            case 'イオン':
                if ($total < 4000) {
                    $row['shipping_fee'] = "550円";
                } elseif ($total < 10000) {
                    $row['shipping_fee'] = "330円";
                } else {
                    $row['shipping_fee'] = "165円";
                }
                break;
            case 'イトーヨーカドー':
                if ($total < 6000) {
                    $row['shipping_fee'] = "490円";
                } else {
                    $row['shipping_fee'] = "330円";
                }
                break;
            case 'Amazon':
                if ($total < 10000) {
                    $row['shipping_fee'] = "2時間440円\n1時間990円";
                } else {
                    $row['shipping_fee'] = "送料無料";
                }
                break;
            case 'ライフ':
                if ($total < 3000) {
                    $row['shipping_fee'] = "2時間枠590円\n1時間枠890円";
                } elseif ($total < 8000) {
                    $row['shipping_fee'] = "2時間枠290円\n1時間枠590円";
                } else {
                    $row['shipping_fee'] = "送料無料";
                }
                break;
            default:
                $row['shipping_fee'] = "500円";
        }
    }
    unset($row);

    $stmt = $db->query("SELECT MAX(updated_at) AS last_updated FROM prices");
    $lastUpdated = $stmt->fetchColumn();

    echo json_encode([
        'productNames' => array_values($productNames),
        'storePrices' => $storePrices,
        'lastUpdated' => $lastUpdated,
        'order' => $order,
        'nextOrder' => $nextOrder
    ]);

} catch (PDOException $e) {
    echo json_encode(['error' => 'DB接続エラー: ' . $e->getMessage()]);
}
?>
