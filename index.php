<?php 
require 'core/init.php';
include 'includes/_head.php';

?>
<body class="landing">
	<header id="header" class="alt"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<?php 
	include 'includes/_menu.php';
	if(loggedIn()) {
		if(hasAccess($_SESSION['user_id'], 2) || hasAccess($_SESSION['user_id'], 3)) {
		?>
			<section id="banner" style="margin-top:-80px">
				<div class="container">
		
		
					<div class="box special">							
						<?php include"a_graf_pel.php" ?>
					</div>					

					<div class="box special">							
						<?php include"a_graf_trans.php" ?>
					</div>					
			
			
				</div>
			</section>
		</header>	
		</body>	
			<?php

			include 'includes/_footer.php';	
			exit();
		}
	}
	?>
	
		<section id="banner">
			<h2>Pengelolaan Transaksi Akta <br><i class="icon fa-book"></i></h2>
	<div id="page-wrapper">

		<?php
		if(loggedIn()) {
			?>
			<h4>Hi, <?= (empty($userData['NamaLengkap'])) ? "Selamat Datang.." : $userData['NamaLengkap'];  ?></h4>
			<?php 
			if(hasAccess($_SESSION['user_id'], 2)) {
			?>
			
			<ul class="actions">
				<li><a href="<?php if(!empty($userData['Username'])) echo $userData['Username']; else echo $userData['Email'] ?>" class="button icon fa-user">Profil</a></li>
				<li><a href="penyewaan.php" class="button icon fa-caret-right">My Reservation</a></li>
			</ul>
			<?php
			}
		} else {
			?>
			<h5>Kantor Notaris & PPAT Rian Erza, SH. M.Kn</h5>
			<ul class="actions">
				<li><a href="signup.php" class="button special">Daftar</a></li>
				<li><a href="login.php" class="button">Log In</a></li>
			</ul>
			<?php
		}
		?>
		</section>

		
<?php
include 'includes/_footer.php';	