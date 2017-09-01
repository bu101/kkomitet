<?

static $CONF = array(

//ip адрес или название сервера ldap(AD)
'ldaphost'=>'10.1.92.10',
//Порт подключения
'ldapport'=>'389',
//Полный путь к группе которой должен принадлежать человек, что бы пройти аутентификацию. 
'domain_memberof'=>'CN=GR.18.ALL,OU=Groups,OU=Sumy,OU=Bank,DC=oschadbank,DC=ua',
//Откуда начинаем искать 
'domain_base'=>'OU=Sumy,OU=Bank,DC=oschadbank,DC=ua',
//Собственно говоря фильтр по которому будем аутентифицировать пользователя
'domain_filter'=>'sAMAccountName=',
//Ваш домен, обязательно с собакой впереди. Необходим этот параметр 
//для авторизации через AD, по другому к сожалению работать не будет.
'domain'=>'@oschadbank.ua',
//
'db_name'=>'kkomitet',
//
'db_host'=>'localhost',
//
'db_login'=>'root',
//
'db_password'=>'T,fnmvjqvjpu1',
//
'db_charset'=>'utf8',
//
'hostname'=>'http://kkomitet/',
// Разрешить регистрацию
'first_login'=>'true',





''=>''
);


?>