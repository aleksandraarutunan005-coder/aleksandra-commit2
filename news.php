<?php

require_once 'config.php';


$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;


if($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
    $stmt->execute([$id]);
    $newsItem = $stmt->fetch(PDO::FETCH_ASSOC);
}

if(!$newsItem) {
    die("Новость не найдена");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Галактический Вестник</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="secondpage.css">
    </head>
    <body>
        <header>
            <img src="images/icons/logo 1.png" alt="лого">
            <p>ГАЛАКТИЧЕСКИЙ<br>ВЕСТНИК</p>
        </header>
        <main>
            <p>Главная / <span><?php echo htmlspecialchars($newsItem['title']); ?></span></p>
            <h1><?php echo htmlspecialchars($newsItem['title']); ?></h1>
            <div class="fullNew">
                <div class="new">
                    <p class="date"><?php echo date('d.m.Y', strtotime($newsItem['date'])); ?></p>
                    <h2><?php echo strip_tags($newsItem['announce']); ?></h2>
                    <?php echo $newsItem['content']; ?>
                    <a class="return-btn" href="index.php">
                        <img src="images/icons/reversArrow.png" alt=""> 
                        <span>НАЗАД К НОВОСТЯМ</span>
                    </a>
                </div>
                <div class="imgContainer">
                    <img src="images/<?php echo htmlspecialchars($newsItem['image']); ?>" alt="">
                </div>
            </div>
            <hr>
        </main>
        <footer>
            © 2023 – 2412 «Галактический вестник»
        </footer>
    </body>
</html>