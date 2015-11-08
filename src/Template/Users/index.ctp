<?php
$this->assign('title', "Użytkownik");
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Opcje') ?></li>
        <li><?= $this->Html->link(__('Nowy'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Użytkownicy') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                <th><?= $this->Paginator->sort('username', 'Login') ?></th>
                <th><?= $this->Paginator->sort('role', 'Typ konta') ?></th>
                <th><?= $this->Paginator->sort('created', 'Utworzono') ?></th>
                <th><?= $this->Paginator->sort('modified', 'Ostatnia modyfikacja') ?></th>
				<th><?= $this->Paginator->sort('description', ['label' => 'Opis']) ?></th>
                <th class="actions"><?= __('Opcje') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= h($user->username) ?></td>
                <td><?= h($user->role) ?></td>
                <td><?= h($user->created) ?></td>
                <td><?= h($user->modified) ?></td>
				<td><?= h($user->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Zobacz'), ['action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__('Edytuj'), ['action' => 'edit', $user->id]) ?>
                    <?= $this->Form->postLink(__('Usuń'), ['action' => 'delete', $user->id], ['confirm' => __('Czy na pewno usunąć konto użytkownika #{0}?', $user->username)]) ?>
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
