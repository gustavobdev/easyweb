<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">

	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>Transdoni</title>
	<link href="<?= url("assets/css/app.css") ?>" rel="stylesheet" />
	<link href="<?= url("assets/css/datetimepicker.min.css") ?>" rel="stylesheet">
	<link href="<?= url("assets/css/all.css") ?>" rel="stylesheet" />


	<script src="<?= url("assets/landing/js/jquery.min.js") ?>"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
	<script src="<?= url("assets/js/app.js") ?>" defer></script>
	<script src="<?= url("assets/js/sweetalert.js") ?>"></script>
	<script src="<?= url("assets/js/bootstrap-bundle.js") ?>"></script>
	<script src="<?= url("assets/js/datetimepicker.full.min.js") ?>"></script>

</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar collapsed">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="">
					<span class="align-middle">CONSOLE TRANSDONI</span>
				</a>
				<ul class="sidebar-nav">
					<?= $this->insert("/fragments/sidebar"); ?>
			</div>
		</nav>
		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle d-flex">
					<i class="hamburger align-self-center"></i>
				</a>
				<form class="d-none d-sm-inline-block">
				</form>
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a  class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
								<?php if(isset($_SESSION["imgprofile"])):?>
								<img src="<?= url("{$_SESSION["imgprofile"]}")?>" class="avatar img-fluid rounded" alt="Charles Hall" />
									<?php else: ?>
										<span class="text-dark"><?= $_SESSION["nome"] . " " . $_SESSION["sobrenome"] ?></span>
										<?php endif; ?>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="<?= url("console/perfil")?>"><i class="align-middle mr-1" data-feather="user"></i> Perfil</a>
								<a class="dropdown-item" href="<?= url("console/")?>"><i class="align-middle mr-1" data-feather="pie-chart"></i> Dashboard</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?= url("logout") ?>">Sair</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
			<main class="content">
				<?= $this->section("content"); 
				?>

			</main>
			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-left">
							<p class="mb-0">
								<a href="https://www.softgbs.com.br" class="text-muted"><strong>GBS ©</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-right">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="#">Suporte</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Privacidade</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Termos de uso</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>


</body>

</html>

<?= $this->section('scripts') ?>

<?php

use CoffeeCode\Router\Router;

if (!isset($_SESSION)) // if the session is no  set then start to
{
	session_start();
}
$router = new Router(URL_BASE);
if ($_SESSION["nome"]) {
} else {
	$router->redirect("/login");
}
$url = URL_BASE;


?>