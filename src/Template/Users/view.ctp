<?php
$this->assign('title', "Użytkownik");
$logged_user = $this->request->session()->read('Auth.User');
if(!empty($logged_user)) {
	$logged_id = $logged_user['id'];
	$logged_username = $logged_user['username'];
	$logged_role = $logged_user['role'];
}
else {
	$logged_id = "";
	$logged_username = "";
	$logged_role = "";
}
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Opcje') ?></li>
		<?php
			if($logged_role == 'admin'){
				echo '<li>' . $this->Html->link(__('Nowy'), ['action' => 'add']) . '</li>';
				echo '<li>' . $this->Html->link(__('Edytuj'), ['action' => 'edit', $user->id]) . '</li>';
				echo '<li>' . $this->Form->postLink(__('Usuń konto'), ['action' => 'delete', $user->id], ['confirm' => __('Czy na pewno usunąć konto użytkownika #{0}?', $user->username)]) . '</li>';
				echo '<li>' . $this->Html->link(__('Lista użytkowników'), ['action' => 'index']) . '</li>';
			}
		?>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3>Użytkownik: <?= h($user->username) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Login') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th><?= __('Typ konta') ?></th>
            <td><?= h($user->role) ?></td>
        </tr>
        <tr>
            <th><?= __('ID w bazie danych') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Utworzono') ?></th>
            <td><?= h($user->created) ?></tr>
        </tr>
        <tr>
            <th><?= __('Ostatnia modyfikacja') ?></th>
            <td><?= h($user->modified) ?></tr>
        </tr>
    </table>
</div>
