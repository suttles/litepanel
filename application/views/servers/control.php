<?php
/*
* @LitePanel
* @Developed by QuickDevel
*/
?>
<?php echo $header ?>
	<ul class="nav nav-tabs">	
		<li <?if($_GET['nav'] == ''):?>class="active"<?endif?>><a href="http://server-css.ru/servers/control/index/<?php echo $server['server_id'] ?>?nav=">Настройка сервера</a></li>	
		<li <?if($_GET['nav'] == 'ftp'):?>class="active"<?endif?>><a href="http://server-css.ru/servers/control/index/<?php echo $server['server_id'] ?>?nav=ftp">FTP</a></li>	
		<li <?if($_GET['nav'] == 'stats'):?>class="active"<?endif?>><a href="http://server-css.ru/servers/control/index/<?php echo $server['server_id'] ?>?nav=stats">Статистика</a></li>
		<li <?if($_GET['nav'] == 'console'):?>class="active"<?endif?>><a href="http://server-css.ru/servers/control/index/<?php echo $server['server_id'] ?>?nav=console">Консоль</a></li>
		<li <?if($_GET['nav'] == 'mysql'):?>class="active"<?endif?>><a href="http://server-css.ru/servers/control/index/<?php echo $server['server_id'] ?>?nav=mysql">MySQL</a></li>
		<li <?if($_GET['nav'] == 'resources'):?>class="active"<?endif?>><a href="http://server-css.ru/servers/control/index/<?php echo $server['server_id'] ?>?nav=resources">Ресуры сервера</a></li>
	</ul>
	<?if($_GET['nav'] == ''):?>
	<?$players = floor($query['players'] / $server['server_slots'] * 100);?>
	<div class="docs-example" alt="<?php echo $query['hostname'] ?>" style="font-size:12px;">
	<table class="table table-bordered">
		<tbody><tr>
			<td width="160px" rowspan="13">
				<div align="center" style="position:relative; margin-bottom:5px; padding: 5px; border: 1px solid rgb(221, 221, 221); float: none;">
				<?if($server['game_name'] == 'Counter-Strike 1.6'):?>
				<img style="position:relative;" src="/application/public/img/cs16.png">
				<?endif?>
				<?if($server['game_name'] == 'San Andreas Multiplayer'):?>
				<img style="position:relative;" src="/application/public/img/samp.png">
				<?endif?>
				<?php if($server['server_status'] == 1): ?> 
				<div style="position:absolute; top:50px; font-weight:bold; text-transform:uppercase; background-color:#FFF; height:20px; width:150px;">
				Выключен
				</div>
                <?endif?>
				</div>
				<center>
				<div class="btn-group-vertical" id="controlBtns">
					<?php if($server['server_status'] == 1): ?> 
					<button class="btn btn-success" onClick="sendAction(<?php echo $server['server_id'] ?>,'start')"><i class="icon-off"></i> Включить</button>
					<button class="btn btn-warning" onClick="openReinstall()"><i class="icon-refresh"></i> Переустановить</button>
					<?php elseif($server['server_status'] == 2): ?> 
					<button class="btn btn-danger" onClick="sendAction(<?php echo $server['server_id'] ?>,'stop')"><i class="icon-remove"></i> Выключить</button>
					<button class="btn btn-warning" onClick="sendAction(<?php echo $server['server_id'] ?>,'restart')"><i class="icon-refresh"></i> Перезапустить</button>
					<?php endif; ?> 
					<button class="btn btn-info" onclick="document.location='/servers/pay/index/<?php echo $server['server_id'] ?>'"><i class="icon-shopping-cart"></i> Продлить</button>
				</div>
                </center>
            </td>
			<?php if($query): ?> 
			<td>Название:</td>
            <td><?php echo $query['hostname'] ?></td>
			<?endif?>
        </tr>
		<tr><td>Игра:</td><td><?if($server['game_name'] == 'Counter-Strike 1.6'):?><img src="/application/public/img/icons/cs16.png"><?endif?><?if($server['game_name'] == 'San Andreas Multiplayer'):?><img src="/application/public/img/icons/samp.png"><?endif?> <?=$server['game_name']?></td></tr>
		<tr><td>IP:</td><td><?php echo $server['location_ip'] ?>:<?php echo $server['server_port'] ?></td></tr>
		<tr><td>Адрес сервера:</td><td>server-css.ru:<?php echo $server['server_port'] ?></td></tr>
		<?php if($query): ?> 
		<tr><td>Сейчас играют:</td><td>
		<div style="position: relative; width:230px;">
			<div class="progress progress-success progress-striped active" style="margin-bottom: 0px;">
				<div class="bar" style="width: <?=$players?>%"></div>
				<div style="position: absolute;width: 100%;"><center><?=$query['players']?> / <?=$query['maxplayers']?></center></div>
			</div>
		</div></td></tr>
		<?endif?>
		<tr><td>Всего слотов</td><td><?=$server['server_slots']?></td></tr>
        <tr><td>Локация:</td><td><?php echo $server['location_name'] ?></td></tr>
        <tr><td>OC:</td><td>Linux <img src="/application/public/img/Linux.png"></td></tr>
        <tr><td>Оплачен до:</td><td><?php echo date("d.m.Y", strtotime($server['server_date_end'])) ?></td></tr>

    </tbody></table>
	</div>
	<?endif?>
	<?if($_GET['nav'] == 'ftp'):?>
	<div class="docs-example" alt="Параметры доступа FTP" style="font-size:12px;">
	<table class="table table-bordered">
		<tr><td>Адрес для доступа по протоколу FTP:</td><td><?php echo $server['location_ip'] ?>:21</td></tr>
		<tr><td>Логин:</td><td>gs<?php echo $server['server_id'] ?></td></tr>
		<tr><td>Пароль:</td><td><?php echo $server['server_password'] ?></td></tr>
	</table>
	</div>
	<?endif?>
	<?if($_GET['nav'] == 'resources'):?>
	<div class="docs-example" alt="Статистика использования ресурсов сервера" style="font-size:12px; margin-top:0px;">
	<table class="bordered" style="margin-bottom:0px;">
		<tbody>
			<tr>
				<td width="32px"><img src=""></td>
				<td>Нагрузка на ядро процессора (CPU)</td>
				<td width="0%">
					<!--{cpu} / {cpu_max}-->
					<div class="progress progress-striped" style="margin-bottom: 0px; background: #E4E2F6;">
						<div class="bar" style="width: <?=$server['server_cpu_load']?>%;"></div>
					</div>
					<font size="1">Нагрузка: <b><?=$server['server_cpu_load']?>%</b></font>
				</td>
			</tr>
			<tr>
				<td width="32px"><img src=""></td>
				<td>Оперативная память</td>
				<td width="50%">
					<!--{mem_proc} / {mem_max}-->
					<div class="progress progress-striped" style="margin-bottom: 0px; background: #E4E2F6">
						<div class="bar" style="width: <?=$server['server_ram_load']?>%;"></div>
					</div>
					<font size="1">Нагрузка: <b><?=$server['server_ram_load']?>%</b></font>
				</td>
			</tr>
			<tr>
				<td width="32px"><img src=""></td>
				<td>Дисковая квота</td>
				<td width="50%">
					<div class="progress progress-striped" style="margin-bottom: 0px; background: #E4E2F6;">
						<div class="bar" style="width: 32%;"></div>
					</div>
					<font size="1">Доступно: <b>500</b> Mb. Использовано: <b>69</b> Mb (<b>32%</b>)</font>
				</td>
			</tr>
		</tbody>
	</table>
</div>
	<?endif?>
	<?if($_GET['nav'] == 'mysql'):?>
	<script type="text/javascript">
$.post(
  "/includes/mysql.php",
  {
    gid: {id},
    code: "{code}"
  },
  getinfo
);

function getinfo(idata)
{
if(idata=="no"){
$("#mysqlb").show();
}else{
document.getElementById("mysqltext").innerHTML=idata;
$("#mysqlb").hide();
$("#mysqltext").show();
}
}

function go_get() {

var a=document.getElementById("mysqlb");
a.value = 'Создаём базу данных...';
a.disabled = 1;
$.post(
  "/includes/mysql.php",
  {
    gid: {id},
    code: "{code}",
    go: {id}
  },
  onAjaxSuccess
);
}

function onAjaxSuccess(data)
{
	document.getElementById("mysqltext").innerHTML=data;
	$("#mysqlb").animate({ opacity: 'hide' }, "fast");
	$("#mysqltext").show("slow");
}

function log_out_and_login(form) {
	$.ajax({
		url: '/chive/site/logout',
		data: null,
		success: function(){
			$('#mysqlLogin').submit();
		},
		type: 'GET'
	});
}
</script>
	<div class="docs-example" alt="Параметры доступа MySQL" style="font-size:12px;">
	<table class="table table-bordered">
		<tr><td>Адрес для доступа MySQL:</td><td><?php echo $server['location_ip'] ?></td></tr>
		<tr><td>ID MySQL:</td><td>bd<?php echo $server['server_id'] ?></td></tr>
		<tr><td>Логин:</td><td>user<?php echo $server['server_id'] ?></td></tr>
		<tr><td>Пароль:</td><td><?php echo $server['server_password'] ?></td></tr>
		<tr><td>Дата регистрации MySQL:</td><td><?php echo $server['server_date_reg'] ?></td></tr>
	</table>
	<button class="btn btn-info" onclick="document.location='/chive/'"><i class="icon-shopping-cart"></i> Авторизация в ПУ (Chive)</button>
	</div>
   	<?endif?>
	<?if($_GET['nav'] == 'console'):?>
	<div class="docs-example" alt="Консоль сервера" style="font-size:12px;"></ul></div>
       <div id="content-base"><script type="text/javascript">
         function reset_console() {
	    var autoscroll = document.getElementById("autoscroll");
    	    if (autoscroll.checked==false)
	    {
	        setTimeout(reset_console,1000);
		return false;
	    }
	    $.get("/servers/console_form<?php $server['server_id'] ?>")
    	    .done(function(data) {
	    console_block(data);
	    setTimeout(reset_console,1000);
	    });
         }
    
        function console_block(text_console) {
    	    var console = document.getElementById("console_div");
            console.innerHTML =  text_console;
    	    console.scrollTop = console.scrollHeight;
    	    return false;
        }

$(document).ready(function() {
reset_console();
});
</script>
<div style="overflow: hidden;"><textarea rows="40" id="console_div" style="max-width: 770px; height: 370px; width: 770px; background-color: #000; border: 1px solid rgba(5, 5, 5, 0.26); color: #E0E0E0; overflow: auto;">
</textarea></div>
<form action="#" onsubmit="return cmdconsole(this); reset_console();" style="margin-bottom:10px;"> 
	<div style="position: absolute;background-color: #F5F5F5;border: 1px solid rgba(178, 176, 176, 0.36);padding: 5px;border-radius: 5px;margin-left: 10px;">
		<input type="checkbox" checked="" id="autoscroll" style="margin: 3px 0 0 10px;position: absolute;">
		<span style="margin-left: 30px;">Обновление</span>
	</div>
	<?php/*
    $ftp_host = '37.143.15.236:21'; 
    $ftp_user = "gs2"; 
    $ftp_pass = 'server.cfg'; 
    $banfile = "server_log.txt";
    
    $con = ftp_connect($ftp_host) or die("Couldnt connect to your ftp (check your settings!");
    ftp_login($con, $ftp_user, $ftp_pass);
    ftp_get($con, "server_log.txt", $banfile, FTP_ASCII);
    ftp_close($con);
    
    $file = fopen("server_log.txt", "r");
    $bans = fread($file, filesize("server_log.txt"));
    fclose($file);
    
    echo nl2br($bans);
	?>
	<?
	/*
	<h2>Редактирование сервера</h2>
	<form class="form-horizontal" action="#" id="editForm" method="POST">
		<fieldset>
			<div id="legend">
				<legend>Пароль</legend>
			</div>
			<div class="control-group">
				<div class="controls">
				<label><input type="checkbox" id="editpassword" name="editpassword" onChange="togglePassword()"> Сменить пароль?</label>
			</div>
			</div>
				<div class="control-group">
				<!-- Пароль -->
				<label class="control-label" for="password">Пароль</label>
				<div class="controls">
					<input type="password" id="password" name="password" class="input-xlarge" disabled>
				</div>
			</div>
			<div class="control-group">
				<!-- Повтор пароля -->
				<label class="control-label" for="password">Повторите пароль</label>
				<div class="controls">
					<input type="password" id="password2" name="password2" class="input-xlarge" disabled>
				</div>
			</div>
			<div class="control-group">
				<!-- Кнопка -->
				<div class="controls">
					<button class="btn btn-success"><i class="icon-ok"></i> Сохранить</button>
				</div>
			</div>
		</fieldset>
	</form>
	*/?>
	<?endif?>
	<?if($_GET['nav'] == 'stats'):?>
	<?php if($server['server_status'] == 2): ?>
	<table class="table table-striped table-condensed">
		<?php if($query): ?> 
		<tr>
			<th scope="row">Название</th>
			<td><?php echo $query['hostname'] ?></td>
		</tr>
		<tr>
			<th scope="row">Игроки</th>
			<td><?php echo $query['players'] ?> / <?php echo $query['maxplayers'] ?></td>
		</tr>
		<tr>
			<th scope="row">Игровой режим</th>
			<td><?php echo $query['gamemode'] ?></td>
		</tr>
		<tr>
			<th scope="row">Карта</th>
			<td><?php echo $query['mapname'] ?></td>
		</tr>
		<?php endif; ?>
	</table>
	<div class="well well-large">
		<div id="statsGraph" style="height: 220px;"></div>
	</div>
	<?php endif; ?>
	<?php if($server['server_status'] != 2): ?>
	<div class="alert alert-errorno">Сервер выключен. Статистика недоступна!</div>
	<?endif?>
	<?endif?>
	<!-- Подтверждение переустановки -->
	<div class="modal hide" id="reinstallServer">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3>Переустановка сервера</h3>
		</div>
		<div class="modal-body">
			<p>Вы уверенны, что Вы хотите переустановить сервер? Все данные будут потеряны.</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</a>
			<a href="#" class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onClick="sendAction(<?php echo $server['server_id'] ?>,'reinstall')">Переустановить</a>
		</div>
	</div>
	<!-- /Подтверждение переустановки -->
	
	<script>
		var serverStats = [
			<?php foreach($stats as $item): ?> 
			[<?php echo strtotime($item['server_stats_date'])*1000 ?>, <?php echo $item['server_stats_players'] ?>],
			<?php endforeach; ?> 
		];
		$.plot($("#statsGraph"), [serverStats], {
			xaxis: {
				mode: "time",
				timeformat: "%H:%M"
			},
			series: {
				lines: {
					show: true,
					fill: true
				},
				points: {
					show: true
				}
			},
			grid: {
				borderWidth: 0
			},
			colors: [ "#49AFCD" ]
		});
		
		function openReinstall(id) {
			$('#reinstallServer').modal('show');
		}
		$('#editForm').ajaxForm({ 
			url: '/servers/control/ajax/<?php echo $server['server_id'] ?>',
			dataType: 'text',
			success: function(data) {
				console.log(data);
				data = $.parseJSON(data);
				switch(data.status) {
					case 'error':
						showError(data.error);
						$('button[type=submit]').prop('disabled', false);
						break;
					case 'success':
						showSuccess(data.success);
						break;
				}
			},
			beforeSubmit: function(arr, $form, options) {
				$('button[type=submit]').prop('disabled', true);
			}
		});
		
		function sendAction(serverid, action) {
			$.ajax({ 
				url: '/servers/control/action/'+serverid+'/'+action,
				dataType: 'text',
				success: function(data) {
					console.log(data);
					data = $.parseJSON(data);
					switch(data.status) {
						case 'error':
							showError(data.error);
							$('#controlBtns button').prop('disabled', false);
							break;
						case 'success':
							showSuccess(data.success);
							setTimeout("reload()", 1500);
							break;
					}
				},
				beforeSend: function(arr, options) {
					if(action == "reinstall") showWarning("Сервер будет переустановлен в течении 10 минут!");
					$('#controlBtns button').prop('disabled', true);
				}
			});
		}
		
		function togglePassword() {
			var status = $('#editpassword').is(':checked');
			if(status) {
				$('#password').prop('disabled', false);
				$('#password2').prop('disabled', false);
			} else {
				$('#password').prop('disabled', true);
				$('#password2').prop('disabled', true);
			}
		}
	</script>
<?php echo $footer ?>
