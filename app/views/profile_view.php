
<div class="container">
    <div class="form-container">
        <form class="form-horizontal" action="/profile/post" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Имя</label>
                <div class="col-sm-10">
                    <input name="name" type="text" class="form-control" id="inputEmail3" placeholder="Имя">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Возраст</label>
                <div class="col-sm-10">
                    <input name="age" type="text" class="form-control" id="inputEmail3" placeholder="Возраст">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">О себе</label>
                <div class="col-sm-10">
                    <input name="desc" type="text" class="form-control" id="inputEmail3" placeholder="О себе">
                </div>
            </div>
            <!--
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Фото</label>
                        <div class="col-sm-10">
                          <input name="photo" type="text" class="form-control" id="inputEmail3" placeholder="Фото">
                        </div>
                      </div>
            -->
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Фото</label>
                <div class="col-sm-10">
                    <input name="photo" type="file" class="form-control" id="inputEmail3" placeholder="Фото">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Сохранить</button>
                    <br><br>
                </div>
            </div>
        </form>
    </div>
</div><!-- /.container -->