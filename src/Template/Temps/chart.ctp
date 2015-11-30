<?php
$this->assign('title', "Wykres");
?>

<script>
$(function() {
    $("#date_from").datepicker({
		dateFormat: 'dd-mm-yy'
		}
	);
});

$(function() {
    $("#date_to").datepicker( {
		dateFormat: 'dd-mm-yy'
		}
	);
});

</script>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Opcje') ?></li>
		<li><?= $this->Html->link(__('Lista temperatur'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Lista czujników temperatury'), ['controller' => 'Sensors', 'action' => 'index']) ?></li>
    </ul>
</nav>

<div class="temps index large-9 medium-8 columns content">

<?php echo $this->Form->create('search');?>
<table>
	<tr>
        <td>
			<?php
			$session=$this->request->session()->read('sensor_id');
			$value=isset($session)?$session:'';
			echo '<label for="sensor_id">ID czujnika temperatury</label>';
			echo $this->Form->select('sensor_id', $sensors);
				
			echo $this->Form->input('date_from',['id'=>'date_from', 'type'=>'text', 'label' => 'Data od'] );
			echo $this->Form->input('date_to',['id'=>'date_to', 'type'=>'text', 'label' => 'Data do'] );
			
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $this->Form->input('Filtruj',['type'=>'submit'])?>
		</td>
		<td>
			<?php //echo $this->Form->button('Reset',['type'=>'submit','name'=>'reset'])?>  
			<?php echo $this->Form->input('Reset',['type'=>'submit','name'=>'reset','label'=>false])?> 			
		</td>
	</tr>
	<tr>
		<td>
			<?php //echo $labels; ?>
			<canvas id="myChart" width="800" height="400"></canvas>

		</td>
	</tr>
</table>
<?php echo $this->Form->end();?>

<table>
<tr>
<td>
<?php
echo $this->Chartjs->createChart([
    'Chart' => [
        'id' => 'myChart',
        'type' => 'line'
    ], 
    'Data' => $dataChart,
    'Options' => [
		'maintainAspectRatio' => false,
        'responsive' => false
    ]
]);

?>
</td>
</tr>
</table>
</div>

