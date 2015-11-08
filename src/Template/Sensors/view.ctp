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
				echo '<li>' . $this->Html->link(__('Nowy'), ['action' => 'add']) . '</li>';
				echo '<li>' . $this->Html->link(__('Edytuj'), ['action' => 'edit', $sensor->id]) . '</li>';
				echo '<li>' . $this->Form->postLink(__('Usuń czujnik'), ['action' => 'delete', $sensor->id], ['confirm' => __('Czy na pewno usunąć czujnik temperatury o ID #{0}?', $sensor->id)]) . '</li>';
				echo '<li>' . $this->Html->link(__('Lista czujników'), ['action' => 'index']) . '</li>';
			}
		?>
    </ul>
</nav>
<div class="sensors view large-9 medium-8 columns content">
    <h3><?= 'ID czujnika: ', h($sensor->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Adres IP') ?></th>
            <td><?= h($sensor->ip_address) ?></td>
        </tr>
        <tr>
            <th><?= __('ID w bazie danych') ?></th>
            <td><?= $this->Number->format($sensor->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Dodany') ?></th>
            <td><?= h($sensor->created) ?></tr>
        </tr>
        <tr>
            <th><?= __('Ostatnia modyfikacja') ?></th>
            <td><?= h($sensor->modified) ?></tr>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Opis') ?></h4>
        <?= $this->Text->autoParagraph(h($sensor->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Powiązane temperatury') ?></h4>
        <?php if (!empty($sensor->temps)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= $this->Paginator->sort('id', ['label' => 'ID temperatury']) ?></th>
                <th><?= $this->Paginator->sort('temp', ['label' => 'Temperatura [°C]']) ?></th>
                <th><?= $this->Paginator->sort('created', ['label' => 'Dodana']) ?></th>
                <th><?= $this->Paginator->sort('description', ['label' => 'Opis']) ?></th>
            </tr>
            <?php foreach ($sensor->temps as $temps): ?>
            <tr>
                <td><?= h($temps->id) ?></td>
                <td><?= h($temps->temp) ?></td>
                <td><?= h($temps->description) ?></td>
                <td><?= h($temps->created) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
