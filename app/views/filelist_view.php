<?php
if (isset($data2)) {
    echo <<<_EOF
<div class="container">
    <table class="table table-bordered">
        <tr>
          <th>Название файла</th>
          <th>Фотография</th>
          <th>Действие</th>
        </tr>
_EOF;
    foreach ($data2 as $row) {
        $login = $row['member_login'];
        $photo = $row['photo'];
echo "
        <tr>
          <td>$login</td>
";
          if ($photo !== null){
              echo "<td><img src='/photos/$photo' alt=''></td>";
              echo "<td><a href='/filelist/delete/$photo'>Удалить аватарку</a></td>";
          } else {
              echo "<td>NO IMAGE</td>";
              echo "<td>NO IMAGE</td>";
          }
    }
    echo <<<_EOF
</tr>
    </table>
</div><!-- /.container -->
_EOF;
}