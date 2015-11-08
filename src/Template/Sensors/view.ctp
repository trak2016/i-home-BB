<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sensor'), ['action' => 'edit', $sensor->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sensor'), ['action' => 'delete', $sensor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sensor->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sensors'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sensor'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Temps'), ['controller' => 'Temps', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Temp'), ['controller' => 'Temps', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="sensors view large-9 medium-8 columns content">
    <h3><?= h($sensor->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Ip Address') ?></th>
            <td><?= h($sensor->ip_address) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($sensor->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($sensor->created) ?></tr>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($sensor->modified) ?></tr>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($sensor->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Temps') ?></h4>
        <?php if (!empty($sensor->temps)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Sensor Id') ?></th>
                <th><?= __('Temp') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($sensor->temps as $temps): ?>
            <tr>
                <td><?= h($temps->id) ?></td>
                <td><?= h($temps->sensor_id) ?></td>
                <td><?= h($temps->temp) ?></td>
                <td><?= h($temps->description) ?></td>
                <td><?= h($temps->created) ?></td>
                <td><?= h($temps->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Temps', 'action' => 'view', $temps->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Temps', 'action' => 'edit', $temps->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Temps', 'action' => 'delete', $temps->id], ['confirm' => __('Are you sure you want to delete # {0}?', $temps->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
