<?php

// variabel
$kunci = "";
$kode = "";
$error = "";
$valid = true;
$color = "#FF0000";

// jika form di submit
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	// mendeklarasi fungsi enkripsi dan dekripsi
	require_once('vigenere.php');
	
	// set variabel-variabel
	$kunci = $_POST['kunci'];
	$kode = $_POST['kode'];
	
	// cek apakah kunci ada atau tidak
	if (empty($_POST['kunci']))
	{
		$error = "Mohon isi kuncinya!";
		$valid = false;
	}
	
	// cek apakah teks ada atau tidak
	else if (empty($_POST['kode']))
	{
		$error = "Ketikkan teks atau kode agar bisa dienkripsi atau dekripsi!";
		$valid = false;
	}
	
	// cek jika kunci mengandung angka atau karakter
	else if (isset($_POST['kunci']))
	{
		if (!ctype_alpha($_POST['kunci']))
		{
			$error = "Kunci hanya boleh di isi dengan huruf!";
			$valid = false;
		}
	}
	
	// jika yang di input valid
	if ($valid)
	{
		// jika enkripsi dijalankan atau tombol enkrip di klik
		if (isset($_POST['enkripsi']))
		{
			$kode = enkripsi($kunci, $kode);
			$error = "Teks berhasil dienkripsi!";
			$color = "#526F35";
		}
			
		// jika dekripsi dijalankan atau tombol dekrip di klik
		if (isset($_POST['dekripsi']))
		{
			$kode = dekripsi($kunci, $kode);
			$error = "Kode berhasil didekripsi!";
			$color = "#526F35";
		}
	}     
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Tugas Vigenere Cipher</title>
        <!-- Beri warna background -->
        <style>
        body {
            background-color: aliceblue;
        }
        </style>
	</head>
	<body>
		<br><br><br>
		<form action="index.php" method="post">
			<table cellpadding="5" align="center" cellpadding="2" border="7">
				<caption><hr><b>Tugas Vigenere Cipher</b><hr></caption>
				<tr>
					<td align="center">Kunci: <input type="text" name="kunci" id="pass" value="<?php echo $kunci; ?>" /></td>
				</tr>
				<tr>
					<td align="center"><textarea id="box" name="kode">Isikan plaintextnya..</textarea></td>
				</tr>
				<tr>
					<td><input type="submit" name="enkripsi" class="button" value="Enkrip" onclick="validate(1)" /></td>
				</tr>
				<tr>
					<td><input type="submit" name="dekripsi" class="button" value="Dekrip" onclick="validate(2)" /></td>
				</tr>
				<tr>
					<td><center><div style="color: <?php echo $color ?>"><?php echo $error ?></div></center></td>
				</tr>
				<tr>
					<td><center><div style="color: <?php echo $color ?>"><?php echo 'Kunci : ', $kunci ?></div></center></td>
				</tr>
				<tr>
					<td><center><div style="color: <?php echo $color ?>"><?php echo 'Ciphertext : ', $kode ?></div></center></td>
				</tr>
                <tr></tr>
			</table>
		</form>
	</body>
</html>