<?
session_start();

include("functions/functions.php");


if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION);
    session_unset();
    setcookie('authhash_uid', "");
    setcookie('authhash_code', "");
    unset($_COOKIE['authhash_uid']);
    unset($_COOKIE['authhash_code']);
//  session_regenerate_id();
    header("Location: ".$CONF['hostname']);
}

//print_r($_POST);
$rq=0;
if (isset($_POST['login']) && isset($_POST['password']))
{
    $rq=1;
    $req_url=$_POST['req_url'];
    $rm=$_POST['remember_me'];
    $login = $_POST['login'];
    $password = $_POST['password'];

        // Domen obnova parolia i infi
        $domen = new Domen($login,$password); 
        $domen->login();
        $error=$domen->error_text;  
        //echo $error;
        //
        if(empty($error)) {
        
        $stmt = $db->prepare('SELECT id,login,fio from users where login=:login AND pass=:pass');
        $stmt->execute(array(':login' => $login, ':pass' => $password));
    
            if ($stmt -> rowCount() == 1) {
            	$row = $stmt->fetch(PDO::FETCH_ASSOC);

                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_login'] = $row['login'];
                $_SESSION['user_fio'] = $row['fio'];
                $_SESSION['code'] = md5($password);
                if ($rm == "1") {
                    setcookie('authhash_uid', $_SESSION['user_id'], time()+60*60*24*7);
                    setcookie('authhash_code', $_SESSION['code'], time()+60*60*24*7);
                }
            }
        else {
            $error='<div class="alert alert-danger">
            <center>Ошибка авторизации. <br> Проверьте логин и пароль. <br> Если это ваш первый вход в программу то пожалуйста зарегистрируйтесь.<br> <small><a href="/">назад</a></small></center></div>';
        }
    }
}
//print_r($_SESSION);
if (validate_user($_SESSION['user_id'], $_SESSION['code'])) {
$url = parse_url($CONF['hostname']);

    if ($rq==1) { header("Location: http://".$url['host'].$req_url);}
    if ($rq==0) {
    
    
    if (!isset($_GET['page'])) {        
    	include("inc/head.php");
        include("inc/navbar.php");
        include("inc/kontent.php");
		include("inc/footer.php");
		}
    
    

		
		
		
		
		if (isset($_GET['page'])) {
		
		
	switch($_GET['page'])   {
	case 'create': 	include('inc/new.php');		break;
	default: include('404.php');

                            }	
		                          }
		
		
		      }

}
else {
    include("inc/head.php");
    include 'inc/auth.php';
}

//} else {
    //include "sys/install.php";
//}



// Форма для ввода пароля и логина 
/*
print '
<form action="index.php" method="post">
<table>
      <tr>
            <td>Имя:</td>
            <td><input type="text" name="login" /></td>
      </tr>
      <tr>
            <td>Пароль:</td>
            <td><input type="password" name="password" /></td>
      </tr>
      <tr>
            <td></td>
            <td><input type="submit" value="Авторизироваться" /></td>
      </tr>
</table>
</form>
';
echo "<br /><h3>Для авторизации необходимы ваши учетные данные</h3>";
*/
?>