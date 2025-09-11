<?php
    $product_description = trim(filter_input(INPUT_POST, 'product_description'));
    $list_price = filter_input(INPUT_POST, 'list_price', FILTER_VALIDATE_FLOAT);
    $discount_percent = filter_input(INPUT_POST, 'discount_percent', FILTER_VALIDATE_FLOAT);

    $error_message = '';

    if ($product_description == '') {
        $error_message .= 'Vui lòng nhập mô tả sản phẩm.<br>';
    }
    if ($list_price === false || $list_price <= 0) {
        $error_message .= 'Giá sản phẩm phải là số lớn hơn 0.<br>';
    }
    if ($discount_percent === false || $discount_percent < 0 || $discount_percent > 100) {
        $error_message .= 'Phần trăm giảm giá phải là số từ 0 đến 100.<br>';
    }

    if ($error_message == '') {
        $discount = $list_price * $discount_percent * .01;
        $discount_price = $list_price - $discount;

        $list_price_f = "$" . number_format($list_price, 2);
        $discount_percent_f = $discount_percent . "%";
        $discount_f = "$" . number_format($discount, 2);
        $discount_price_f = "$" . number_format($discount_price, 2);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
        <h1>Product Discount Calculator</h1>
        <?php if ($error_message != ''): ?>
            <div style="color: red;">
                <?php echo $error_message; ?>
            </div>
        <?php else: ?>
            <label>Product Description:</label>
            <span><?php echo htmlspecialchars($product_description); ?></span><br>

            <label>List Price:</label>
            <span><?php echo htmlspecialchars($list_price_f); ?></span><br>

            <label>Standard Discount:</label>
            <span><?php echo htmlspecialchars($discount_percent_f); ?></span><br>

            <label>Discount Amount:</label>
            <span><?php echo $discount_f; ?></span><br>

            <label>Discount Price:</label>
            <span><?php echo $discount_price_f; ?></span><br>
        <?php endif; ?>
    </main>
</body>
</html>