<?php
$this->assign('title', "Temperatury");
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
		<li><?= $this->Html->link(__('Wykres temperatur'), ['action' => 'chart']) ?></li>
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
</table>
<?php echo $this->Form->end();?>


<h3><?= __('Temperatury') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id', ['label' => 'ID temperatury']) ?></th>
                <th><?= $this->Paginator->sort('sensor_id', ['label' => 'ID czujnika']) ?></th>
                <th><?= $this->Paginator->sort('temp', ['label' => 'Temperatura [°C]']) ?></th>
                <th><?= $this->Paginator->sort('created', ['label' => 'Dodana']) ?></th>
                <th><?= $this->Paginator->sort('description', ['label' => 'Opis']) ?></th>
                <!--<th><?= $this->Paginator->sort('modified') ?></th>-->
                <!--<th class="actions"><?= __('Actions') ?></th>-->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($temps as $temp): ?>
            <tr>
                <td><?= $this->Number->format($temp->id) ?></td>
                <td><?= $temp->has('sensor') ? $this->Html->link($temp->sensor->device_id, ['controller' => 'Sensors', 'action' => 'view', $temp->sensor->device_id]) : '' ?></td>
                <td><?= $this->Number->format($temp->temp) ?></td>
                <td><?= h($temp->created) ?></td>
				<td><?= h($temp->description) ?></td>
                <!--<td><?= h($temp->modified) ?></td>-->
                <!--<td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $temp->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $temp->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $temp->id], ['confirm' => __('Are you sure you want to delete # {0}?', $temp->id)]) ?>
                </td>-->
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('poprzednia')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('następna') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter('Strona {{page}} z {{pages}}') ?></p>
    </div>
</div>
