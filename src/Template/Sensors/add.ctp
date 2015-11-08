<?php
$this->assign('title', "Czujniki temperatury");
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Opcje') ?></li>
        <li><?= $this->Html->link(__('Lista czujników'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="sensors form large-9 medium-8 columns content">
    <?= $this->Form->create($sensor) ?>
    <fieldset>
        <legend><?= __('Dodaj nowy czujnik temperatury') ?></legend>
        <?php
            echo $this->Form->input('ip_address', ['label' => 'Adres IP']);
            echo $this->Form->input('description', ['label' => 'Opis']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Dodaj')) ?>
    <?= $this->Form->end() ?>
</div>
