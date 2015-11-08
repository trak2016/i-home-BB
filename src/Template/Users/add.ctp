<?php
$this->assign('title', "Użytkownik");
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Opcje') ?></li>
        <li><?= $this->Html->link(__('Wszyscy użytkownicy'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Dodaj użytkownika') ?></legend>
        <?php
            echo $this->Form->input('username', ['label' => 'Login']);
            echo $this->Form->input('password', ['label' => 'Hasło']);
            echo $this->Form->input('role', ['label' => 'Typ konta',
				'options' => ['admin' => 'Administrator', 'user' => 'Zwykły użytkownik']]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Dodaj')) ?>
    <?= $this->Form->end() ?>
</div>
