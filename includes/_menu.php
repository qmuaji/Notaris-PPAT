
	<h1><a href="./">Notaris PPAT </a> Rian Erza</h1>
	<div class="container">
		<nav id="nav">
			<ul>
				<li><a href="profilUsaha.php">Profil Usaha</a></li>
				<li><a href="informasiLayanan.php">Informasi Layanan</a></li>
				<li><a href="alurTransaksi.php">Alur Transaksi Akta</a></li>
				<li> | </li>
		<?php 
		if(loggedIn()) {
			if(hasAccess($_SESSION['user_id'], 1)) {
				?>
				<li><a href="#">Pengajuan Akta <span class="icon fa-angle-down"></span></a>
					<ul>
						<li><a href="pengajuanAkta.php">Formulir Pengajuan Akta</a></li>		
						<li><a href="pengajuanSaya.php">Pengajuan Saya</a></li>		
					</ul>
				</li>
				<li> | </li>
					<?php 
			}

			if(hasAccess($_SESSION['user_id'], 2)) {
			?>
			<li><a href="listPengajuanAkta.php">List Pengajuan Akta</a></li>						
			<li> | </li>
			<?php
			} 

			if(hasAccess($_SESSION['user_id'], 3)) {
					?>
					<li><a href="#">Laporan <span class="icon fa-angle-down"></span></a>
						<ul>
							<li><a href="laporanTransaksiAkta.php">Laporan Transaksi Akta</a></li>
						</ul>
					</li>
					<li> | </li>
			<?php
			}
			?>
					<li><a href="#" class="button"><i class="icon fa-user"></i> <?php if(hasAccess($_SESSION['user_id'], 2)) echo "Admin"; if(hasAccess($_SESSION['user_id'], 3)) echo "Pemilik"?> <span class="icon fa-angle-down"></span></a>
						<ul>
							<li><a href="informasiAkun.php"> &nbsp;<?= $userData['Email'] ?></a></li>
							<li><a href="gantiPassword.php" class="icon fa-cog"> &nbsp; Ganti Password</a></li>
							<li><a href="logout.php" class="icon fa-sign-out"> &nbsp; Log Out</a></li>
						</ul>
					</li>
		<?php 
		} else {
				?>
				<li><a href="login.php">Log In</a></li>
				<li><a href="signup.php" class="button special">DAFTAR</a></li>
				<?php 
		}
			?>
			</ul>
		</nav>
	<?php if(loggedIn()) echo '</div>' ?>
</header>
