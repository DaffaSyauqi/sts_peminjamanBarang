<?php
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "peminjamanbarang";
    $connect = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die("Gagal terhubung dengan Database: " . mysqli_error($dbconnect));


    function checkLogin($username, $password){
		global $connect; 
		$uname = $username;
		$upass = $password;		
		$hasil = mysqli_query($connect,"select * from user where username='$uname' and password=md5('$upass')");
		$cek = mysqli_num_rows($hasil);
		if($cek > 0 ){
            $query = mysqli_fetch_array($hasil);
            $_SESSION['id_user'] = $query['id_user'];
            $_SESSION['username'] = $query['username'];
            $_SESSION['role'] = $query['role'];
			return true;		
        }
		else {
			return false;
		}	
	}


    function showdataBarang()
    {
        global $connect;    
        $hasil=mysqli_query($connect,"SELECT barang.id, barang.kode_barang, barang.nama_barang, barang.kategori, barang.merek, barang.jumlah from barang;");
        $rows=[];
        while($row = mysqli_fetch_assoc($hasil))
        {
            $rows[] = $row;
        }
        return $rows;

    }

    function showdataUser()
    {
        global $connect;    
        $hasil=mysqli_query($connect,"SELECT user.id, user.no_identitas, user.nama, user.status, user.username, user.role from user;");
        $rows=[];
        while($row = mysqli_fetch_assoc($hasil))
        {
            $rows[] = $row;
        }
        return $rows;
    }


    function delete($tablename,$id)
    {
        global $connect;
        $hasil=mysqli_query($connect,"delete from $tablename where id='$id'");
        return $hasil;
    }
?>