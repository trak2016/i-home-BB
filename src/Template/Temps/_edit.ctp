<?php
$this->assign('title', "Temperatura");
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Opcje') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $temp->id],
                ['confirm' => __('Czy na pewno usunąć temperaturę o ID #{0}?', $temp->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Temps'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Sensors'), ['controller' => 'Sensors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sensor'), ['controller' => 'Sensors', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="temps form large-9 medium-8 columns content">
    <?= $this->Form->create($temp) ?>
    <fieldset>
        <legend><?= __('Edit Temp') ?></legend>
        <?php
            echo $this->Form->input('sensor_id', ['options' => $sensors]);
            echo $this->Form->input('temp');
            echo $this->Form->input('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
