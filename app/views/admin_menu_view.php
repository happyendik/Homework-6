
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/profile/index">Hi, <?php echo $_SESSION['login']?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li $insert1><a href="/profile/index">Профиль</a></li>
                <li $insert2><a href="/list/index">Список пользователей</a></li>
                <li $insert3><a href="/filelist/index">Список файлов</a></li>
                <li $insert0><a href="/reg/exit">Выход</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>