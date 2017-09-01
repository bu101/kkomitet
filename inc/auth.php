<style type="text/css">
    body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        max-width: 360px;
        padding: 35px 25px 25px;
        margin: 100px auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
    }
</style>

</head><body>

<div class="container" id='main_login'>
    <? //echo $_SERVER['REQUEST_URI']; ?>
    <form class="form-signin" action="<?=$CONF['hostname']?>index.php" method="POST" autocomplete="off">
        <center><h3 style="margin-top: 10px;margin-bottom: 20px;" class="text-muted">Кредитный комитет</h3></center>
        <div class="form-group">
        <div class="input-group">
        <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
        <input type="text" name="login" autocomplete="off" class="form-control" placeholder="Логин">
        </div>
        </div>
        <div class="form-group">
        <div class="input-group">
        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
        <input type="password" name="password" class="form-control" placeholder="Пароль">
        </div>
        </div>
        <div style="padding-left:75px;">
            <div class="checkbox">
                <label class="text-muted">
                    <input id="mc" checked name="remember_me" value="1" type="checkbox"> Запомнить меня
                </label>
            </div>
        </div>
        <? if (!empty($error)) { 
            echo $error;
            } ?>
        <input type="hidden" name="req_url" value="<? echo $_SERVER['REQUEST_URI']; ?>">
        <button class="btn btn-lg btn-primary btn-block"> <i class="fa fa-sign-in"></i> Войти</button>
        <?
       
         if ($CONF['first_login'] == "true") { ?>
                <hr style=" margin-top: 25px; ">
        <small>
            <center style=" margin: -5px; "><a href="#" id="show_activate_form">Регистрация</a>
            </center>
        </small>
		<? } ?>
    </form>



</div>
<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $("#main_login").hide().fadeIn(500);
        $('body').on('click', 'a#show_activate_form', function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "actions.php",
                data: {
                mode: 'activate_login_form'
                },
                success: function(html){
                //alert(html);
                $(".form-signin").hide().html(html).fadeIn(500);

                    $('body').on('click', 'button#do_activate', function(event) {
                        event.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "actions.php",
                            data: {
                            mode: 'first_login',
                            domain_login: $('#domain_login').val(),   
                            domain_password: $('#domain_password').val()
                            },
                            success: function(html){
                            //alert(html);
                            $(".form-signin").hide().html(html).fadeIn(500);
                            }
                        });
                    });
                }
            });
        });
    });
</script>
