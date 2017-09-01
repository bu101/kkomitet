
    <div class="container-fluid">
        <div class="col-md-12 text-center">
            <p class="text-muted credit"><small><a href="mailto:karpecao@oschadbank.ua">Письмо разработчику </a>(с) 2017.</p>
            </small>
        </div>
    </div>

<script src="<?=$CONF['hostname']?>js/jquery-1.11.0.min.js"></script>

<script src="<?=$CONF['hostname']?>js/bootstrap.min.js"></script>

<script src="<?=$CONF['hostname']?>js/core.js?v0"></script>

</body>
</html>


<?

if (!empty($_SERVER['HTTP_CLIENT_IP'])){
  $ip=$_SERVER['HTTP_CLIENT_IP'];
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
{
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
{
  $ip=$_SERVER['REMOTE_ADDR'];
}

?>
