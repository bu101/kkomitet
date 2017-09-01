<?php

class Domen {

	protected $inf;

   	function __construct($name = null,$password = null) {
   		if (!empty($name) && !empty($password)) {

   		global $CONF;

      	$login = $name.$CONF['domain'];
      	$password = $password;
      	$username = $name;


   		//подсоединяемся к LDAP серверу
     	$ldap = ldap_connect($CONF['ldaphost'],$CONF['ldapport']);
 		//Включаем LDAP протокол версии 3
    	ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    	//ограничение по времени
		ldap_set_option($ldap, LDAP_OPT_NETWORK_TIMEOUT, 3);

      		if ($ldap){
            	// Пытаемся войти в LDAP при помощи введенных логина и пароля
            	$bind = ldap_bind($ldap,$login,$password);
            	        if ($bind){

            	           	$result = ldap_search($ldap,$CONF['domain_base'],"(&(objectCategory=person)(objectClass=user)(samaccountname=".$username."))");
                  			// Получаем количество результатов предыдущей проверки
							$result_ent = ldap_get_entries($ldap,$result);

								foreach($result_ent as $key=>$value){

								$infa['fio']=$value['cn'][0];	
								$infa['displayname']=$value['displayname'][0];	// kak zamena fio	
								$infa['name']=$value['name'][0];	// kak zamena fio	
								$infa['gorod']=$value['l'][0];		
								$infa['doljnost']=$value['title'][0];	
								$infa['postalcode']=$value['postalcode'][0];
								$infa['telephonenumber']=$value['telephonenumber'][0];
								$infa['department']=$value['department'][0];
								$infa['company']=$value['company'][0];
								$infa['podchenennie']=$value['directreports'];
								$infa['samaccountname']=$value['samaccountname'][0];
								$infa['branch']=$value['division'][0];
								$infa['email']=$value['mail'][0];
								$infa['ipphone']=$value['ipphone'][0];
								$infa['nachalnik']=$value['manager'][0];
								$infa['tvbv']=$value['extensionattribute9'][0]; //kak zamena department
								$infa['otdel']=$value['extensionattribute10'][0];
								$infa['sektor']=$value['extensionattribute11'][0];
								$infa['priniatnarabotu']=$value['extensionattribute2'][0];
								$infa['datarojdenie']=$value['extensionattribute7'][0];
								$infa['memberof']=$value['memberof'];	

								}
								$infa['password']=$password;
								$this->inf=$infa;

                		} else { 
                			$this->error_text='<div class="alert alert-danger">
           					<center>Вы ввели неправильный логин или пароль, либо сервер недоступен, попробуйте еще раз.<br> <small><a href="/">назад</a></small></center></div>';
                				}
				} else { 
					$this->error_text='<div class="alert alert-danger">
					<center>Нет связи с сервером.<br> <small><a href="/">назад</a></small></center></div>';
						}

			} else {
				$this->error_text='<div class="alert alert-danger">
				<center>Не чуди.<br> <small><a href="/">назад</a></small></center></div>';
					}
 	}


 	function show_infa(){
 		$infa=$this->inf;
 		 	if(!empty($infa)){
				echo "<pre>";
				 	print_r($infa);	
				echo "</pre>"; 	
			}
 	}

 	function return_infa(){
 		return $infa=$this->inf;	
 	}


 	function register(){
 		$infa=$this->inf;
 		if(!empty($infa)){
	 		global $db;

	 			$stmt = $db->prepare('INSERT INTO `users` (`login`, `pass`, `fio`, `email`, `tvbv`, `phone`, `posada`, `infa`) VALUES (?,?,?,?,?,?,?,?)');
	    		$stmt->execute(array($infa['samaccountname'], $infa['password'], $infa['fio'], $infa['email'], $infa['tvbv'], $infa['telephonenumber'], $infa['doljnost'], serialize($infa) ));

	    		$this->error_text='<div class="alert alert-success">
	    		<center>Вы были успешно зарегестрированы.<br> <small><a href="/">назад</a></small></center></div>';
	    }
 	}

 	function login(){
 		$infa=$this->inf;
 		if(!empty($infa)){
	 		global $db;

	 			$stmt = $db->prepare('UPDATE `users` set `pass` = ?, `infa` = ? where login = ?');
	    		$stmt->execute(array($infa['password'], serialize($infa), $infa['samaccountname'] ));
    	}
 	}

}

/*
$domen = new Domen('karpecao','T,fnmvjqvjpu123');

// Данные о пользователе с домена
print_r($domen->return_infa());
// Регистрация пользователя
$domen->register();
*/


?>