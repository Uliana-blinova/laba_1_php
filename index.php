<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <img class="flower top-left" src="public/img/flower_pink.png" alt="">
    <img class="flower top-right" src="public/img/flower_blue.png" alt="">
    <img class="flower bottom-left" src="public/img/flower_blue.png" alt="">
    <img class="flower bottom-right" src="public/img/flower_pink.png" alt="">
    <div class="main">
        <form method="POST">
        <h2>Ввод данных</h2>
        <label>Массив X (числа через запятую):
            <input class="input" type="text" name="x" value="<?= htmlspecialchars($_POST['x'] ?? '') ?>" required>
        </label>
        <label>Массив Y (числа через запятую):
            <input class="input" type="text" name="y" value="<?= htmlspecialchars($_POST['y'] ?? '') ?>" required>
        </label>
        <button type="submit">Запустить</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $x = [];
        $y = [];
        
        $x_value = explode(',', $_POST['x']);
        foreach ($x_value as $val) {
            if (trim($val) !== '') {
                $x[] = (int)trim($val); 
            }
        }

        $y_value = explode(',', $_POST['y']);
        foreach ($y_value as $val) {
            if (trim($val) !== '') 
                $y[] = (int)trim($val);
            
        }

        $maxX = [];
        if (count($x) >= 2) {
            rsort($x);
            $maxX[] = $x[0];
            $maxX[] = $x[1];
        } else {
            $maxX = $x; 
        }

        function primeNum($num) {
            if ($num < 2) {
                return false;
            }
            for ($i = 2; $i < $num; $i++) {
                if ($num % $i === 0) {
                    return false;
                }
            }
            return true;
        }

        $primesY = [];
        foreach ($y as $val) {
            if (primeNum($val)) {
                $primesY[] = $val;
            }
        }

        $lastPrimesY = [];
        if (count($primesY) >= 5) {
            for ($i = count($primesY) - 5; $i < count($primesY); $i++) {
                $lastPrimesY[] = $primesY[$i];
            }
        } else {
            $lastPrimesY = $primesY;
        }

        $z = $maxX;
        foreach ($lastPrimesY as $val) {
            $z[] = $val; 
        }

        $foundSeven = [];
        foreach ($z as $num) {
            $strNum = (string)$num;
            $seven = false;
            
            for ($i = 0; $i < strlen($strNum); $i++) {
                if ($strNum[$i] === '7') {
                    $seven = true;
                    break;
                }
            }
            
            if ($seven) {
                $foundSeven[] = $num;
            }
        }
    ?>

<div class="resultat">
    <?php
    echo "<h2>Результаты обработки:</h2>";
    echo "<strong>Исходный массив X:</strong><p> " . implode(', ', $x) . "</p>";
    echo "<strong>Исходный массив Y:</strong><p> " . implode(', ', $y) . "</p>";
    echo "<strong>Массив Z:</strong><p> " . implode(', ', $z) . "</p>";
    ?>
    <div class="output">
        <?php
        if (!empty($foundSeven)) {
        echo "<p>Массив Z содержит числа с цифрой 7: " . implode(', ', $foundSeven) . "</p>";
    } else {
        echo "<p>Массив Z не содержит чисел с цифрой 7.</p>";
    }
    ?>
    </div>
</div>
<?php
}
?> 
</body>
</html>