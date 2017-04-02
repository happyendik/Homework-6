<?php
if (isset($data2)) {
    echo <<<_EOF
<div class="container">
    <table class="table table-bordered">
        <tr>
            <th>Пользователь(логин)</th>
            <th>Имя</th>
            <th>возраст</th>
            <th>описание</th>
            <th>Фотография</th>
            <th>Действия</th>
        </tr>
_EOF;
    foreach ($data2 as $row) {
        $login = $row['member_login'];
        $name = $row['name'];
        $age = $row['age'];
        $desc = $row['description'];
        $photo = $row['photo'];
        echo <<<_EOF
        <tr>
            <td>$login</td>
            <td>$name</td>
            <td>$age</td>
            <td>$desc</td>
            <td><img src='/photos/$photo' alt=''></td>
            <td>
                <a href='/list/delete/$login'>Удалить пользователя</a>
            </td>
        </tr>
_EOF;
    }
echo <<<_EOF
    </table>
</div><!-- /.container -->
_EOF;

}
