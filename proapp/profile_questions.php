<?php 

session_start();

?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			Jawab Semua Soalan | ProApp
		</title>
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" type="text/css" href="css/proapp_style.css">
		<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
		<style>
			select {
				width:100px;
			}
      #result_show {
        background-image: url('img/result.png');
        background-repeat: no-repeat;
      }
      table#score {
          font-size: 40px;
      }
		</style>
	</head>
	<body>
    <?php include 'header-sc.php'; ?>
		<div id="wrapper_app" class="ui-window">

			<div id="main_test_container">
        <div>
          <a href="#" id="top"></a>
          <h4>Menganduni 4 Soalan</h4>
          <ul>
            <li><a href="#section1">Bahagian 1: DMSP</a></li>
            <li><a href="#section2">Bahagian 2: FNTP</a></li>
            <li><a href="#section3">Bahagian 3: DLB</a></li>
            <li><a href="#section4">Bahagian 4: TKBA</a></li>
          </ul>
        </div>
			<div>
        <a href="#" id="section1"></a>
				<p><img src="img/sec1.png" alt="sec1" border="0"></p>
				<p>
					<span class="label label-important">Arahan:</span> Baca soalan dan pilihan jawapan secara melintang dari kiri dan kanan. Kemudian, pilih jawapan untuk setiap 15 soalan berkaitan tingkah laku anda di sekolah atau di tempat kerja. Untuk penyataan yang paling banyak menggambarkan diri anda, sila pilih 4. Jika penyataan itu selalunya menggambarkan diri anda, sila pilih 3. Jika penyataan itu kadang-kadang menggambarkan diri anda, sila pilih 2. Dan jika penyataan itu tidak sesuai menggambarkan diri anda, sila pilih 1.</p>
			</div>
			<div>
				<table border="1" cellpadding="1" cellspacing="1" width="100%" class="table table-bordered table-striped table-hover">
            <tbody>
                <tr height="13">
                    <th height="13" width="10">
                        No
                    </th>
                    <th width="500">
                        Soalan
                    </th>
                    <th width="288">
                        A
                    </th>
                    <th width="279">
                        B
                    </th>
                    <th width="278">
                        C
                    </th>
                    <th width="327">
                        D
                    </th>
                </tr>
                <tr>
    <td>1</td>
    <td>Saya selalunya...</td>
    <td>Pentingkan hasil &amp; keputusan</td>
    <td>Pentingkan hubungan dengan orang lain</td>
    <td>Pentingkan proses dan kerja berkumpulan</td>
    <td>Pentingkan ketelitian bila membuat sesuatu</td>
  </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC1col1" id="rowAPSC1col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC1col2" id="rowAPSC1col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC1col3" id="rowAPSC1col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC1col4" id="rowAPSC1col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
    <td align="right">2</td>
    <td>Bagi saya, masa selalunya...</td>
    <td>Tidak cukup</td>
    <td>Tidak begitu penting dan lebih gemar bersosial</td>
    <td>Sesuatu yang saya hormati tetapi tidak tertekan disebabkannya</td>
    <td>Amat berharga bagi saya dan saya menguruskan masa saya dengan baik</td>
  </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC2col1" id="rowAPSC2col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC2col2" id="rowAPSC2col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC2col3" id="rowAPSC2col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC2col4" id="rowAPSC2col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
    <td align="right">3</td>
    <td>Saya suka berpakaian...</td>
    <td>Formal</td>
    <td>Bebas</td>
    <td>Mengikut kesesuaian majlis/tempat/acara</td>
    <td>Apa yang biasa saya pakai</td>
  </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC3col1" id="rowAPSC3col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC3col2" id="rowAPSC3col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC3col3" id="rowAPSC3col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC3col4" id="rowAPSC3col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
    <td align="right">4</td>
    <td>Bila bercakap dengan orang, saya suka bercakap mengenai...</td>
    <td>Pencapaian saya</td>
    <td>Diri saya dan orang lain</td>
    <td>Keluarga dan rakan-rakan</td>
    <td>Benda,nombor,sistem atau organisasi</td>
  </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC4col1" id="rowAPSC4col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC4col2" id="rowAPSC4col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC4col3" id="rowAPSC4col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC4col4" id="rowAPSC4col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
    <td align="right">5</td>
    <td>Saya suka persekitaran yang dipenuhi...</td>
    <td>Pencapaian diri, anugerah, dan pentingkan pencapaian matlamat</td>
    <td>Gambar, lukisan, potret, dokumen dan barangan kepunyaan saya</td>
    <td>Cenderamata, cenderahati dan hadiah</td>
    <td>Keadaan/benda yang tersusun, cekap dan rapi</td>
  </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC5col1" id="rowAPSC5col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC5col2" id="rowAPSC5col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC5col3" id="rowAPSC5col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC5col4" id="rowAPSC5col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
    <td align="right">6</td>
    <td>Biasanya, saya menjawab pertanyaan orang dengan...</td>
    <td>Terus terang dan tepat</td>
    <td>Penuh keramahan dan melayan orang lain dengan baik</td>
    <td>Nada yang tegas dan tersusun</td>
    <td>Nada yang relaks dan santai</td>
  </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC6col1" id="rowAPSC6col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC6col2" id="rowAPSC6col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC6col3" id="rowAPSC6col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC6col4" id="rowAPSC6col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
    <td align="right">7</td>
    <td>Dalam hubungan, saya cenderung untuk...</td>
    <td>Mengarah orang lain</td>
    <td>Mempengaruhi orang lain</td>
    <td>Menghormati orang lain</td>
    <td>Menilai orang lain</td>
  </tr
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC7col1" id="rowAPSC7col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC7col2" id="rowAPSC7col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC7col3" id="rowAPSC7col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC7col4" id="rowAPSC7col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
    <td align="right">8</td>
    <td>Tingkah laku saya biasanya...</td>
    <td>Mengarah, berwawasan dan berinovasi</td>
    <td>Asli, bergaya, kreatif, ramah</td>
    <td>Menghormati dan berfikiran terbuka</td>
    <td>Menilai dan melihat</td>
  </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC8col1" id="rowAPSC8col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC8col2" id="rowAPSC8col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC8col3" id="rowAPSC8col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC8col4" id="rowAPSC8col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
    <td align="right">9</td>
    <td>Isyarat yang saya biasa tunjukkan biasanya...</td>
    <td>Lantang, cepat, kuat</td>
    <td>Terbuka dan ramah</td>
    <td>Berhati-hati dan dalam jangkaan saya</td>
    <td>Terkawal dan tersusun</td>
  </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC9col1" id="rowAPSC9col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC9col2" id="rowAPSC9col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC9col3" id="rowAPSC9col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC9col4" id="rowAPSC9col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
    <td align="right">10</td>
    <td>Intonasi suara saya ketika bercakap biasanya...</td>
    <td>Penuh emosi dan tepat</td>
    <td>Penuh emosi dan nada suara yang bersemangat</td>
    <td>Kurang emosi dan nada suara yang rendah</td>
    <td>Tidak beremosi dan mengawal nada suara</td>
  </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC10col1" id="rowAPSC10col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC10col2" id="rowAPSC10col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC10col3" id="rowAPSC10col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC10col4" id="rowAPSC10col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
    <td align="right">11</td>
    <td>Personaliti saya adalah...</td>
    <td>Mengarah dan menyuruh</td>
    <td>Ramah dan suka berkomunikasi</td>
    <td>Tenang dan relaks</td>
    <td>Ikhlas dan tepat</td>
  </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC11col1" id="rowAPSC11col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC11col2" id="rowAPSC11col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC11col3" id="rowAPSC11col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC11col4" id="rowAPSC11col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
    <td align="right">12</td>
    <td>Fokus percakapan saya lebih tertumpu kepada...</td>
    <td>Mencari jalan penyelesaian</td>
    <td>Cerita mengenai diri saya dan orang lain</td>
    <td>Apa dan bagaimana sesuatu itu telah/harus berlaku</td>
    <td>Data terperinci, nombor, jumplah, statistik dan maklumat</td>
  </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC12col1" id="rowAPSC12col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC12col2" id="rowAPSC12col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC12col3" id="rowAPSC12col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC12col4" id="rowAPSC12col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
    <td align="right">13</td>
    <td>Saya beranggapan kita harus menjalani...</td>
    <td>Hidup yang pantas dan cepat</td>
    <td>Hidup yang penuh bersemangat</td>
    <td>Hidup yang mantap</td>
    <td>Hidup yang tersusun, terkawal dan rapi</td>
  </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC13col1" id="rowAPSC13col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC13col2" id="rowAPSC13col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC13col3" id="rowAPSC13col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC13col4" id="rowAPSC13col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
    <td align="right">14</td>
    <td>Bila keputusan harus dibuat, selalunya ianya harus dibuat...</td>
    <td>Dengan cepat dan impulsif</td>
    <td>Seperti apa yang saya rasa ianya patut dibuat</td>
    <td>Dengan mengkaji dulu keadaan dan bertindak dengan berhati-hati</td>
    <td>Dengan mengumpul dulu maklumat dan data serta berpandukan objektif yang   ingin dicapai</td>
  </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC14col1" id="rowAPSC14col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC14col2" id="rowAPSC14col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC14col3" id="rowAPSC14col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC14col4" id="rowAPSC14col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
    <td align="right">15</td>
    <td>Bila mendengar orang bercakap, saya...</td>
    <td>Selalunya kurang bersabar dan ingin bercakap juga</td>
    <td>Biasanya mendapati saya menjadi tidak fokus setelah beberapa ketika</td>
    <td>Akan mendengar dengan penuh khusyuk dan minat</td>
    <td>Agak memilih dan hanya akan fokus kepada maklumat yang penting sahaja</td>
  </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC15col1" id="rowAPSC15col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC15col2" id="rowAPSC15col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC15col3" id="rowAPSC15col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC15col4" id="rowAPSC15col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr height="13">
                    <td>
                      &nbsp;
                    </td>
                    <td>
                      &nbsp;
                    </td>
                    <td>
                        <strong>Dominan</strong> <span id="allCol1" class="badge badge-info"></span>
                    </td>
                    <td>
                        <strong>Mempengaruh</strong> <span id="allCol2" class="badge badge-info"></span>
                    </td>
                    <td>
                        <strong>Stabil</strong> <span id="allCol3" class="badge badge-info"></span>
                    </td>
                    <td>
                        <strong>Patuh</strong> <span id="allCol4" class="badge badge-info"></span>
                    </td>
                </tr>
            </tbody>
        </table>


        <p>
          <form action="#" name="APSC_DATA" id="APSC_DATA">
            <input type="hidden" name="disc_D" id="allAPSCCol1" value="">
            <input type="hidden" name="disc_I" id="allAPSCCol2" value="">
            <input type="hidden" name="disc_S" id="allAPSCCol3" value="">
            <input type="hidden" name="disc_C" id="allAPSCCol4" value="">
            <input type="hidden" name="user_id_tester" value="<?php echo @$_SESSION['usr_id']; ?>">
          </form>
          <input type="button" name="getresult" id="getresult" value="Kira Markah DMSP" class="btn btn-success">
        </p>

			</div>
			<!-- #end_disc_question -->
			<hr>
			<div>
        <div>
          <table width="100%">
            <tr>
              <td width="50%"><a href="#" id="section2"></a></td>
              <td align="right"><a href="#top">kembali ke ATAS</a></td>
            </tr>
          </table>
        </div>
				<p><img src="img/sec2.png" alt="sec2" border="0"></p>
				<p>
          <span>
            Soalan-soalan di bawah bertujuan untuk mengkaji bagaimana minda anda berfungsi bila sesuatu keputusan harus dibuat, pelaksanaan projek, berkerja dengan orang lain, dan bagaimana reaksi anda di bawah tekanan kerja. Berdasarkan ciri-ciri biasa yang terkandung di bawah Cara Belajar, anda mampu mengenal pasti kecenderungan, kekuatan dan keunikan pemikiran anda.
          </span><br>
					<span class="label label-important">Arahan:</span> Bayangkan yang anda kini sedang belajar. Baca soalan dan pilihan jawapan secara melintang dari kiri dan kanan. Kemudian, pilih jawapan untuk setiap 15 soalan berkaitan tingkah laku anda di sekolah atau di tempat kerja. Untuk penyataan yang paling banyak menggambarkan diri anda, sila pilih 4. Jika penyataan itu selalunya menggambarkan diri anda, sila pilih 3. Jika penyataan itu kadang-kadang menggambarkan diri anda, sila pilih 2. Dan jika penyataan itu tidak sesuai menggambarkan diri anda, sila pilih 1.
				</p>
			</div>
      <div>
        <table border="1" cellpadding="1" cellspacing="1" width="100%" class="table table-bordered table-striped table-hover">
      <tbody>
        <tr>
          <th>
            No
          </th>
          <th>
            F
          </th>
          <th>
            N
          </th>
          <th>
            T
          </th>
          <th>
            P
          </th>
        </tr>
          <tr>
    <td align="right">1</td>
    <td>Saya suka bekerja di persekitaran yang bersih dan kemas di mana semuanya   teratur.</td>
    <td>Saya boleh bekerja baik walaupun persekitaran saya bersepah dan tidak   tersusun.</td>
    <td>Saya sebenarnya lebih selesa untuk bekerja di persekitaran yang tersusun   dan cekap.</td>
    <td>Bagi saya, persekitaran bekerja yang dapat memberi inspirasi kepada   kreativiti dan kebolehan saya adalah sangat penting.</td>
  </tr>
        <tr>
          <td>&nbsp;</td>
          <td><select name="rowLITE1col1" id="rowLITE1col1">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE1col2" id="rowLITE1col2">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE1col3" id="rowLITE1col3">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE1col4" id="rowLITE1col4">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
        </tr>
        <tr>
    <td align="right">2</td>
    <td>Saya dapat memberi yang terbaik bila dapat bekerja dengan orang lain yang   bertanggungjawab dan boleh diharap.</td>
    <td>Saya dapat memberi yang terbaik bila dapat bekerja dengan orang yang   ramah dan dapat mengekalkan keakraban semasa bekerja.</td>
    <td>Saya dapat memberi yang terbaik bila dapat bekerja dengan orang lain yang   mementingkan matlamat dan misi.</td>
    <td>Saya dapat memberi yang terbaik bila dapat orang lain dapat menyesuaikan   diri dengan perubahan yang saya bawa.</td>
  </tr>
        <tr>
          <td>&nbsp;</td>
          <td><select name="rowLITE2col1" id="rowLITE2col1">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE2col2" id="rowLITE2col2">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE2col3" id="rowLITE2col3">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE2col4" id="rowLITE2col4">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
        </tr>
        <tr>
    <td align="right">3</td>
    <td>Saya cepat belajar dengan mengikut panduan dan arahan.</td>
    <td>Saya cepat belajar perkara yang saya percaya dan rasakan.</td>
    <td>Saya cepat belajar perkara dengan mendengar, melihat dan membaca daripada   melakukan.</td>
    <td>Saya cepat belajar perkara jika dapat mengalami dan melakukannya.</td>
  </tr>
        <tr>
          <td>&nbsp;</td>
          <td><select name="rowLITE3col1" id="rowLITE3col1">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE3col2" id="rowLITE3col2">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE3col3" id="rowLITE3col3">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE3col4" id="rowLITE3col4">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
        </tr>
        <tr>
    <td align="right">4</td>
    <td>Saya akan memastikan yang saya tahu selok belok sesuatu kerja itu sebelum   membuat sebarang keputusan.</td>
    <td>I will ask for opinions before making a decision</td>
    <td>I will collect information first before making a decision</td>
    <td>I will act immediately when making a decision</td>
  </tr>
        <tr>
          <td>&nbsp;</td>
          <td><select name="rowLITE4col1" id="rowLITE4col1">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE4col2" id="rowLITE4col2">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE4col3" id="rowLITE4col3">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE4col4" id="rowLITE4col4">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
        </tr>
        <tr>
    <td align="right">5</td>
    <td>Saya lebih berminat dengan fakta yang jelas berbanding maksud di   sebaliknya.</td>
    <td>Saya lebih berminat dengan idea dan tema daripada fakta sebenar.</td>
    <td>Saya lebih berminat untuk mengetahui kesahihan dan integriti maklumat.</td>
    <td>Saya hanya berminat untuk mengetahui maklumat, fakta dan idea yang   penting sahaja.</td>
  </tr>
        <tr>
          <td>&nbsp;</td>
          <td><select name="rowLITE5col1" id="rowLITE5col1">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE5col2" id="rowLITE5col2">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE5col3" id="rowLITE5col3">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE5col4" id="rowLITE5col4">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
        </tr>
        <tr>
    <td align="right">6</td>
    <td>Saya suka mengikuti rutin yang sama dan biasa.</td>
    <td>Saya suka bekerja dengan orang lain bila membuat sesuatu tugasan atau   kerja.</td>
    <td>Saya lebih suka untuk diberikan masa yang sesuai untuk menyelesaikan   tugasan dengan terperinci.</td>
    <td>Saya lebih suka mencuba sesuatu yang baru bagi menyelesaikan masalah atau   tugasan.</td>
  </tr>
        <tr>
          <td>&nbsp;</td>
          <td><select name="rowLITE6col1" id="rowLITE6col1">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE6col2" id="rowLITE6col2">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE6col3" id="rowLITE6col3">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE6col4" id="rowLITE6col4">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
        </tr>
        <tr>
    <td align="right">7</td>
    <td>Saya akan berasa tertekan bila terlalu banyak kerja harus dibuat dan saya   masih lagi tidak mempunyai sebarang idea.</td>
    <td>Orang lain yang menyuruh saya agar lebih tersusun dalam membuat kerja   akan membuatkan saya rasa tertekan.</td>
    <td>Tergopoh-gopoh atau terpaksa bekerja mengejar waktu akan membuatkan saya   rasa tertekan.</td>
    <td>Objektif, sekatan dan jadual yang dipaksa ke atas saya akan membuatkan   saya rasa tertekan.</td>
  </tr>
        <tr>
          <td>&nbsp;</td>
          <td><select name="rowLITE7col1" id="rowLITE7col1">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE7col2" id="rowLITE7col2">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE7col3" id="rowLITE7col3">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE7col4" id="rowLITE7col4">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
        </tr>
        <tr>
    <td align="right">8</td>
    <td>Saya suka jika diberikan ganjaran untuk kerja yang telah saya lakukan   dengan cemerlang.</td>
    <td>Saya suka bila orang lain mengakui keupayaan dan kebolehan saya.</td>
    <td>Saya suka bila orang lain menghargai serta memuji kerja saya.</td>
    <td>Saya menghargai kebebasan yang diberikan kepada saya sewaktu membuat   keputusan di dalam projek.</td>
  </tr>
        <tr>
          <td>&nbsp;</td>
          <td><select name="rowLITE8col1" id="rowLITE8col1">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE8col2" id="rowLITE8col2">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE8col3" id="rowLITE8col3">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE8col4" id="rowLITE8col4">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="4">
            <form action="#" name="LITE_DATA" id="LITE_DATA">
              <input type="hidden" name="lite_L" id="allLiteDataCol1" value="">
              <input type="hidden" name="lite_I" id="allLiteDataCol2" value="">
              <input type="hidden" name="lite_T" id="allLiteDataCol3" value="">
              <input type="hidden" name="lite_E" id="allLiteDataCol4" value="">
              <input type="hidden" name="user_id_tester" value="<?php echo @$_SESSION['usr_id']; ?>">
            </form>
            <input type="button" id="getResultLITE" value="Kira Markah FNTP" class="btn btn-success" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <th>Fakta <span id="allLiteCol1" class="badge badge-info"></span></th>
          <th>Naluri <span id="allLiteCol2" class="badge badge-info"></span></th>
          <th>Teori <span id="allLiteCol3" class="badge badge-info"></span></th>
          <th>Pengalaman <span id="allLiteCol4" class="badge badge-info"></span></th>
        </tr>
      </tbody>
    </table>
      </div>
			<hr>
			<div>
        <table width="100%">
            <tr>
              <td width="50%"><a href="#" id="section3"></a></td>
              <td align="right"><a href="#top">kembali ke ATAS</a></td>
            </tr>
          </table>
				<p><img src="img/sec3.png" alt="sec3" border="0"></p>
				<p>
					<span class="label label-important">Arahan:</span> Berikut adalah kumpulan 20 penyataan yang akan menilai kaedah tidak balas anda terhadap penerimaan maklumat. Sila lengkapkan setiap soalan dengan memilih SATU penyataan (A) atau (B) atau (C) di mana ianya akan menggambarkan jawapan pilihan anda. Sila PILIH SATU sahaja yang anda rasakan bersesuaian dengan diri anda walaupun ada di antara penyataan yang lain juga menjadi pilihan jawapan anda.
				</p>
			</div>
			<div>
				<table border="1" cellpadding="1" cellspacing="1" width="100%" class="table table-bordered table-hover table-striped">
					<tbody>
						<tr>
							<th colspan="3">
								1. Bila memberi atau menerima arahan, saya suka...
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer1" class="a" value="A"></label>
							</td>
							<td>
								Memberitahu atau diberitahu dengan jelas tentang apa yang harus dilakukan.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer1" class="b" value="B"></label>
							</td>
							<td>
								Jika arahan yang diberi/diterima diberitahu dalam bentuk tulisan.
							</td>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer1" class="c" value="C"></label>
							</td>
							<td>
								Jika apa yang harus dilakukan dapat ditunjukkan/didemonstrasi di depan mata saya/orang lain. 
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								2. Jika saya membaca novel, saya akan... 
							</th>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer2" class="b" value="B"></label>
							</td>
							<td>
								Membayangkan persekitaran, pemandangan, rupa dan baju yang dipakai oleh watak dalam novel itu.
							</td>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer2" class="c" value="C"></label>
							</td>
							<td>
								Merasakan mood, persembahan dan aksi cerita novel tersebut.
							</td>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer2" class="a" value="A"></label>
							</td>
							<td>
								Terngiang-ngiang di fikiran saya perbualan dan dialog di antara watak dalam novel yang dibaca. 
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								3. Jika saya berjumpa seseorang itu untuk pertama kali, saya biasanya akan perasaan/tertumpu kepada...
							</th>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer3" class="c" value="C"></label>
							</td>
							<td>
								Cara bersalam, gerak badan, sikap dan ciri fizikal orang itu.
							</td>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer3" class="a" value="A"></label>
							</td>
							<td>
								Nada suara, ketegasan ketika berucap, kualiti suara dan pemilihan perkataan seseorang itu.
							</td>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer3" class="b" value="B"></label>
							</td>
							<td>
								Gaya pemakaian, kekemasan, kebersihan dan penampilan mereka.
							</td>
						</tr>				
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								4. Bila saya terfikir mengenai sesuatu yang telah berlaku suatu ketika dulu, pertamanya saya akan terfikir...
							</th>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer4" class="c" value="C"></label>
							</td>
							<td>
								Bagaimana saya berfikir dan rasa pada ketika.
							</td>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer4" class="b" value="B"></label>
							</td>
							<td>
								Bagaimana setiap orang dan benda lihat pada ketika itu.
							</td>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer4" class="a" value="A"></label>
							</td>
							<td>
								Apa yang saya dengari dan anggapkan pada ketika itu. 
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								5. Bila saya mengalami kesusahan untuk melupakan sesuatu pengalaman yang pahit dalam minda:
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer5" class="a" value="A"></label>
							</td>
							<td>
								Saya akan terdengar perkataan yang sama berulang-kali.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer5" class="b" value="B"></label>
							</td>
							<td>
								Saya akan terbayang-bayang perkara yang sama berulang-kali.
							</td>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer5" class="c" value="C"></label>
							</td>
							<td>
								Saya akan merasa perasaan yang sama berulang-kali. 
							</td>
						</tr>				
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								6.Bila saya menerangkan mengenai sesuatu perkara yang penting, respon yang saya harapkan daripada orang lain berbunyi:
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer6" class="b" value="B"></label>
							</td>
							<td>
								"Awak menggambarkan dengan jelas perkara itu kepada saya".
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer6" class="a" value="A"></label>
							</td>
							<td>
								"Cara awak bercakap sangat tepat dan tidak dapat disangkal lagi". 
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer6" class="c" value="C"></label>
							</td>
							<td>
								"Saya pun rasa begitu juga".
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								7. Bila saya memberikan tumpuan kepada kerja rumah, saya sangat mudah terganggu oleh: 
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer7" class="c" value="C"></label>
							</td>
							<td>
								Perubahan suhu bilik dan ketidakselesaan fizikal lain. 
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer7" class="a" value="A"></label>
							</td>
							<td>
								Bunyi, suara, audio dan musik. 
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer7" class="b" value="B"></label>
							</td>
							<td>
								Terlihat pemandangan, majalah, gambar, potret dan kelipan/kehadiran cahaya. 
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								8.Saya akan mendapat suntikan semangat yang tinggi bila sesorang yang penting bagi saya:
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer8" class="a" value="A"></label>
							</td>
							<td>
								Berkata sesuatu yang penuh bermakna dalam pertuturan dan penekanan dalam  percakapan mereka.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer8" class="b" value="B"></label>
							</td>
							<td>
								Menunjukkan yang mereka memberi tumpuan dan fokus terhadap saya.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer8" class="c" value="C"></label>
							</td>
							<td>
								Bersalaman, memegang atau memeluk saya dengan penuh kasih saying.
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								9. Ucapan saya akan terganggu bila seseorang itu...
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer9" class="a" value="A"></label>
							</td>
							<td>
								Bercakap ketika saya bercakap.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer9" class="c" value="C"></label>
							</td>
							<td>
								Berlegar-legar atau bergerak di dalam bilik ketika saya sedang bercakap.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer9" class="b" value="B"></label>
							</td>
							<td>
								Tidak memberi tumpuan dan tidak melihat ketika saya membentangkan idea penting.Not focusing and watching while I pointed out key ideas.
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								10.Jika saya sedang bercakap/berbual dengan orang, saya lebih tertumpu kepada...
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer10" class="a" value="A"></label>
							</td>
							<td>
								Nada suara saya terhadap mereka.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer10" class="b" value="B"></label>
							</td>
							<td>
								Penampilan diri saya terhadap mereka. 
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer10" class="c" value="C"></label>
							</td>
							<td>
								Bagaimana perasaan mereka terhadap saya.
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								11.Dalam majlis sosial/keraian, saya suka...       
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer11" class="b" value="B"></label>
							</td>
							<td>
								Jika dapat duduk dan hanya melihat orang lain. 
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer11" class="a" value="A"></label>
							</td>
							<td>
								Bercakap lama-lama dengan seseorang yang pandai bercakap mengenai sesuatu topik yang penting dengan saya.
							</td>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer11" class="c" value="C"></label>
							</td>
							<td>
								Menari, menyertai aktiviti dan permainan yang dapat menghiburkan saya 
							</td>
						</tr>				
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								12.Saya suka melihat cerita/wayang yang...
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer12" class="c" value="C"></label>
							</td>
							<td>
								Memperlihatkan aksi yang menarik, aktiviti fizikal dan penuh emosi.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer12" class="a" value="A"></label>
							</td>
							<td>
								Dipenuhi dengan dialog dan perbualan yang bijak, sesuai dan memberi makna dan impak.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer12" class="b" value="B"></label>
							</td>
							<td>
								Menampilkan pemandangan yang cantik, menggunakan banyak efek khas dan sudut kamera yang menarik.
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								13.Jika saya diminta untuk menerangkan sesuatu yang baru kepada orang lain, saya lebih selesa jika...
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer13" class="b" value="B"></label>
							</td>
							<td>
								Saya menulisnya dan memberikan nota yang ditulis itu kepadanya. 
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer13" class="a" value="A"></label>
							</td>
							<td>
								Saya menerangkan sendiri kepadanya 
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer13" class="c" value="C"></label>
							</td>
							<td>
								Saya dapat menunjukkan demonstrasi kepadanya.
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								14.Bila sesorang itu mahukan maklum balas daripada saya untuk sesuatu idea, saya lebih suka jika saya dapat mendengar ayat ini:
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer14" class="b" value="B"></label>
							</td>
							<td>
								"Apa pandangan awak?"
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer14" class="c" value="C"></label>
							</td>
							<td>
								"Apa awak rasa?"
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer14" class="a" value="A"></label>
							</td>
							<td>
								"Bagaimana bunyinya perkara ini?"
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								15.Bila bercakap dengan seseorang, saya mengalami kesukaran untuk bertutur dengan orang yang:
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer15" class="a" value="A"></label>
							</td>
							<td>
								Tidak bercakap balik dan berdiam diri sahaja.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer15" class="b" value="B"></label>
							</td>
							<td>
								Tidak bertentang mata dengan saya dan memandang ke arah lain.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer15" class="c" value="C"></label>
							</td>
							<td>
								Tidak menunjukkan sebarang tindak balas emosi ketika berbual.
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								16.Jika sesorang itu menghantar satu mesej yang penting kepada saya, saya lebih suka jika...
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer16" class="c" value="C"></label>
							</td>
							<td>
								Ianya dihantar sendiri oleh pengirim mesej tersebut. 
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer16" class="b" value="B"></label>
							</td>
							<td>
								Ianya dihantar dalam bentuk penulisan/nota. 
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer16" class="a" value="A"></label>
							</td>
							<td>
								Ianya dibincangkan terus dengan saya melalui telefon. 
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								17.Jika sesorang itu tidak dapat memahami arahan yang saya berikan, saya akan:
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer17" class="b" value="B"></label>
							</td>
							<td>
								Mengambil pensil dan kertas dan menunjuk serta melakarkan arahan itu kembali.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer17" class="c" value="C"></label>
							</td>
							<td>
								Merasa bengang, menyampah dan akan mengulang kembali arahan yang sama diberikan tadi.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer17" class="a" value="A"></label>
							</td>
							<td>
								Mengulang semula arahan tadi dengan menggunakan ayat yang lain agar ianya dapat difahami. 
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								18. Bila saya menantikan hari ketibaan sesuatu majlis atau masa, secara amnya, saya akan...
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer18" class="b" value="B"></label>
							</td>
							<td>
								Terbayang bagaimana semuanya akan kelihatan.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer18" class="a" value="A"></label>
							</td>
							<td>
								Bercakap bersendirian tentang bagaimana semuanya patut dijalankan. 
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer18" class="c" value="C"></label>
							</td>
							<td>
								Menunjukkan perasaan emosi (gembira, bimbang, sedih, marah).
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								19. Perkara yang akan menggangu tidur saya merupakan:
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer19" class="a" value="A"></label>
							</td>
							<td>
								Bunyi yang bising.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer19" class="b" value="B"></label>
							</td>
							<td>
								Lampu/cahaya terang bilik.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer19" class="c" value="C"></label>
							</td>
							<td>
								Cadar, tilam yang keras atau keadaan fizikal ruang tidur yang tidak menyelesakan.
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								20. Pada masa lapang, saya kebiasaannya akan:
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer20" class="c" value="C"></label>
							</td>
							<td>
								Bersenam, melukis, membina, membaiki atau mencipta sesuatu dengan tangan sendiri. 
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer20" class="a" value="A"></label>
							</td>
							<td>
								Bercakap di dalam telefon, memainkan alatan musik, mendengar musik atau menonton rancangan berbentuk 'talk show'.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer20" class="b" value="B"></label>
							</td>
							<td>
								Menonton TV, cerita/wayang, produksi lintas langsung, membaca, atau menulis.
							</td>
						</tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td><strong>Markah: </strong></td>
              <td>
                <strong>Dengar</strong>
                <span class="a_results badge badge-info"></span>

                <strong>Lihat</strong>
                <span class="b_results badge badge-info"></span>

                <strong>Buat</strong>
                <span class="c_results badge badge-info"></span>

                <form action="#" name="XYZ_DATA" id="XYZ_DATA">
                  <input type="hidden" name="lse_X" class="a_results" value="">
                  <input type="hidden" name="lse_Y" class="b_results" value="">
                  <input type="hidden" name="lse_Z" class="c_results" value="">
                  <input type="hidden" name="user_id_tester" value="<?php echo @$_SESSION['usr_id']; ?>">
                </form>
              </td>
            </tr>
					</tbody>
				</table>
			</div>

			<hr>
			<div>
        <table width="100%">
            <tr>
              <td width="50%"><a href="#" id="section4"></a></td>
              <td align="right"><a href="#top">kembali ke ATAS</a></td>
            </tr>
          </table>
				<p><img src="img/sec4.png" alt="sec4" border="0"></p>
				<p>
          <span class="label label-important">Arahan:</span> Bayangkan yang anda kini di sekolah, pejabat atau rumah. Baca soalan dan pilihan jawapan secara melintang dari kiri dan kanan. Kemudian, pilih jawapan untuk setiap 10 soalan bagi menilai diri anda. Untuk penyataan yang paling penting bagi anda, sila pilih 4. Jika penyataan itu selalunya penting bagi anda, sila pilih 3. Jika penyataan itu kadang-kadang penting bagi anda, sila pilih 2. Dan jika penyataan itu tidak penting bagi anda, sila pilih 1.
          <br>
          <br>
        </p>
			</div>
      <div>
        <table border="1" cellpadding="1" cellspacing="1" width="100%" class="table table-bordered table-hover table-striped">
 <tbody><tr> <th>No</th>
  <th>Taat</th>
  <th>Kesamaan</th>
  <th>Bebas</th>
  <th>Adil</th>
 </tr>
 <tr>
    <td>1</td>
    <td>Bagi saya, "Jika kita mempunyai pegangan, kita akan mudah   dijatuhkan".</td>
    <td>Saya akan membuat yang terbaik dalam apa sahaja perkara yang dapat   membuatkan saya merasa kepuasan diri.</td>
    <td>Saya sangat berpuas hati jika dapat pengiktirafan dan melalukan perkara   mengikut cara sendiri.I am strongly driven by gaining recognition and doing   things in my own way</td>
    <td>Walaupun saya menderita sekalipun, saya masih akan bimbangkan kebajikan   orang lain.</td>
  </tr>
 <tr>
  <td>&nbsp;</td>
  <td><select name="rowLEPJ1col1" id="rowLEPJ1col1">
    <option value="0">Choose</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select></td>
  <td>
    <select name="rowLEPJ1col2" id="rowLEPJ1col2">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ1col3" id="rowLEPJ1col3">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ1col4" id="rowLEPJ1col4">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
 </tr>
 <tr>
    <td>2</td>
    <td>Saya akan sentiasa setia kepada sesuatu organisasi, idea dan cara setelah   menyesuaikan diri dengannya.</td>
    <td>Mengekalkan keharmonian menjadi matlamat utama saya berbanding   kepentingan peribadi.</td>
    <td>Saya akan cuba yang terbaik untuk mencapai matlamat yang dapat   meningkatkan kepuasan diri saya.</td>
    <td>Saya suka berkongsi idea dengan orang lain untuk mempertingkatkan kualiti   dan produktiviti kerja.</td>
  </tr>
 <tr>
  <td>&nbsp;</td>
  <td><select name="rowLEPJ2col1" id="rowLEPJ2col1">
    <option value="0">Choose</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select></td>
  <td>
    <select name="rowLEPJ2col2" id="rowLEPJ2col2">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ2col3" id="rowLEPJ2col3">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ2col4" id="rowLEPJ2col4">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
 </tr>
 <tr>
    <td>3</td>
    <td>Saya akan mengikut peraturan, melihat perkara dengan terperinci,   mementingkan pencapaian matlamat dan pada masa yang sama cuba mendapat   pengiktirafan orang lain.</td>
    <td>Saya suka situasi yang dapat memberikan saya kepuasan dan ketenangan   diri.</td>
    <td>Saya akan menyesuaikan diri dengan keadaan supaya saya dapat   mempertingkatkan pencapaian dan keselesaan diri.</td>
    <td>Saya mampu berinteraksi baik dengan orang lain. Saya akan melayan mereka   dengan baik dan penuh hormat.</td>
  </tr>
 <tr>
  <td>&nbsp;</td>
  <td><select name="rowLEPJ3col1" id="rowLEPJ3col1">
    <option value="0">Choose</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select></td>
  <td>
    <select name="rowLEPJ3col2" id="rowLEPJ3col2">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ3col3" id="rowLEPJ3col3">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ3col4" id="rowLEPJ3col4">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
 </tr>
 <tr>
    <td>4</td>
    <td>Saya kurang selesa dengan perubahan dan mahu mengekalkan persekitaran   yang terjalin baik selama ini.</td>
    <td>Saya menilai orang dan situasi berdasarkan kepercayaan dan rasa diri.</td>
    <td>Saya suka bila kekuatan dan kebolehan saya diuji oleh situasi yang tidak   menyekat kebebasan diri saya.</td>
    <td>Saya suka membawa orang dan idea bersama bagi mencapai keseimbangan dan   harmoni.</td>
  </tr>
 <tr>
  <td>&nbsp;</td>
  <td><select name="rowLEPJ4col1" id="rowLEPJ4col1">
    <option value="0">Choose</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select></td>
  <td>
    <select name="rowLEPJ4col2" id="rowLEPJ4col2">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ4col3" id="rowLEPJ4col3">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ4col4" id="rowLEPJ4col4">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
 </tr>
 <tr>
    <td>5</td>
    <td>Bagi saya, kepercayaan orang lain terhadap saya dan reputasi saya adalah   sangat penting.</td>
    <td>Kerja keras dan berlaku adil ketika membuat sesuatu adalah penting bagi   saya. Tetapi saya tidak suka bila sesuatu situasi itu menghadkan kebolehan   saya.</td>
    <td>Saya amat peka dan akan mencari jalan/penyelesaian yang kreatif untuk   mencapai matlamat saya.</td>
    <td>Saya rasa saya perlu mencapai sesuatu dengan menggunakan kebijaksanaan   yang saya miliki.</td>
  </tr>
 <tr>
  <td>&nbsp;</td>
  <td><select name="rowLEPJ5col1" id="rowLEPJ5col1">
    <option value="0">Choose</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select></td>
  <td>
    <select name="rowLEPJ5col2" id="rowLEPJ5col2">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ5col3" id="rowLEPJ5col3">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ5col4" id="rowLEPJ5col4">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
 </tr>
 <tr>
    <td>6</td>
    <td>Saya akan menunjukkan kesetiaan dan kepercayaan saya.</td>
    <td>Walau apapun yang saya lakukan, saya akan sentiasa memikirkan keperluan,   keinginan dan hak orang lain.</td>
    <td>Saya akan menggunakan pengaruh saya pada setiap situasi dan persekitaran   tak kira di mana saya berada.</td>
    <td>Saya cuba untuk tidak menilai orang lain dan sentiasa berfikiran terbuka   tanpa hilang pertimbangan diri.</td>
  </tr>
 <tr>
  <td>&nbsp;</td>
  <td><select name="rowLEPJ6col1" id="rowLEPJ6col1">
    <option value="0">Choose</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select></td>
  <td>
    <select name="rowLEPJ6col2" id="rowLEPJ6col2">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ6col3" id="rowLEPJ6col3">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ6col4" id="rowLEPJ6col4">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
 </tr>
 <tr>
    <td>7</td>
    <td>Masa dan ketepatan janji merupakan keutamaan saya. Saya seorang yang   berpegang pada kata-kata dan janji.</td>
    <td>Saya suka bila orang lain gembira dengan keperihatinan dan keramahan yang   saya tunjukkan kepada mereka.</td>
    <td>Saya percaya sesuatu perkara itu terjadi dan berlaku atas sebab-sebab   tertentu dan mengikut cara tersendiri. Saya akan cuba memadankan situasi   dengan matlamat.</td>
    <td>Saya akan terus berpegang kepada apa yang saya percaya, tapi saya juga   akan meletakkan usaha bagi memastikan keharmonian yang seimbang.</td>
  </tr>
 <tr>
  <td>&nbsp;</td>
  <td><select name="rowLEPJ7col1" id="rowLEPJ7col1">
    <option value="0">Choose</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select></td>
  <td>
    <select name="rowLEPJ7col2" id="rowLEPJ7col2">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ7col3" id="rowLEPJ7col3">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ7col4" id="rowLEPJ7col4">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
 </tr>
 <tr>
    <td>8</td>
    <td>Bagi saya, etika, kejujuran dan integriti adalah sangat penting.</td>
    <td>Bila menghampiri orang lain, saya akan bersikap terbuka dan cuba untuk   tidak membuat orang lain merasa tertekan.</td>
    <td>Keutamaan yang saya pegang adalah lebih penting dari pengaruh luar.</td>
    <td>Saya akan cuba sedaya upaya untuk membuat apa yang saya katakan menjadi   realiti.</td>
  </tr>
 <tr>
  <td>&nbsp;</td>
  <td><select name="rowLEPJ8col1" id="rowLEPJ8col1">
    <option value="0">Choose</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select></td>
  <td>
    <select name="rowLEPJ8col2" id="rowLEPJ8col2">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ8col3" id="rowLEPJ8col3">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ8col4" id="rowLEPJ8col4">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
 </tr>
 <tr>
    <td>9</td>
    <td>Saya menguruskan situasi menggunakan pendekatan logikal, bukannya   dipengaruhi emosi.</td>
    <td>Saya akan cuba menjaga hubungan dengan orang lain dan mempertimbangkan   pandangan dan pendapat mereka.</td>
    <td>Agak mudah bagi saya untuk menilai sesuatu peluang yang boleh memberi   manfaat kepada saya. Saya akan memanfaatkannya sebaik mungkin.</td>
    <td>Saya melihat orang, benda dan perkara lain dari sudut yang positif.</td>
  </tr>
 <tr>
  <td>&nbsp;</td>
  <td><select name="rowLEPJ9col1" id="rowLEPJ9col1">
    <option value="0">Choose</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select></td>
  <td>
    <select name="rowLEPJ9col2" id="rowLEPJ9col2">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ9col3" id="rowLEPJ9col3">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ9col4" id="rowLEPJ9col4">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
 </tr>
 <tr>
    <td>10</td>
    <td>Benda dan situasi patutnya tidak berubah. Saya tidak suka perubahan yang   mengejut.</td>
    <td>Keharmonian dan pencapaian merupakan sesuatu yang saya impikan dan ia   memberi kepuasan diri kepada saya.</td>
    <td>Saya suka mencabar diri sendiri dengan orang lain. Saya mempunyai   standard yang tersendiri.</td>
    <td>Berkongsi pencapaian dengan orang lain dalam melalakukan kerja/tugasan   adalah sangat bermakna bagi saya.</td>
  </tr>
 <tr>
  <td>&nbsp;</td>
  <td><select name="rowLEPJ10col1" id="rowLEPJ10col1">
    <option value="0">Choose</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select></td>
  <td>
    <select name="rowLEPJ10col2" id="rowLEPJ10col2">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ10col3" id="rowLEPJ10col3">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ10col4" id="rowLEPJ10col4">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
 </tr>
 <tr>
  <td colspan="5">
    <input type="button" id="getresultLEPJ" value="Kira Markah TKBA" class="btn btn-success">
  
  </td>
 </tr>
 <tr>
  <th></th>
 <th>Taat <span class="badge badge-info" id="allLEPJCol1"></span></th>
  <th>Kesamaan <span class="badge badge-info" id="allLEPJCol2"></span></th>
  <th>Bebas <span class="badge badge-info" id="allLEPJCol3"></span></th>
  <th>Adil <span class="badge badge-info" id="allLEPJCol4"></span></th>
 </tr>
</tbody></table>
      </div>


			<div>
        <form action="#" id="testAllValue">
					<input type="hidden" name="lepj_L" id="allLEPJDataCol1" value="">
					<input type="hidden" name="lepj_E" id="allLEPJDataCol2" value="">
					<input type="hidden" name="lepj_P" id="allLEPJDataCol3" value="">
					<input type="hidden" name="lepj_J" id="allLEPJDataCol4" value="">

					<input type="hidden" name="user_id_tester" value="<?php echo @$_SESSION['usr_id']; ?>">
				</form>

				<input type="button" class="btn btn-primary" id="showReportBtn" value="Kira Semua Markah">
			</div>

			</div>
			<!-- test_container -->

			<div id="result_show" style="display:none">
				<!-- <h4>Your Results is:</h4> -->
				<!-- <strong>DISC RESULT</strong> -->

				<!-- <strong>PLS RESULT</strong>  -->

				<!-- <strong>XYZ RESULT</strong> -->

				<!-- <strong>LEPJ RESULT</strong> -->
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <form action="#" id="resultValue">
          <input type="hidden" name="disc" id="discResult_txt" value="" /><br>
          <input type="hidden" name="pls" id="plsResult_txt" value="" /><br>
          <input type="hidden" name="xyz" id="clsResult_txt" value="" /><br>
          <input type="hidden" name="lepj" id="lepjResult_txt" value="" /><br>
          <input type="hidden" name="user_id_tester" id="user_id_tester" value="<?php echo @$_SESSION['usr_id']; ?>">
        </form>
        <table width="100%" cellpadding="2" cellspacing="2" border="0" id="score">
          <tr>
            <td align="center" width="25%" height="160px"><span id="discResult"></span></td>
            <td align="center" width="25%"><span id="plsResult"></span></td>
            <td align="center" width="25%"><span id="clsResult"></span></td>
            <td align="center" width="25%"><span id="lepjResult"></span></td>
          </tr>
          <tr>
            <td colspan="4">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" align="center" valign="middle">
              <input type="button" class="btn btn-primary" id="saveNreports" value="Simpan Markah Sekarang &amp; Lihat Laporan" />
            </td>
          </tr>
        </table>
			</div>
		</div>
		<!-- wrapper -->

    <?php include 'footer-sc.php'; ?>

		<!-- Load js from footer to make load fastest -->
    <script src="js/sysMainProApp.js" type="text/javascript"></script>
    <script src="js/sysLITE.js" type="text/javascript"></script>
    <script src="js/sysAPSC.js" type="text/javascript"></script>
    <script src="js/sysXYZ.js" type="text/javascript"></script>
    <script src="js/sysLEPJ.js" type="text/javascript"></script>
	</body>
</html>