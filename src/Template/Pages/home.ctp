<?php
$this->assign('title', "Strona główna");
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Menu') ?></li>
        <li><?= $this->Html->link(__('Temperatury'), ['controller' => 'Temps', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Czujniki temperatur'), ['controller' => 'Sensors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Użytkownicy'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
    </ul>
</nav>

