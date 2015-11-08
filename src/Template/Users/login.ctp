<?php
$this->assign('title', "Użytkownik");
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Proszę podać login oraz hasło') ?></legend>
        <?= $this->Form->input('username', ['label' => 'Login']) ?>
        <?= $this->Form->input('password', ['label' => 'Hasło']) ?>
    </fieldset>
<?= $this->Form->button(__('Zaloguj')); ?>
<?= $this->Form->end() ?>
</div>