<?

include_once('conf.php');
include_once('auth/domen.php');


date_default_timezone_set('Europe/Kiev');
$db = new PDO(
    'mysql:host='.$CONF['db_host'].';dbname='.$CONF['db_name'],
    $CONF['db_login'],
    $CONF['db_password'],
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);


function validate_user($user_id, $input) {

    global $db;

    if (!isset($_SESSION['code'])) {

        if (isset($_COOKIE['authhash_code'])) {
            $user_id=$_COOKIE['authhash_uid'];
            $input=$_COOKIE['authhash_code'];
            $_SESSION['code']=$input;
            $_SESSION['user_id']=$user_id;
        }
    }

    $stmt = $db->prepare('SELECT pass,login,fio from users where id=:user_id LIMIT 1');
    $stmt->execute(array(':user_id' => $user_id));

    if ($stmt -> rowCount() == 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //$row = mysql_fetch_assoc($sql);
        $dbpass=md5($row['pass']);
        $_SESSION['user_login'] = $row['login'];
        $_SESSION['user_fio'] = $row['fio'];
        //$_SESSION['helpdesk_sort_prio'] == "none";
        if ($dbpass == $input) { return true;}
        else { return false;}
    }
}

function priv_status($input) {
    global $db;

    $stmt = $db->prepare('SELECT priv FROM users where id=:input');
    $stmt->execute(array(':input' => $input));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return ($row['priv']);
}

function name_of_user_ret($input) {
    global $db;

    $stmt = $db->prepare('SELECT fio FROM users where id=:input');
    $stmt->execute(array(':input' => $input));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return($row['fio']);
}


?>