<?php
$this->assign('title', "Temperatury");
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Opcje') ?></li>
        <li><?= $this->Html->link(__('Lista czujników temperatury'), ['controller' => 'Sensors', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="temps index large-9 medium-8 columns content">
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
                <td><?= $temp->has('sensor') ? $this->Html->link($temp->sensor->id, ['controller' => 'Sensors', 'action' => 'view', $temp->sensor->id]) : '' ?></td>
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
