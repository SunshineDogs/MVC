<!DOCTYPE html>
<html lang="ru">
  <head>
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="/src/templates/scripts/scripts.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>

  <body>
   <?php echo ($_SESSION['login_admin']);?>
   <?php if(!isset($_SESSION['admin'])) { ?>
        <form action="/auth" method="post" enctype="multipart/form-data">
                <input type="submit" class="btn btn-primary d-block mx-auto" value="Авторизация">
         </form>
    <h2 align="center">Список задач</h2>

     <table border="1" id="movie" style="width: 100%;">
        <thead>
        <tr>
            <th class="ranking">Имя</th>
            <th class="title">Почта</th>
            <th class="year">Текст задачи</th>
            <th class="status">Статус задачи</th>
        </tr>
        </thead>
          <tbody>
            <?php foreach ($articles as $article): ?>
              <tr>
                <td><?= $article['user_name'] ?></td>
                <td><?= $article['e-mail'] ?></p></td>
                <td><?= $article['text'] ?></p></td>
                <td><?php if($article['status']==0){?><p>Не выполнено</p><?php } else{?><p>Выполнено</p><?php }?></p>
                </td>
             </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div>
        <a href="#" class="paginate" id="previous">Previous</a> |
        <a href="#" class="paginate" id="next">Next</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <form action="/addtask" method="post" enctype="multipart/form-data">
                <table class="table table-bordered">
                    <tr>
                        <td><input type="hidden" name="id"></td>
                    </tr>
                    <tr>
                        <td>Имя пользователя:</td>
                        <td><input type="text" name="user_name" required></td>
                    </tr>
                    <tr>
                        <td>E-mail:</td>
                        <td><input type="text" name="e-mail" required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}"></td>
                    </tr>
                    <tr>
                        <td>Текст задачи:</td>
                        <td><input type="comment" name="text" required></td>
                    </tr>
                </table>
                <button class="btn btn-primary d-block mx-auto">Добавить задачу</button>
            </form>
        </table>

    </div>
  
   <?php }
     else { ?>
      <form action="/logout" method="post" enctype="multipart/form-data">
         <input type="submit" class="btn btn-primary d-block mx-auto" value="Выйти">
      </form>

      <h2 align="center">Список задач</h2>
        <table border="1" id="movie" style="width: 100%;">
            <thead>
            <tr>
                <th class="ranking">Имя</th>
                <th class="title">Почта</th>
                <th class="year">Текст задачи</th>
                <th class="status">Статус задачи</th>
            </tr>
            </thead>
                <tbody>
                <?php foreach ($articles as $article): ?>
                  <tr>
                    <td><?= $article['user_name'] ?></td>
                    <td><?= $article['e-mail'] ?></p></td>
                    <td><?= $article['text'] ?></p>
                     <form action="" method="post">
                        <input type="textarea" id="" value="" placeholder="Редактировать текст" name="newtext" >
                        <input type="submit" id="" value="<?=($article['id'])?>" style="width:4%;height:20px;font-size:0px;" name="admit">
                     </form>
                   </td>
                    <td><?php if($article['status']==0){?><p>Не выполнено</p><?php } else{?><p>Выполнено</p><?php }?></p>
                    <form action="" method="post">
                        <p style="font-weight: 200;">Поменять статус</p>
                        <input type="submit" id="" placeholder="Поменять статус" value="<?=($article['id'])?>" style="width:8%;height:20px;font-size:0px;margin-left:3%;" name="status" >
                     </form>
                    <?php if($article['red_by_admin'] == 1):echo 'Отредактировано администратором';endif;?>
                   </td>
                 </tr>
                <?php endforeach; ?>
               </tbody>
       </table>
        <div>
            <a href="#" class="paginate" id="previous">Previous</a> |
            <a href="#" class="paginate" id="next">Next</a>
        </div>
      <?php  }?>
  </body>
    
