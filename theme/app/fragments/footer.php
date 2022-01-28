<?php $url = URL_BASE; 
 if(!isset($page)){
     $page = null;
 }
?>

<a href="<?= $url ?>app" class="item" <?= $page == 'home' ? 'style="background-color:#ededed;"' : ''; ?>>
    <div class="col">
        <ion-icon name="briefcase-outline" <?= $page == 'home' ? 'style="color:#ff7700;"' : ''; ?>></ion-icon>
        <strong <?= $page == 'home' ? 'style="color:#ff7700;"' : ''; ?>>Carteira</strong>
    </div>
</a>
<a href="<?= $url ?>app/fretes" class="item" <?= $page == 'publicados' ? 'style="background-color:#ededed;"' : ''; ?>>
    <div class="col">
        <ion-icon name="document-text-outline" <?= $page == 'publicados' ? 'style="color:#ff7700;"' : ''; ?>></ion-icon>
        <strong <?= $page == 'publicados' ? 'style="color:#ff7700;"' : ''; ?>>Fretes publicados</strong>
    </div>
</a>
<a href="<?= $url ?>app/fretes/aprovados" class="item" <?= $page == 'meusfretes' ? 'style="background-color:#ededed;"' : ''; ?>>
    <div class="col">
        <ion-icon name="document-text-outline" <?= $page == 'meusfretes' ? 'style="color:#ff7700;"' : ''; ?>></ion-icon>
        <strong <?= $page == 'meusfretes' ? 'style="color:#ff7700;"' : ''; ?>>Meus fretes</strong>
    </div>
</a>
<a href="<?= $url ?>app/perfil" class="item" <?= $page == 'perfil' ? 'style="background-color:#ededed;"' : ''; ?>>
    <div class="col">
        <ion-icon name="apps-outline" <?= $page == 'perfil' ? 'style="color:#ff7700;"' : ''; ?>></ion-icon>
        <strong <?= $page == 'perfil' ? 'style="color:#ff7700;"' : ''; ?>>Perfil</strong>
    </div>
</a>