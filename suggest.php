<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
    session_start();
    ?>
    <html>
    <head>
    <title>Ваши предложения</title>
    </head>
    <body>
    <h2>Ваши предложения</h2>
    <?php
    $link = mysqli_connect('sql305.hostronavt.ru', 'onavt_25293093', 'pidorasy83', 'onavt_25293093_database');
    // Проверяем, пусты ли переменные логина и id пользователя
    if ($_SESSION['login'] == 'admin')
    {
    // Если пусты, то мы не выводим ссылку
    echo '<meta http-equiv="refresh" content="0;admin.php">';
    }
    else
{
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'edit':
                $result = mysqli_query($link, 'SELECT * FROM Sights WHERE id = "' . $_POST['selectID'] . '"');
                $row = mysqli_fetch_array($result);
                echo '<form action="suggest.php" method="post">';
                echo '<input name="id" type="hidden" value="' . $row['id'] . '">';
                echo '<input name="add" type="hidden" value="">';
                echo "Текст:<br/>";
                echo '<input name="text" type="text" value="' . $row['text'] . '"><br/>';
                echo "Широта:<br/>";
                echo '<input name="lat" type="text" value="' . $row['lat'] . '"><br/>';
                echo "Долгота:<br/>";
                echo '<input name="lng" type="text" value="' . $row['lng'] . '"><br/>';
                echo "Комментарий:<br/>";
                echo '<textarea name="comment">' . $row['comment'] . '</textarea><br/>';
                echo "Фото:<br/>";
                echo '<input name="photo" type="url" value="' . $row['photo'] . '"><br/>';
                echo "Описание:<br/>";
                echo '<textarea name="description">' . $row['description'] . '</textarea><br/>';
                echo '<input type="submit" name="submit" value="Изменить">';
                echo "</form>";
                break;
            case 'new':
                echo '<form action="suggest.php" method="post">';
                echo '<input name="add" type="hidden" value="">';
                echo "Текст:<br/>";
                echo '<input name="text" type="text" value=""><br/>';
                echo "Широта:<br/>";
                echo '<input name="lat" type="text" value="0.0"><br/>';
                echo "Долгота:<br/>";
                echo '<input name="lng" type="text" value="0.0"><br/>';
                echo "Комментарий:<br/>";
                echo '<textarea name="comment"></textarea><br/>';
                echo "Фото:<br/>";
                echo '<input name="photo" type="url" value="https://site.com/image.jpg"><br/>';
                echo "Описание:<br/>";
                echo '<textarea name="description"></textarea><br/>';
                echo '<input type="submit" name="submit" value="Добавить">';
                echo "</form>";
                break;
            default:
                break;
        }
    } else if (isset($_POST['add'])) {
            if ($_POST['text'] != '') {
                mysqli_query($link, 'INSERT INTO Suggestions (text, lat, lng, comment, photo, description) VALUES ("' . $_POST['text'] . '", ' . $_POST['lat'] . ', ' . $_POST['lng'] . ', "' . $_POST['comment'] . '", "' . $_POST['photo'] . '", "' . $_POST['description'] . '")');
                echo "Предложено!<br/>";
                echo '<form action="suggest.php" method="post">';
                echo '<input type="submit" name="submit" value="Вернуться">';
                echo "</form>";
            } else {
                echo "Не предложено!<br/>";
                echo '<form action="suggest.php" method="post">';
                echo '<input type="submit" name="submit" value="Вернуться">';
                echo "</form>";
            }
    } else {
        
        // Если не пусты, то мы выводим ссылку
        $result = mysqli_query($link, 'SELECT * FROM Sights WHERE TRUE');
        echo '<form action="suggest.php" method="post">';
        if ($row = mysqli_fetch_all($result)) {
            echo "<p><b>Имеющиеся маркеры:<b><br/>";
            echo '<select name="selectID">';
            foreach ($row as $arr) {
                echo '<option value="';
                echo $arr[0];
                echo '">';
                echo $arr[1];
                echo '</option>';
            }
            echo "</select>";
            echo '<select name="action"><option value="edit">Предложить редактирование</option><option value="new">Предложить новый маркер</option></select>';
        }
        echo '<input type="submit" name="submit" value="OK">';
        echo "</form>";

    }
}
    ?>
    </body>
    </html>
