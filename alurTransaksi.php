<?php
require 'core/init.php'; 
include 'includes/_header.php' ?>

<section id="main" class="container">
	<header>
		<h2>Alur Transaksi</h2>
		<p>Kantor Notaris & PPAT Rian Erza, S.H.,M.Kn.</p>
	</header>
	<div class="box">
		<p>		<b>Penghadap</b> mengisi formulir dan meng-upload dokumen persyaratan ke website kantor. Data yang di-upload akan langsung masuk ke database. Database akan melakukan validasi kelengkapan data, jika data yang di-input belum lengkap, maka sistem akan menolak mengeluarkan output. Jika dokumen persyaratan sudah lengkap maka database akan menyimpan formulir pengajuan dan data persyaratan yang kemudian akan diteruskan ke pembuat akta untuk dilakukan pengecekan data. Jika data yang telah di cek sudah sesuai, lengkap dan valid maka pembuat akta akan mulai melakukan pengerjaan akta. </p>
		<p>		Pengerjaan akta ini akan menghasilkan minuta akta yang akan diperiksa secara manual oleh pembuat akta bersama notaris.Jika akta telah sesuai maka akan diterukan kepada <b>Notaris</b> untuk dilakukan akad bersama penghadap. Setelah akad selesai dilaksanakan, maka <b>Notaris</b> akan menginput isi akta tersebut ke dalam website Administrasi Hukum Umum dan output berupa (softcopy) SK dan Salinan Akta akan diserahkan kepada pembuat akta  untuk di cetak sementara minuta akta diarsip.</p>
		<p>		<b>Pembuat akta</b> akan mencetak salinan akta dan SK untuk diserahkan kepada penghadap. Sistem akan menginformasikan kepada penghadap bahwa akta telah selesai di buatkan Salinan. Penghadap melakukan pembayaran ke bagian administrasi. Jika pembayaran dilakukan secara lunas, maka bagian administrasi akan membuatkan tanda terima dokumen dan menyerahkan dokumen Salinan akta Bersama kwitansi rangkap pertama. Jika belum lunas, maka bagian administrasi hanya mencetak kwitansi saja.</p>
		<p>		<b>Pembuat akta</b> akan mencetak salinan akta dan SK untuk diserahkan kepada penghadap. Sistem akan menginformasikan kepada penghadap bahwa akta telah selesai di buatkan Salinan. Penghadap melakukan pembayaran ke bagian administrasi. Jika pembayaran dilakukan secara lunas, maka bagian administrasi akan membuatkan tanda terima dokumen dan menyerahkan dokumen Salinan akta Bersama kwitansi rangkap pertama. Jika belum lunas, maka bagian administrasi hanya mencetak kwitansi saja.</p>
	</div>
</section>

<?php include 'includes/_footer.php' ;
