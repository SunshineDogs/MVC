<head>
        <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="../scripts/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<script type='text/javascript'>
    $(function () {
        // Selectors for future use
        var myTable = "#movie";
        var myTableBody = myTable + " tbody";
        var myTableRows = myTableBody + " tr";
        var myTableColumn = myTable + " th";

        // Starting table state
        function initTable() {
            $(myTableBody).attr("data-pageSize", 3);
            $(myTableBody).attr("data-firstRecord", 0);
            $('#previous').hide();
            $('#next').show();

            // Increment the table width for sort icon support
            $(myTableColumn).each(function () {
                var width = $(this).width();
                $(this).width(width + 40);
            });

            // Set the first column as sorted ascending
            $(myTableColumn).eq(0).addClass("sorted-asc");

            //Sort the table using the current sorting order
            sortTable($(myTable), 0, "asc");

            // Start the pagination
            paginate(parseInt($(myTableBody).attr("data-firstRecord"), 10),
                parseInt($(myTableBody).attr("data-pageSize"), 10));

        }


        // Table sorting function
        function sortTable(table, column, order) {
            var asc = order === 'asc';
            var tbody = table.find('tbody');

            // Sort the table using a custom sorting function by switching
            // the rows order, then append them to the table body
            tbody.find('tr').sort(function (a, b) {
                if (asc) {
                    return $('td:eq(' + column + ')', a).text()
                        .localeCompare($('td:eq(' + column + ')', b).text());
                } else {
                    return $('td:eq(' + column + ')', b).text()
                        .localeCompare($('td:eq(' + column + ')', a).text());
                }
            }).appendTo(tbody);

        }

        // Heading click
        $(myTableColumn).click(function () {

            // Remove the sort classes for all the column, but not the first
            $(myTableColumn).not($(this)).removeClass("sorted-asc sorted-desc");

            // Set or change the sort direction
            if ($(this).hasClass("sorted-asc") || $(this).hasClass("sorted-desc")) {
                $(this).toggleClass("sorted-asc sorted-desc");
            } else {
                $(this).addClass("sorted-asc");
            }

            // Set the complete list of rows as visible
            $(myTableRows).show();

            //Sort the table using the current sorting order
            sortTable($(myTable), $(this).index(), $(this).hasClass("sorted-asc") ? "asc" : "desc");

            // Start the pagination
            paginate(parseInt($(myTableBody).attr("data-firstRecord"), 10),
                parseInt($(myTableBody).attr("data-pageSize"), 10));

        });

        // Pager click
        $("a.paginate").click(function (e) {
            e.preventDefault();
            var tableRows = $(myTableRows);
            var tmpRec = parseInt($(myTableBody).attr("data-firstRecord"), 10);
            var pageSize = parseInt($(myTableBody).attr("data-pageSize"), 10);

            // Define the new first record
            if ($(this).attr("id") == "next") {
                tmpRec += pageSize;
            } else {
                tmpRec -= pageSize;
            }
            // The first record is < of 0 or > of total rows
            if (tmpRec < 0 || tmpRec > tableRows.length) return

            $(myTableBody).attr("data-firstRecord", tmpRec);
            paginate(tmpRec, pageSize);
        });

        // Paging function
        var paginate = function (start, size) {
            var tableRows = $(myTableRows);
            var end = start + size;
            // Hide all the rows
            tableRows.hide();
            // Show a reduced set of rows using a range of indices.
            tableRows.slice(start, end).show();
            // Show the pager
            $(".paginate").show();
            // If the first row is visible hide prev
            if (tableRows.eq(0).is(":visible")) $('#previous').hide();
            // If the last row is visible hide next
            if (tableRows.eq(tableRows.length - 1).is(":visible")) $('#next').hide();
        }

        // Table starting state
        initTable();


    });

</script>
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
        </thead><tbody>

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
else {?>

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
            </thead><tbody>

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

</body>
<?php  }?>
