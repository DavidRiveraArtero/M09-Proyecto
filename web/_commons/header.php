
<header class='header'>
    <nav>
        <img class='header__logo' src='_commons/img/icon.png'/>
        <!-- SE A MOVIDO EL TITULO PARA HACER EL FLEX -->
        <label class='header__Titulo titulo'>Projecte J-Suite</label>
        <img class='header__user' src='_commons/img/icon.png'/>
    </nav>
    <?php $flash = My\Helpers::flash(); ?>
    <?php if(!empty($flash)): ?>

    <div class='flash'>
        <ul>
            <?php foreach($flash as $msg): ?>
            <li class="flash__message"><?= $msg ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <!--<div class='header__imagen'>
        <img src='_commons/img/icon.png'/>
    </div>

    <div>
        <h2 class='header__Titulo'>Projecte J-Suite</h2>
    </div>
    -->
    
</header>