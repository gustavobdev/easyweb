<?php 
if(!isset($_SESSION)){
    session_start();
}
?>
<!--Marcador-->
<li class="sidebar-header">
    Admin
</li>

<li class="sidebar-item">
    <a class="sidebar-link" href="<?= url("console") ?>">
        <i class="align-middle" data-feather="layout"></i> <span class="align-middle">Dashboard</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link" href="<?= url("console/fretes") ?>">
        <i class="align-middle" data-feather="activity"></i> <span class="align-middle">Fretes</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link" href="<?= url("console/fretespdf") ?>">
        <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Relatório de Fretes</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link" href="<?= url("console/motoristas") ?>">
        <i class="align-middle" data-feather="truck"></i> <span class="align-middle">Caminhoneiros</span>
    </a>
</li>


<li class="sidebar-item">
    <a class="sidebar-link" href="<?= url("console/multas") ?>">
        <i class="align-middle" data-feather="book-open"></i> <span class="align-middle">Gestão de Multas</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link" href="<?= url("console/clientes") ?>">
        <i class="align-middle" data-feather="users"></i> <span class="align-middle">Clientes</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link" href="<?= url("console/members") ?>">
        <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Membros da equipe</span>
    </a>
</li>


<?php if($_SESSION["nl_acesso"] === "3"): ?>
<li class="sidebar-item">
    <a class="sidebar-link" href="<?= url("console/financeiro") ?>">
        <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Financeiro</span>
    </a>
</li>
<?php endif; ?>
<li class="sidebar-item">
    <a href="#criar" data-toggle="collapse" class="sidebar-link collapsed">
        <i class="align-middle" data-feather="plus-circle"></i> <span class="align-middle">Novo</span>
    </a>
    <ul id="criar" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
        <?php if($_SESSION["nl_acesso"] === "1"): ?>
        <li class="sidebar-item"><a class="sidebar-link"  href="<?= url("console/cria/usuario") ?>">Usuário</a></li>
        <li class="sidebar-item"><a class="sidebar-link" href="<?= url("console/cria/motorista") ?>">Caminhoneiro</a></li>
        <li class="sidebar-item"><a class="sidebar-link" href="<?= url("console/cria/cliente") ?>">Cliente</a></li>
        <li class="sidebar-item"><a class="sidebar-link" href="<?= url("console/cria/caminhao") ?>">Caminhão e Cavalo</a></li>
        <?php endif; ?>
        <li class="sidebar-item"><a class="sidebar-link" href="<?= url("console/cria/frete") ?>">Frete</a></li>
        <?php if($_SESSION["nl_acesso"] === "3" || $_SESSION["nl_acesso"] === "1"): ?>
        <li class="sidebar-item"><a class="sidebar-link" href="<?= url("console/cria/usuario") ?>">Pagamento</a></li>
        <?php endif; ?>
    </ul>
</li>

</ul>

<div class="sidebar-cta">
    <div class="sidebar-cta-content">
        <strong class="d-inline-block mb-2">Novo Frete</strong>
        <div class="mb-3 text-sm">
            Use este atalho para criar um novo frete
        </div>
        <a href="<?= url("console/cria/frete")?>" class="btn btn-primary btn-block">Criar agora</a>
    </div>
</div>

