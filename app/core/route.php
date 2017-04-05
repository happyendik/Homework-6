<?php

class Route
{
    static public function sessionStart()
    {
        session_start();
    }

    function start()
    {
        // контроллер и действие по умолчанию
        $controller_name = 'Auth';
        $action_name = 'Index';
        $actionVar = null;

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // получаем имя контроллера
        if ( !empty($routes[1]) )
        {
            $controller_name = $routes[1];
        }

        // получаем имя экшена
        if ( !empty($routes[2]) )
        {
            $action_name = $routes[2];
        }
        //получаем значение параметра
        if ( !empty($routes[3]) )
        {
            $actionVar = strtolower($routes[3]);
        }

        // добавляем префиксы
        $model_name = 'Model'.ucwords(strtolower($controller_name));
        $controller_name = 'Controller'.ucwords(strtolower($controller_name));
        $action_name = 'action'.ucwords(strtolower($action_name));

        // подцепляем файл с классом модели (файла модели может и не быть)



        $model_file = $model_name.'.php';
        $model_path = "app/models/".$model_file;
        if(file_exists($model_path))
        {
            include "app/models/".$model_file;
        }

        // подцепляем файл с классом контроллера
        $controller_file = $controller_name.'.php';
        $controller_path = "app/controllers/".$controller_file;
        if(file_exists($controller_path))
        {
            include "app/controllers/".$controller_file;
        }
        else
        {
            /*
            правильно было бы кинуть здесь исключение,
            но для упрощения сразу сделаем редирект на страницу 404
            */
            Route::ErrorPage404();
        }

        // создаем контроллер
        $controller = new $controller_name;
        $action = $action_name;

        if(method_exists($controller, $action))
        {
            $controller->actionVar = $actionVar;
            // вызываем действие контроллера
            $controller->$action();
        }
        else
        {
            // здесь также разумнее было бы кинуть исключение
            Route::ErrorPage404();
        }

    }

    public static function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}