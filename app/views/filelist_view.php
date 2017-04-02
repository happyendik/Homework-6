<?php
if (isset($data2)) {
    echo <<<_EOF
<div class="container">
    <table class="table table-bordered">
        <tr>
          <th>Название файла</th>
          <th>Фотография</th>
          <th>Действия</th>
        </tr>
_EOF;
    foreach ($data2 as $row) {
        $login = $row['member_login'];
        $photo = $row['photo'];
        echo <<<_EOF
        <tr>
          <td>$photo</td>
          <td><img src="/photos/$photo" alt=""></td>
          <td>
                <a href='/filelist/delete/$photo'>Удалить аватарку</a>
          </td>
        </tr>
_EOF;
    }
echo <<<_EOF
    </table>
</div><!-- /.container -->
_EOF;

}
