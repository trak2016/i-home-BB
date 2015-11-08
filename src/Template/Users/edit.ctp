<?php
$this->assign('title', "Użytkownik");
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Opcje') ?></li>
        <li><?= $this->Form->postLink(
                __('Usuń konto'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Czy na pewno usunąć konto użytkownika #{0}?', $user->username)]
            )
        ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edytuj dane użytkownika (ID: {0})', $user->id) ?></legend>
        <?php
            echo $this->Form->input('username', ['label' => 'Login']);
            echo $this->Form->input('password', ['label' => 'Hasło']);
            echo $this->Form->input('role', ['label' => 'Typ konta', 
				'options' => ['admin' => 'Administrator', 'user' => 'Zwykły użytkownik']]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Zapisz')) ?>
    <?= $this->Form->end() ?>
</div>
