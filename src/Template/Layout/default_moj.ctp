<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = __d('cake_dev', 'Prace dyplomowe');
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $cakeDescription ?>:
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('cake.generic');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        $user = $this->Session->read('Auth.User');
        $url = $this->here;
        ?>
    </head>
    <body>

        <div id="container">
            <div id="header">
                <?php echo $this->Html->image('banner3.png', array('url' => array('controller' => 'works', 'action' => 'main'))); ?>
            </div>
            <div id="menu">

                <ul id="mainmenu">
                    <?php
                    if (!(strstr($this->here, "users") || strstr($this->here, "works"))) {
                        echo '<li class="current">' . $this->Html->link("STRONA GŁÓWNA", array('controller' => 'works', 'action' => 'main')) . '</li>';
                    } else {
                        echo '<li>' . $this->Html->link("STRONA GŁÓWNA", array('controller' => 'works', 'action' => 'main')) . '</li>';
                    }
                    if ($user['role'] === 'Administrator') {            //administrator
                        if ((strstr($this->here, "works"))) {
                            echo '<li class="current">' . $this->Html->link("TEMATY", array('controller' => 'works', 'action' => 'index'));
                        } else {
                            echo '<li>' . $this->Html->link("TEMATY", array('controller' => 'works', 'action' => 'index'));
                        }
                        echo '<ul>';
                        echo '<li>' . $this->Html->link("LISTA TEMATÓW", array('controller' => 'works', 'action' => 'index')) . '</li>';
                        echo '<li>' . $this->Html->link("DODAJ", array('controller' => 'works', 'action' => 'add')) . '</li>';
                        echo '</ul>';
                        echo '</li>';

                        if (($this->params['controller'] === 'users') && !(strstr($this->here, "users/view/" . $user['id']) || strstr($this->here, "users/edit/" . $user['id']))) {
                            echo '<li class="current">' . $this->Html->link("UŻYTKOWNICY", array('controller' => 'users', 'action' => 'index'));
                        } else {
                            echo '<li>' . $this->Html->link("UŻYTKOWNICY", array('controller' => 'users', 'action' => 'index'));
                        }
                        echo '<ul>';
                        echo '<li>' . $this->Html->link("LISTA UŻYTKOWNIKÓW", array('controller' => 'users', 'action' => 'index')) . '</li>';
                        echo '<li><a>DODAJ</a><i class="arrow"></i>';
                        echo '<ul>';
                        echo '<li>' . $this->Html->link("Administratora", array('controller' => 'users', 'action' => 'add_admin')) . '</li>';
                        echo '<li>' . $this->Html->link("Profesora", array('controller' => 'users', 'action' => 'add_profesor')) . '</li>';
                        echo '<li>' . $this->Html->link("Studenta", array('controller' => 'users', 'action' => 'add_student')) . '</li>';
                        echo '</li></ul>';
                        echo '</ul>';
                        echo '</li>';
                    } elseif ($user['role'] === 'Profesor') {                             //profesor
                        if ((strstr($this->here, "works"))) {
                            echo '<li class="current">' . $this->Html->link("TEMATY", array('controller' => 'works', 'action' => 'index'));
                        } else {
                            echo '<li>' . $this->Html->link("TEMATY", array('controller' => 'works', 'action' => 'index'));
                        }
                        echo '<ul>';
                        echo '<li>' . $this->Html->link("LISTA TEMATÓW", array('controller' => 'works', 'action' => 'index')) . '</li>';
                        echo '<li>' . $this->Html->link("DODAJ", array('controller' => 'works', 'action' => 'add')) . '</li>';
                        echo '<li>' . $this->Html->link("TWOJE TEMATY", array('controller' => 'works', 'action' => 'index2')) . '</li>';
                        echo '</ul>';
                        echo '</li>';
                    } else { //if ($user['role'] === 'student')                              //niezalogowani i studenci
                        if ((strstr($this->here, "works"))) {
                            echo '<li class="current">' . $this->Html->link("TEMATY", array('controller' => 'works', 'action' => 'index'));
                        } else {
                            echo '<li>' . $this->Html->link("TEMATY", array('controller' => 'works', 'action' => 'index'));
                        }
                        echo '<ul>';
                        echo '<li>' . $this->Html->link("LISTA TEMATÓW", array('controller' => 'works', 'action' => 'index')) . '</li>';
                        if ($user['role'] === 'Student') {
                            echo '<li>' . $this->Html->link("TWÓJ TEMAT", array('controller' => 'works', 'action' => 'find_your_work', $user['id'])) . '</li>';
                        }
                        echo '</ul>';
                        echo '</li>';
                    }

                    if (!empty($user)) {
                        if (strstr($this->here, "users/view/" . $user['id']) || strstr($this->here, "users/edit_profesor/" . $user['id']) || strstr($this->here, "users/edit_student/" . $user['id']) || strstr($this->here, "users/edit_admin/" . $user['id']) || strstr($this->here, "users/login") || strstr($this->here, "users/register") || strstr($this->here, "users/edit/" . $user['id']) || strstr($this->here, "users/edit_stud/" . $user['id'])) {
                            echo '<li class="current">' . $this->Html->link('ZALOGOWANY: ' . $user['username'], array('controller' => 'users', 'action' => 'view', $user['id']));
                        } else {
                            echo '<li>' . $this->Html->link('ZALOGOWANY: ' . $user['username'], array('controller' => 'users', 'action' => 'view', $user['id']));
                        }
                        echo '<ul>';
                        echo '<li>' . $this->Html->link('TWÓJ PROFIL', array('controller' => 'users', 'action' => 'view', $user['id'])) . '<i class="arrow"></i>';
                        echo '<ul>';
                        echo '<li>' . $this->Html->link('Zobacz', array('controller' => 'users', 'action' => 'view', $user['id'])) . '</li>';
                        if ($user['role'] === 'Profesor') {
                            echo '<li>' . $this->Html->link('Edytuj', array('controller' => 'users', 'action' => 'edit_profesor', $user['id'])) . '</li>';
                        }
                        if ($user['role'] === 'Student') {
                            echo '<li>' . $this->Html->link('Edytuj', array('controller' => 'users', 'action' => 'edit_student', $user['id'])) . '</li>';
                        }
                        if ($user['role'] === 'Administrator') {
                            echo '<li>' . $this->Html->link('Edytuj', array('controller' => 'users', 'action' => 'edit_admin', $user['id'])) . '</li>';
                        }
                        echo '</li></ul>';
                        echo '<li>' . $this->Html->link("WYLOGUJ SIĘ", array('controller' => 'users', 'action' => 'logout')) . '</li>';
                        echo '</ul>';
                        echo '</li>';
                    } else {
                        if (strstr($this->here, "users/view") || strstr($this->here, "users/login") || strstr($this->here, "users/register")) {
                            echo '<li class="current">' . $this->Html->link("ZALOGUJ SIĘ", array('controller' => 'users', 'action' => 'login'));
                        } else {
                            echo '<li>' . $this->Html->link("ZALOGUJ SIĘ", array('controller' => 'users', 'action' => 'login'));
                        }

                        echo '<ul>';
                        echo '<li>' . $this->Html->link("REJESTRACJA", array('controller' => 'users', 'action' => 'register')) . '</li>';
                        echo '</ul>';
                        echo '</li>';
                    }
                    ?>
                </ul>

            </div>


            <div id="content">

                <?php echo $this->Session->flash(); ?>

                <?php echo $this->fetch('content'); ?>
            </div>
            <div id="footer">
                <small>Marcin Klimkiewicz</small><br>
                <small><?php echo $this->Html->link('127119@stud.prz.edu.pl', 'mailto:127119@stud.prz.edu.pl'); ?></small>
            </div>
        </div>
    </body>
</html>
