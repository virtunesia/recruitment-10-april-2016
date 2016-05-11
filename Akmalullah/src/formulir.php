<html>
<body>
<form method="post" action="kedua.php">
<p align="center"><font size="5px" face="calibri" color="black">Id :</font></p>
<P align="center"><input type="text" name="Id" size="11"></p>
<P align="center"><font size="5px" face="calibri" color="black">String :</font></p>
<P align="center"><textarea name="Str" rows="6" cols="45"></textarea></p>
<p align="center"><input type="submit" name="tombol" value="Masukan"/>
</form>
<?php
$host="localhost";
$user="root";
$pass="";
$db="test";
$id=$_POST['Id'];
$timestamp = date('Y-M-D h:m:s');
$string=$_POST['Str'];
$conn=mysqli_connect($host,$user,$pass,$db);
if (!$conn) {
   die("koneksi gagal;".mysqli_connect_error());
}
$sql="INSERT INTO request VALUES('$id',date('d/m/Y H:i:s'),'$string')";
if(mysqli_query($conn,$sql)){
   echo"<b>Data Tersimpan";
 }else{
    echo "Error:".$sql."<br>".mysqli_error($conn);
}
mysqli_close($conn);
?>
