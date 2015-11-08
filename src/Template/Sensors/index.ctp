<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Sensor'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Temps'), ['controller' => 'Temps', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Temp'), ['controller' => 'Temps', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="sensors index large-9 medium-8 columns content">
    <h3><?= __('Sensors') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('ip_address') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sensors as $sensor): ?>
            <tr>
                <td><?= $this->Number->format($sensor->id) ?></td>
                <td><?= h($sensor->ip_address) ?></td>
                <td><?= h($sensor->created) ?></td>
                <td><?= h($sensor->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $sensor->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $sensor->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $sensor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sensor->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
