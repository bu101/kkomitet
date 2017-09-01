<?
$priv_val = priv_status($_SESSION['user_id']);
$user_id = $_SESSION['user_id'];
?>  
    <div class="container-fluid" style="min-height: 555px;">
        <div class="col-md-12">
	<input type="hidden" id="priv_val" value="<?=$priv_val;?>"> 
	<input type="hidden" id="user_id" value="<?=$user_id;?>"> 

<?		  
		if ($priv_val == "0"){
?>  
	        <div class="row">
	        <div class="col-lg-6 col-lg-offset-3">
	        <center>
	        <h3 style="margin-top: -10px;">У Вас пока не настроены права доступа, модератору уже отправлено сообщение, через некоторое время здесь будет полезная информация :)</h3>
	        </center>
	        </div>
	        </div>


<?		  
		}
?>  
        </div>
    </div>