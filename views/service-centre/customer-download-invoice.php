<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - Order #<?= $orderDetails[0]['order_id'] ?? 'N/A' ?></title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            padding: 40px;
            color: #333;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .invoice-header h1 {
            font-size: 28px;
            margin: 0;
        }

        .info-section, .total-section {
            margin-bottom: 20px;
        }

        .info-label {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .total-section {
            text-align: right;
            font-size: 16px;
        }

        .total-section .amount {
            font-size: 20px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            color: #999;
            font-size: 12px;
        }

        .highlight {
            background-color: #f7f7f7;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="invoice-header">
            <h1>Invoice</h1>
            <p>Order ID: <?= $order_id ?? 'N/A' ?> | Date: <?= date('Y-m-d') ?></p>
        </div>

        <div class="info-section">
            <p><span class="info-label">Customer:</span> <?= $customer_name ?? 'N/A' ?></p>
            <p><span class="info-label">Email:</span> <?= $checkoutInfo['email'] ?? 'N/A' ?></p>
            <p><span class="info-label">Address:</span> <?= $checkoutInfo['address'] ?? 'N/A' ?></p>
        </div>

        <table>
            <thead class="highlight">
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Unit Price (LKR)</th>
                    <th>Quantity</th>
                    <th>Subtotal (LKR)</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1; ?>
                <?php foreach ($cartItems as $item): ?>
                    <tr>
                        <td><?= $count++ ?></td>
                        <td><?= $item['description'] ?></td>
                        <td><?= number_format($item['price'], 2) ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="total-section">
            <p>Total: <span class="amount">LKR <?= $total ?></span></p>
        </div>

        <div class="footer">
            <p>Thank you for choosing FixMe Technologies!</p>
        </div>
    </div>
</body>
</html>
