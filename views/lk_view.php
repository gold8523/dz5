<h1>Личный кабинет</h1>
<div>
    <img src="images/<?php echo $data[0][0]; ?>" alt="Изображение">
    <ul>
        <li>Имя:<?php echo ' ' . $data[2]; ?></li>
        <li>Возраст:<?php echo ' ' . $data[3]; ?></li>
    </ul>
</div>
<div>
    <h3>Информация о вас:</h3>
    <p><?php echo ' ' . $data[4]; ?></p>
</div>
<div>
    <h3>Добавить изображение:</h3>
    <form enctype="multipart/form-data" action="lk/add_image" method="post">
        <table>
            <tr>
                <td>Добавьте фотографию:</td>
                <td>
                    <input type="hidden" name="MAX_FILE_SIZE" value="3145728" />
                    <input type="file" name="newPic"/>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="action" value="Добавить"/>
                </td>
                <td>
                    <input type="reset" value="Очистить форму"/>
                </td>
            </tr>
        </table>
    </form>
</div>
<div>
    <h4>Все изображения:</h4>
    <?php $i = 0; ?>
    <?php foreach ($data[0] as $item) : ?>
        <ul>
            <li>
                <form action="lk/rename_image" method="post">
                    <label><?php echo $item; ?>
                        <input type="hidden" name="id" value="<?php echo $data[5][$i]; ?>">
                        <input type="hidden" name="old" value="<?php echo $item; ?>">
                        <input type="text" name="edit" value="<?php echo $item; ?>">
                    </label>
                    <input type="submit" name="action" value="Переименовать">
                    <input type="submit" name="action" value="Удалить"><br>
                </form>
            </li>
        </ul>
        <?php $i++; ?>
    <?php endforeach; ?>
</div>
<div>
    <h3>Отправить письмо:</h3>
    <form action="lk/send_mail" method="post">
        <table>
            <tr>
                <td>Введите адрес получателя:</td>
                <td>
                    <label>
                        <input type="email" name="address" autofocus/>
                    </label>
                </td>
            </tr>
            <tr>
                <td>Тема письма:</td>
                <td>
                    <label>
                        <input type="text" name="title"/>
                    </label>
                </td>
            </tr>

            <tr>
                <td>Текст письма:</td>
                <td>
                    <label>
                        <textarea name="email" cols="40" rows="10"></textarea>
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="action" value="Отправить"/>
                    <input type="reset" value="Очистить форму"/>
                </td>
            </tr>
        </table>
    </form>
</div>
<div>
    <h4>Другие пользователи:</h4>
    <?php foreach ($data[1] as $item) : ?>
        <ul>
        <li><?php echo $item; ?></li>
        </ul><?php endforeach; ?>
</div>
<div>
    <form action="lk/out" method="post">
        <input type="submit" name="exit" value="Выйти на главную">
    </form>
</div>
