<?php
session_start();

// Инициализация игрового поля
if (!isset($_SESSION['board'])) {
    $_SESSION['board'] = array_fill(0, 9, '');
    $_SESSION['turn'] = 'X';
    $_SESSION['winner'] = '';
}

// Обработка хода
if (isset($_GET['cell']) && $_SESSION['winner'] === '') {
    $cell = (int)$_GET['cell'];
    if ($_SESSION['board'][$cell] === '') {
        $_SESSION['board'][$cell] = $_SESSION['turn'];
        checkWinner();
        $_SESSION['turn'] = $_SESSION['turn'] === 'X' ? 'O' : 'X';
    }
}

// Сброс игры
if (isset($_GET['reset'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

// Проверка победителя
function checkWinner() {
    $b = $_SESSION['board'];
    $lines = [
        [0,1,2],[3,4,5],[6,7,8], // горизонтали
        [0,3,6],[1,4,7],[2,5,8], // вертикали
        [0,4,8],[2,4,6]          // диагонали
    ];
    foreach ($lines as $line) {
        if ($b[$line[0]] !== '' && $b[$line[0]] === $b[$line[1]] && $b[$line[1]] === $b[$line[2]]) {
            $_SESSION['winner'] = $b[$line[0]];
            return;
        }
    }
    if (!in_array('', $b)) {
        $_SESSION['winner'] = 'draw';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Крестики-нолики</title>
    <style>
        table { border-collapse: collapse; margin-top: 20px; }
        td {
            width: 60px; height: 60px;
            text-align: center; vertical-align: middle;
            font-size: 32px; border: 1px solid #333;
        }
        a { text-decoration: none; color: black; display: block; width: 100%; height: 100%; }
        .info { margin-top: 20px; font-size: 20px; }
    </style>
</head>
<body>

<h2>Крестики-нолики</h2>
<table>
    <?php
    for ($row = 0; $row < 3; $row++) {
        echo "<tr>";
        for ($col = 0; $col < 3; $col++) {
            $i = $row * 3 + $col;
            echo "<td>";
            if ($_SESSION['board'][$i] === '' && $_SESSION['winner'] === '') {
                echo "<a href='?cell=$i'>" . $_SESSION['board'][$i] . "</a>";
            } else {
                echo $_SESSION['board'][$i];
            }
            echo "</td>";
        }
        echo "</tr>";
    }
    ?>
</table>

<div class="info">
    <?php
    if ($_SESSION['winner'] === 'X' || $_SESSION['winner'] === 'O') {
        echo "Победил: " . $_SESSION['winner'];
    } elseif ($_SESSION['winner'] === 'draw') {
        echo "Ничья!";
    } else {
        echo "Ходит: " . $_SESSION['turn'];
    }
    ?>
</div>

<br><a href="?reset=1">🔄 Начать заново</a>

</body>
</html>
