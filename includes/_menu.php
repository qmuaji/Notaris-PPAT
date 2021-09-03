
	<h1><a href="./">Notaris PPAT </a> Rian Erza</h1>
	<div class="container">
		<nav id="nav">
			<ul>
				<li><a href="#">Profil Usaha</a></li>
				<li><a href="#">Informasi Layanan</a></li>
				<li><a href="#">Alur Transaksi Akta</a></li>
				<li> | </li>
		<?php 
		if(loggedIn()) {
			if(hasAccess($_SESSION['user_id'], 1)) {
				?>
				<li><a href="#">Pengajuan Akta <span class="icon fa-angle-down"></span></a>
					<ul>
						<li><a href="formulirTransaksi.php">Formulir</a></li>		
						<li><a href="penyewaan.php">Pengajuan Saya</a></li>		
						<li><a href="konfirmasi.php">Konfirmasi Bayar</a></li>		
					</ul>
				</li>
				<li> | </li>
					<?php 
			}

			if(hasAccess($_SESSION['user_id'], 2)) {
					?>
					<li><a href="#">Konfirmasi <span class="icon fa-angle-down"></span></a>
						<ul>
							<li><a href="a_konfirm2.php">Konfirmasi Transaksi Akta</a></li>		
						</ul>
					</li>
					<li><a href="#">List Data <span class="icon fa-angle-down"></span></a>
						<ul>
							<li><a href="a_studios.php">Data Akta</a></li>
							<li><a href="a_equips.php">Data Transaki Keuangan</a></li>
							<li><a href="a_usersData.php">Data Penghadap</a></li>
						</ul>
					</li>
					<li> | </li>
			<?php
			} 

			if(hasAccess($_SESSION['user_id'], 3)) {
					?>
					<li><a href="#">Laporan <span class="icon fa-angle-down"></span></a>
						<ul>
							<li><a href="a_studios.php">laporan Akta</a></li>	
							<li><a href="a_laptrans.php">Laporan Transaksi Keuangan</a></li>
						</ul>
					</li>
					<li> | </li>
			<?php
			}
			?>
					<li><a href="#" class="button"><i class="icon fa-user"></i> <?php if(hasAccess($_SESSION['user_id'], 2)) echo "Admin"; if(hasAccess($_SESSION['user_id'], 3)) echo "Pemilik"?> <span class="icon fa-angle-down"></span></a>
						<ul>
							<li><a href="userSettings.php"> &nbsp;<?= $userData['Email'] ?></a></li>
							<li><a href="gantiPass.php" class="icon fa-cog"> &nbsp;Ganti Password</a></li>
							<li><a href="logout.php" class="icon fa-sign-out"> &nbsp;Log Out</a></li>
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
