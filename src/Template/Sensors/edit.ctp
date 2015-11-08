<?php
$this->assign('title', "Czujniki temperatury");
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Opcje') ?></li>
        <li><?= $this->Form->postLink(
                __('Usuń ten czujnik'),
                ['action' => 'delete', $sensor->id],
                ['confirm' => __('Czy na pewno usunąć czujnik o ID #{0}?', $sensor->id)]
            )
        ?></li>

    </ul>
</nav>
<div class="sensors form large-9 medium-8 columns content">
    <?= $this->Form->create($sensor) ?>
    <fieldset>
        <legend><?= __('Edytuj dane czujnika temperatury (ID: {0})', $sensor->id) ?></legend>
        <?php
            echo $this->Form->input('ip_address', ['label' => 'Adres IP']);
            echo $this->Form->input('description', ['label' => 'Opis']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Zapisz')) ?>
    <?= $this->Form->end() ?>
</div>
