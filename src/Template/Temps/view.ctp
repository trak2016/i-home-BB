<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Temp'), ['action' => 'edit', $temp->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Temp'), ['action' => 'delete', $temp->id], ['confirm' => __('Are you sure you want to delete # {0}?', $temp->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Temps'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Temp'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sensors'), ['controller' => 'Sensors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sensor'), ['controller' => 'Sensors', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="temps view large-9 medium-8 columns content">
    <h3><?= h($temp->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Sensor') ?></th>
            <td><?= $temp->has('sensor') ? $this->Html->link($temp->sensor->id, ['controller' => 'Sensors', 'action' => 'view', $temp->sensor->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($temp->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Temp') ?></th>
            <td><?= $this->Number->format($temp->temp) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($temp->created) ?></tr>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($temp->modified) ?></tr>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($temp->description)); ?>
    </div>
</div>
