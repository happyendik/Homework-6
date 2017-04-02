<?php

class View
{
    //public $template_view; // здесь можно указать общий вид по умолчанию.

    public function generate($content_view, $template_view, $data = null, $data2 = null)
    {
        /*
        if(is_array($data)) {
            // преобразуем элементы массива в переменные
            extract($data);
        }
        */

        include 'app/views/'.$template_view;

        include_once 'app/views/'.$content_view;

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