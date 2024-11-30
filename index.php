<?php 
require './functions/functions.php';

// $products = getAllProducts();
$products = FilterProducts();
$categories = getAllCategories();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <style>

        .allProducts {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }

        .card {
            background-color: black;
            overflow-wrap: break-word;
            width: auto;
            height: auto;
            padding: 5px;
            min-width: 200px;
            max-width: 350px;
            display: flex;
            flex-direction: column;
            gap: 20px;

        }

        h3 {
            color: white;
        }

        form {
            margin-top: 60px;
        }


    </style>

</head>
<body>

    <main>

        <h1 class="heading">Все продукты</h1>

        <div class="allProducts">

            <?php if (empty($products)): ?>
                <span>Товаров нет</span>
            <?php else: ?>
                <?php foreach($products as $product): ?>
                    <div class="card">

                    <h3>Название: <?php echo htmlspecialchars($product['name'])?></h3>
                    <h3>Категория: <?php echo htmlspecialchars($product['category'])?></h3>
                    <h3>Цена: <?php echo htmlspecialchars($product['price'])?></h3>

                </div>

                <?php endforeach ?>
            <?php endif ?>

        </div>

        <div class="filters">

            <form action="" method="post">

            <select name="filters[category][like]">
                <option value="">Выберите категорию</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo htmlspecialchars($category['category']); ?>">
                        <?php echo htmlspecialchars($category['category']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="number" name="filters[price][min]" placeholder="Минимальная цена">
            <input type="number" name="filters[price][max]" placeholder="Максимальная цена">
           
            <button type="submit">Фильтровать</button>



            </form>


        </div>

    </main>

</body>
</html>