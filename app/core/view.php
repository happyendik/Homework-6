<?php

class View
{
    //public $template_view; // здесь можно указать общий вид по умолчанию.

    public function generate($content_view, $template_view, $data = null, $data2 = null)
    {
        /* можно проебразовать элементы массива в переменные
        if(is_array($data)) {
            // преобразуем элементы массива в переменные
            extract($data);
        }
        */
       // и кстати просит template_view.php а во view такого нет
//        include 'app/views/'.$template_view; не может подключить эти файлы так как не найден путь  require '../../app/views'.$template_view; так как минимум
        require_once '../../app/views/' . $template_view;
        require '../../app/views/'.$content_view;
//        include_once 'app/views/'.$content_view;

echo <<<_EOF
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="/js/main.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        </body>
        </html>
_EOF;
    }
}