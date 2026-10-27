
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('util/main.php');
require('model/database.php');
require('model/product_db.php');

// 1. Lấy danh sách sản phẩm thuộc danh mục Guitars
$cat_id = 1;
$products = get_products_by_category($cat_id);

// 2. Tìm và xóa sản phẩm theo tên
$product_name = 'Fender Telecaster';
$product = get_product_by_name($product_name);

if ($product) {
    $product_id = $product['productID'];
    $rows_deleted = delete_product($product_id);

    if ($rows_deleted > 0) {
        $delete_message = 'Product deleted successfully.';
    } else {
        $delete_message = 'No rows were deleted.';
    }
} else {
    $delete_message = 'Product not found.';
}

// 3. Thêm sản phẩm
$category_id = 1;
$code = 'tele';
$name = 'Fender Telecaster';
$description = 'NA';
$price = 949.99;
$discount_percent = 0;

$product_id = add_product(
    $category_id,
    $code,
    $name,
    $description,
    $price,
    $discount_percent
);

if ($product_id !== false) {
    $insert_message = 'Product added successfully.';
} else {
    $insert_message = 'A product with this code already exists.';
}

// 4. Hiển thị giao diện
include('home.php');
?>

