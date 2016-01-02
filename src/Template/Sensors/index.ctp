<?php
$this->assign('title', "Czujniki temperatury");
$logged_user = $this->request->session()->read('Auth.User');
if(!empty($logged_user)) {
	$logged_id = $logged_user['id'];
	$logged_username = $logged_user['username'];
	$logged_role = $logged_user['role'];
}
else {
	$logged_id = "";
	$logged_username = "";
	$logged_role = "";
}
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Opcje') ?></li>
		<?php
			if($logged_role == 'admin'){
				echo '<li>' . $this->Html->link(__('Nowy czujnik'), ['action' => 'add']) . '</li>';
			}
		?>
    </ul>
</nav>
<div class="sensors index large-9 medium-8 columns content">
    <h3><?= __('Lista czujników temperatury') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
				<th><?= $this->Paginator->sort('device_id', 'ID sensora') ?></th>
                <th><?= $this->Paginator->sort('ip_address', 'Adres IP') ?></th>
                <th><?= $this->Paginator->sort('created', 'Dodany') ?></th>
                <th><?= $this->Paginator->sort('modified', 'Ostatnia modyfikacja') ?></th>
				<th><?= $this->Paginator->sort('description', ['label' => 'Opis']) ?></th>
                <th class="actions"><?= __('Opcje') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sensors as $sensor): ?>
            <tr>
				<td><?= $this->Number->format($sensor->device_id) ?></td>
                <td><?= h($sensor->ip_address) ?></td>
                <td><?= h($sensor->created) ?></td>
                <td><?= h($sensor->modified) ?></td>
				<td><?= h($sensor->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Zobacz'), ['action' => 'view', $sensor->device_id]) ?>
					<?php
						if($logged_role == 'admin'){
					?>
							<?= $this->Html->link(__('Edytuj'), ['action' => 'edit', $sensor->device_id]) ?>
							<?= $this->Form->postLink(__('Usuń'), ['action' => 'delete', $sensor->device_id], ['confirm' => __('Czy na pewno usunąć czujnik o ID #{0}?', $sensor->device_id)]) ?>
					<?php
						}
					?>
                    
                </td>
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
