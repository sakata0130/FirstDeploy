<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
    print '<p class="name">ようこそゲスト様<p/>';
    print '<p class="kannin"><a href="member_login.html">会員ログイン</a></p><br />';
    print '<br />';
}
else
{
    print '<p class="name">ようこそ　';
    print $_SESSION['member_name'];
    print ' 様</p>　';
    print '<a href="member_logout.php">ログアウト</a><br />';
    print '<br />';
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>ショップ</title>
</head>
<body>
<?php
try
{
$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$sql='SELECT code,name,typenumber FROM mst_number WHERE 1';
$stmt=$dbh->prepare($sql);
$stmt->execute();
$dbh=null;
print '<h1>商品一覧</h1><br /><br />';
while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		break;
	}
	print '<table class="current">';
	print '<tr>';
	print '<td>';
	print '<a href="shop_list.php?procode='.$rec['code'].'">';
	print $rec['name'];

	print '</a>';
	print '</td>';
	print '</td>';
	print '</table>';
	print '<br />';
}
print '<br />';
print '<a class="btn-radius-solid"href="shop_cartlook.php">カートを見る<i class="fas fa-angle-right fa-position-right"></i></a><br />';
}
catch (Exception $e)
{
     print 'ただいま障害により大変ご迷惑をお掛けしております。';
     exit();
}
?>
</body>
</html>
