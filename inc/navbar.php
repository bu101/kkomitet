<?
function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'class="active"';
}
?>

<nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?=$CONF['hostname']?>index.php"><?=$CONF['name_of_firm']?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
 <? $priv_val = priv_status($_SESSION['user_id']); 
if ($priv_val == 1) { ?>             
            <li <?=echoActiveClassIfRequestMatches("create")?>><a href="<?=$CONF['hostname']?>create">Создать заявку</a></li>
  <?}?>       
  
  <? $priv_val = priv_status($_SESSION['user_id']); 
if ($priv_val == 5) { ?>             
            <li <?=echoActiveClassIfRequestMatches("kksostav")?>><a href="<?=$CONF['hostname']?>kksostav">Члени кредитного комітету</a></li>
  <?}?>       

<? //Тут допихиваем кнопки если надо
$priv_val = priv_status($_SESSION['user_id']);?>
<input type="hidden" id="priv_val" value="<?echo ($priv_val);?>"> <?
 if ( ($priv_val == "2")) { ?>
				<li <?=echoActiveClassIfRequestMatches("users")?>><a href="<?=$CONF['hostname']?>users">Пользователи системы</a></li>
			  
			    <li <?=echoActiveClassIfRequestMatches("partnery")?>><a href="<?=$CONF['hostname']?>partnery">Партнери</a></li>  
				
				<li <?=echoActiveClassIfRequestMatches("zvit")?>><a href="<?=$CONF['hostname'];?>zvit">Звіт</a></li>    
				<li <?=echoActiveClassIfRequestMatches("zvit_kotel")?>><a href="<?=$CONF['hostname'];?>zvit_kotel">Звіт по котлам</a></li>  
				<li <?=echoActiveClassIfRequestMatches("zvit_materiali")?>><a href="<?=$CONF['hostname'];?>zvit_materiali">Звіт по матеріалам</a></li>  
				  
                        <? } if ($priv_val == 4) {?>
                        
				<li <?=echoActiveClassIfRequestMatches("reestr")?>><a href="<?=$CONF['hostname'];?>reestr">Реєстр</a></li>     
				
						<? }  if (priv_status($_SESSION['user_id'])=='10') { ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Администрирование<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li <?=echoActiveClassIfRequestMatches("config")?>><a href="<?=$CONF['hostname']?>config"><i class="fa fa-cog"></i>Настройки системы</a></li>
                    <li <?=echoActiveClassIfRequestMatches("users")?>><a href="<?=$CONF['hostname']?>users"><i class="fa fa-users"></i>Пользователи системы</a></li>
                    <li <?=echoActiveClassIfRequestMatches("deps")?>><a href="<?=$CONF['hostname']?>deps"><i class="fa fa-sitemap"></i>Отделы системы</a></li>
                    <li <?=echoActiveClassIfRequestMatches("files")?>><a href="<?=$CONF['hostname']?>files"><i class="fa fa-files-o"></i>Файлы заявок</a></li>
				</ul>
			


        <? } ?>
        </ul>


        <ul class="nav navbar-nav navbar-right">

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=name_of_user_ret($_SESSION['user_id']);?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li <?=echoActiveClassIfRequestMatches("profile")?>><a href="<?=$CONF['hostname']?>profile"><i class="fa fa-cogs"></i>Профиль</a></li>
                    <li><a href="<?=$CONF['hostname']?>index.php?logout"><i class="fa fa-sign-out"></i>Выйти</a></li>
                </ul>
            </li>



        </ul>










    </div>
</nav>