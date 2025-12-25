<?php
require_once 'config.php';

$perPage = 4;
$currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($currentPage - 1) * $perPage;

$countStmt = $pdo->query("SELECT COUNT(*) FROM news");
$totalNews = $countStmt->fetchColumn();
$totalPages = ceil($totalNews / $perPage);

if ($currentPage > $totalPages && $totalPages > 0) {
    $currentPage = $totalPages;
    $offset = ($currentPage - 1) * $perPage;
}

$stmt = $pdo->prepare("SELECT * FROM news ORDER BY date DESC LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$news = $stmt->fetchAll(PDO::FETCH_ASSOC);

$mainNews = !empty($news) ? $news[0] : null;
?>

<!DOCTYPE html>
<html>
  
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
        
        <?php if($currentPage == 1 && $index == 0): ?>
        <!-- Только первая новость на первой странице имеет рабочую кнопку -->
        <a href="news.php?id=<?php echo $item['id']; ?>" class="moreDetails-btn">
            ПОДРОБНЕЕ <img src="images/icons/whiteArrow.png" alt="">
        </a>
        <?php else: ?>
        
        <span class="moreDetails-btn disabled">
            ПОДРОБНЕЕ <img src="images/icons/arrow.png" alt="">
        </span>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>
                
               <div class="pageScroll">
    <?php if($currentPage > 1): ?>
    <a href="?page=<?php echo $currentPage-1; ?>" class="pageScrollItem arrow-btn left-arrow">
        <img src="images/icons/reversArrow.png" alt="">
    </a>
    <?php endif; ?>
    
    <?php for($page = 1; $page <= $totalPages; $page++): ?>
    <?php if($page == $currentPage): ?>
    <span class="pageScrollItem page-number active"><?php echo $page; ?></span>
    <?php else: ?>
    <a href="?page=<?php echo $page; ?>" class="pageScrollItem page-number">
        <?php echo $page; ?>
    </a>
    <?php endif; ?>
    <?php endfor; ?>
    
    <?php if($currentPage < $totalPages): ?>
    <a href="?page=<?php echo $currentPage+1; ?>" class="pageScrollItem arrow-btn right-arrow">
        <img src="images/icons/arrow.png" alt="">
    </a>
    <?php endif; ?>
</div>
                <hr>
            </div>
        </main>
        <footer>
            © 2412 «Галактический вестник»
        </footer>
    </body>
</html>
