
<!-- require_once "./model/Model.php"; -->

<header>
    <img id="grinch" src="../img/grinch.webp"; alt="grinch">
    <h2>Secret Grinch</h2>
    <nav>
            <a href="../php/index.php">Главная Страница</a>
            <?php 
            if (isset($_SESSION['auth'])) {
                ?> 
                <a href="../php/usr_page.php">Моя Страница</a>
               <?php  
               ?> 
               <a href="../php/box.php">Создать Коробку</a>
              <?php  
            }
            else {
                ?>
                <a href="../php/choice.php">Вход/регистрация</a>
                <?php
                
            } ?>
            
        </nav>
    </header>