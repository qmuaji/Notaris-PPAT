<?php
require 'core/init.php'; 
include 'includes/_header.php' ?>

<section id="main" class="container">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});
</script>
	<header>
		<h2>Informasi Layanan</h2>
		<p>Kantor Notaris & PPAT Rian Erza, S.H.,M.Kn.</p>
	</header>
	<div class="row" >
		<div class="col-12">
			<section class="box">
				<div class="col-6 col-12-mobilep">
					<ul class="actions">
						<li><a href="#pendirian" class="button special fit" style="background-color: #2167C7">AKTA PENDIRIAN</a></li>
						<li><a href="#perjanjian_sewa" class="button special fit"style="background-color: green">AKTA PERJANJIAN SEWA</a></li>
						<li><a href="#perjanjian_hutang" class="button special fit" style="background-color: #B3B30E">PERJANJIAN PERNIKAHAN</a></li>
						<li><a href="#pendirian_cv" class="button special fit" style="background-color: #C68713">AKTA PENDIRIAN CV</a></li>
						<li><a href="#perjanjian_jualbeli" class="button special fit" style="background-color: #277171">AKTA PERJANJIAN JUAL BELI</a></li>
						<li><a href="#akta_kuasa" class="button special fit" style="background-color: #BA2323">WASIAT</a></li>
						<li><a href="#perubahan" class="button special fit" style="background-color: #BC1DBC">AKTA PERUBAHAN PT DAN CV</a></li>
						<li><a href="#kesepakatan" class="button special fit" style="background-color: #64BD8A">AKTA KESEPAKATAN BERSAMA</a></li>
						<li><a href="#pendirian" class="button special fit" style="background-color: #BC1DBC">AKTA PENDIRIAN KOPERASI</a></li>
						<li><a href="#pendirian_yayasan" class="button special fit"style="background-color: #BC1DBC">AKTA PENDIRIAN YAYASAN</a></li>
						<li><a href="#perjanjian_hutang" class="button special fit"style="background-color: #BC1DBC">PERJANJIAN HUTANG</a></li>
						<li><a href="#perkumpulan" class="button special fit"style="background-color: #BC1DBC">PENDIRIAN PERKUMPULAN</a></li>
						<li id="pendirian"><a href="#akta_kuasa" class="button special fit"style="background-color: #BC1DBC">AKTA KUASA</a></li>
					</ul>
					<div class="container">
						<div class="col-6 col-12-mobilep">
							<h4><b>a.	Syarat-Syarat Pembuatan Akta Pendirian PT</b></h4>
							<ol>
								<li>KTP Penghadap (Jika Dikuasakan)</li>
								<li>KTP dan NPWP Direktur dan Komisaris</li>
								<li>Surat Kuasa</li>
								<li>Notulen Rapat yang berisikan Nama Perseroan, Alamat Perseroan, Susunan organisasi, jumlah modal dasar, modal ditempatkan, Pembagian Saham, Kegiatan Usaha dan Tahun Buku Usaha, email perusahaan, Nomor telepon perusahaan, Nomor telp dan email pribadi.</li>
								<li id="pendirian_cv">Surat Pernyataan keterangan domisili tempat usaha.</li>
								<li>Surat keterangan penyetoran modal.</li>
							</ol>							
							<h4><b>b.	Syarat-syarat Pembutan Akta Pendirian CV</b></h4>
							<ol>
								<li>KTP Penghadap (Jika Dikuasakan)</li>	
								<li>KTP dan NPWP Sekutu Aktif dan Sekutu Pasif</li>	
								<li>Surat Kuasa</li>	
								<li>Notulen Rapat yang berisikan Nama Perseroan, Alamat Perseroan, Susunan organisasi, jumlah modal dasar,Pembagian Saham, Kegiatan Usaha dan Tahun Buku Usaha, email perusahaan, Nomor telepon perusahaan, Nomor telp dan email pribadi.</li>	
								<li id="pendirian_yayasan">Surat Pernyataan keterangan domisili tempat usaha.</li>	
								<li>Surat keterangan penyetoran modal.</li>	
							</ol>
							<h4><b>c.	Syarat-Syarat Pembuatan Akta Yayasan</b></h4>
							<ol>
								<li>KTP Penghadap (Jika Dikuasakan)</li>
								<li>KTP dan NPWP Pengurus</li>
								<li>Surat Kuasa</li>
								<li id="perkumpulan">Notulen Rapat yang berisikan nama Yayasan, alamat Yayasan, kekayaan awal Yayasan, tujuan Yayasan, kegiatan Yayasan, susunan pengurus, pengawas dan pembina Yayasan, email dan nomor telepn Yayasan.</li>
								<li>Surat Pernyataan keterangan domisili tempat usaha.</li>
							</ol>
							<h4><b>d.	Syarat-Syarat Pembuatan Akta Pendirian Perkumpulan</b></h4>
							<ol>
								<li>KTP Penghadap (Jika Dikuasakan)</li>
								<li>KTP dan NPWP Pengurus</li>
								<li>Surat Kuasa</li>
								<li id="perubahan">Notulen Rapat yang berisikan Nama Pekumpulan, Alamat Perkumpulan, Kegiatan Perkumpulan, Kekayaan Perkumpulan, Susunan Organisasi, Nomor Telepon dan Alamat Email Pengurus Perkumpulan.</li>
								<li>Surat Pernyataan keterangan domisili tempat usaha.</li>
							</ol>
							<h4><b>e.	Syarat-Syarat Pembuatan Akta Perubahan PT CV YAYASAN</b></h4>
							<ol>
								<li>Ktp Penghadap</li>
								<li>Cicular Pemegang saham atau notulen rapat Pengurus</li>
								<li>KTP dan NPWP direksi, komisari atau pengurus</li>
								<li>Anggaran dasar Perusahaan atau Yayasan</li>
								<li id="perjanjian_sewa">SK Kemnehumkam</li>
								<li>NPWP Perseroan</li>
							</ol>
						</div>
						<div class="col-6 col-12-mobilep">
							<h4><b>f.	Syarat-Syarat Pembuatan Akta Perjanjian Sewa Menyewa</b></h4>
							<ol>
								<li>KTP Pihak Pertama</li>
								<li>KTP Pihak Kedua</li>
								<li id="perjanjian_jualbeli">Surat yang menyatakan kepemilikan barang sewa (missal, jika bangunan maka harus dilampirkan sertifikat)</li>
								<li>Draft Perjanjian Sewa Menyewa</li>
							</ol>	
							<h4><b>g.	Syarat-Syarat Pembuatan Akta Perjanjian Jual Beli</b></h>			
							<ol>
								<li>KTP Pihak Pertama</li>
								<li>KTP Pihak Kedua</li>
								<li id="kesepakatan">Surat yang menyatakan kepemilikan barang yang dijual belikan (misal, jika bangunan maka harus dilampirkan sertifikat)</li>
								<li>Draft Perjanjian Jual Beli</li>
							</ol>	
							<h4><b>h.	Syarat-Syarat Pembuatan Akta Kesepakatan Bersama</b></h4>
							<ol>
								<li>KTP Pihak Pertama</li>
								<li>KTP Pihak Kedua</li>
								<li id="perjanjianHutang">Draft Perjanjian Kesepakatan Bersama</li>
								<li>Dokumen pendukung lainnya</li>
							</ol>
							<h4><b>i.	Syarat-Syarat Pembuatan Akta Perjanjian Hutang</b></h4>
							<ol>
								<li>KTP Pihak Pertama</li>
								<li>KTP Pihak Kedua</li>
								<li id="akta_kuasa">Draft Perjanjian Hutang</li>
								<li>Dokumen pendukung lainnya</li>
							</ol>
							<h4><b>j.	Syarat-Syarat Pembuatan Akta Kuasa</b></h4>
							<ol>
								<li>KTP Pemberi Kuasa</li>
								<li>KTP Penerima Kuasa</li>
								<li>Draft Kuasa </li>
								<li>Dokumen pendukung lainnya</li>
							</ol>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</section>

<?php include 'includes/_footer.php' ;