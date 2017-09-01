<?
session_start();
include("functions/functions.php");
if ( isset($_POST['mode']) ) {

    $mode=($_POST['mode']);


    if ($mode == "activate_login_form") {
?>
        <center><h3 style="margin-top: 10px;margin-bottom: 20px;" class="text-muted">Регистрация пользователя</h3></center>
        <div class="form-group">
        <div class="input-group">
        <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
        <input type="text" id="domain_login" name="login" autocomplete="off" class="form-control" placeholder="Логин">
        </div>
        </div>
        <div class="form-group">
        <div class="input-group">
        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
        <input type="password" id="domain_password" name="password" class="form-control" placeholder="Пароль">
        </div>
        </div>
        <p class="help-block"><small>Укажите пользователя и пароль что Вы используете для входа в компютер.</small></p>
        <div style="padding-left:75px;">
        </div>
        <br>
        <button id="do_activate" type="submit" class="btn btn-lg btn-success btn-block"> <i class="fa fa-check-circle-o"></i>Регистрировать</button>
        <hr style=" margin-top: 25px; ">
        <small>
            <center style=" margin: -5px; "><a href="/">назад</a>
            </center>
        </small>
<?
    									}

    if ($mode == "first_login") {

    	if (!empty($_POST['domain_login']) && !empty($_POST['domain_password'])){

			$username = $_POST['domain_login'];

			$stmt = $db->prepare('SELECT id,login from users where login=:login');
		    $stmt->execute(array(':login' => $username));
		    
			    if ($stmt -> rowCount() != 1) {

			    $login = $_POST['domain_login'];
			    $password = $_POST['domain_password'];

		
				$domen = new Domen($login,$password);   
				$domen->register();
				$error=$domen->error_text;
		   		} else {
		   			$error='<div class="alert alert-danger">
		   			<center>Пользователь с таким логином уже зарегестрирован.<br> <small><a href="/">назад</a></small></center></div>';
		   		}	

		} else { $error='<div class="alert alert-danger">
				<center>Не чуди.<br> <small><a href="/">назад</a></small></center></div>';
			}
?>
        <center><h3 style="margin-top: 10px;margin-bottom: 20px;" class="text-muted">Регистрация пользователя</h3></center>
        <div class="form-group">
        <div class="input-group">
        <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
        <input type="text" id="domain_login" name="login" autocomplete="off" class="form-control" placeholder="Логин">
        </div>
        </div>
        <div class="form-group">
        <div class="input-group">
        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
        <input type="password" id="domain_password" name="password" class="form-control" placeholder="Пароль">
        </div>
        </div>
        <p class="help-block"><small>Укажите пользователя и пароль что Вы используете для входа в компютер.</small></p>
        <div style="padding-left:75px;">
        </div>
        <? if (!empty($error)) { 
            echo $error;
            } ?>
        <br>
        <button id="do_activate" type="submit" class="btn btn-lg btn-success btn-block"> <i class="fa fa-check-circle-o"></i>Регистрировать</button>
        <hr style=" margin-top: 25px; ">
        <small>
            <center style=" margin: -5px; "><a href="/">назад</a>
            </center>
        </small>
<?

	}






}
?>
