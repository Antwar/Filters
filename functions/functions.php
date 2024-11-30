<?php 
session_start();
$_SERVER['link'] = mysqli_connect('151.248.115.10', 'root', 'Kwuy1mSu4Y', 'is64_Root');

// function getAllProducts () {

//     $query = "SELECT * FROM products";
//     $result = mysqli_query($_SERVER['link'], $query);

//     $products = [];

//     while ($someProduct = mysqli_fetch_assoc($result)) {
//         $products[] = $someProduct;
//     }

//     return $products;
//     mysqli_free_result($result);

// }

function getAllCategories() {

    $query = "SELECT DISTINCT category FROM products";
    $result = mysqli_query($_SERVER['link'], $query);

    $categories = [];

    while ($someCategory = mysqli_fetch_assoc($result)) {
        $categories[] = $someCategory;
    }

    return $categories;
    mysqli_free_result($result);

}

function FilterProducts () {

    // if (isset($_POST['category'])) {
    //     $category = $_POST['category'];
    //     echo 'Категория определена';
    // } elseif ($_POST['min_price'] && $_POST['max_price']) {
    //     $minPrice = $_POST['min_price'];
    //     $maxPrice = $_POST['max_price'];
    //     echo 'Ценово диапазон определён';
    // } else {
    //     echo 'Error';
    // }

    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $minPrice = isset($_POST['minPrice ']) ? $_POST['minPrice'] : '';
    $maxPrice = isset($_POST['maxPrice']) ? $_POST['maxPrice'] : '';

    $query = "SELECT * FROM products";

    $where = [];
    $filters = $_POST['filters'] ?? [];
    foreach($filters as $nameFilter => $value) 
        foreach($value as $comparison => $value) {
            if(empty($value)) continue;
            $comparisonValue = '';
            switch($comparison) {
                case 'like':
                    $comparisonValue = "LIKE '%{$value}%'";
                    break;
                case 'min':
                    $comparisonValue = ">= '{$value}'";
                    break;
                case 'max':
                    $comparisonValue = "<= '{$value}'";
                    break;
            }
            $where[] = "{$nameFilter} {$comparisonValue}";
        }
    
    $sqlWhere = '';
    if($where) {
        $sqlWhere = ' WHERE ' . implode(' AND ', $where);
    }

    $result = mysqli_query($_SERVER['link'], $query . $sqlWhere);

    $products = [];

    while ($someProduct = mysqli_fetch_assoc($result)) {
        $products[] = $someProduct;
    }

    return $products;
    mysqli_free_result($result);

}









?>