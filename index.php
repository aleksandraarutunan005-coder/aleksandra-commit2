<?php

require_once 'config.php';


$stmt = $pdo->query("SELECT * FROM news ORDER BY date DESC");
$news = $stmt->fetchAll(PDO::FETCH_ASSOC);


$mainNews = !empty($news) ? $news[0] : null;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Галактический Вестник</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <img src="images/icons/logo 1.png" alt="лого">
            <p>ГАЛАКТИЧЕСКИЙ<br>ВЕСТНИК</p>
        </header>
        <main>
            <?php if($mainNews): ?>
            <div class="bgimg" style="background-image: url(images/<?php echo htmlspecialchars($mainNews['image']); ?>)">
                <h1><?php echo htmlspecialchars($mainNews['title']); ?></h1>
                <p><?php echo strip_tags($mainNews['announce']); ?></p>
            </div>
            <?php endif; ?>
            
            <h1 id="newsH1">Новости</h1>
            <div class="news">
                <div class="grid">
                    <?php foreach($news as $index => $item): ?>
                    <div class="new">
                        <p class="date"><?php echo date('d.m.Y', strtotime($item['date'])); ?></p>
                        <h2><?php echo htmlspecialchars($item['title']); ?></h2>
                        <p><?php echo strip_tags($item['announce']); ?></p>
                        <a href="news.php?id=<?php echo $item['id']; ?>" class="moreDetails-btn">
                            ПОДРОБНЕЕ <img src="images/icons/<?php echo $index == 0 ? 'whiteArrow.png' : 'arrow.png'; ?>" alt="">
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="pageScroll">
                    <span class="pageScrollItem">1</span>
                    <span class="pageScrollItem">2</span>
                    <span class="pageScrollItem">3</span>
                    <span class="pageScrollItem"><img src="images/icons/arrow.png" alt=""></span>
                </div>
                <hr>
            </div>
        </main>
        <footer>
            © 2023 – 2412 «Галактический вестник»
        </footer>
    </body>
</html>