<h1>Регистрация</h1>
<form enctype="multipart/form-data" action="form/registration" method="post">
    <table>
        <tr>
            <td>Введите логин:</td>
            <td>
                <label>
                    <input type="text" name="loginUser" autofocus/>
                </label>
            </td>
        </tr>
        <tr>
            <td>Введите пароль:</td>
            <td>
                <label >
                    <input type="password" name="pass"/>
                </label>
            </td>
        </tr>
        <tr>
            <td>Введите имя:</td>
            <td>
                <label>
                    <input type="text" name="name"/>
                </label>
            </td>
        </tr>
        <tr>
            <td>Введите возраст:</td>
            <td>
                <label>
                    <input type="text" name="age"/>
                </label>
            </td>
        </tr>
        <tr>
            <td>Добавьте фотографию:</td>
            <td>
                <input type="hidden" name="MAX_FILE_SIZE" value="3145728" />
                <input type="file" name="picture"/>
            </td>
        </tr>
        <tr>
            <td>Расскажите о себе:</td>
            <td>
                <label>
                    <textarea name="information" cols="40" rows="10"></textarea>
                </label>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <div class="g-recaptcha" data-sitekey="6LfMIQ0UAAAAAGZFh8lqd847wFEC99H0QcCmugfQ"></div>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="action" value="Зарегистрироваться"/>
            </td>
            <td>
                <input type="reset" value="Очистить форму"/>
            </td>
        </tr>
    </table>
</form>
<a href="index.php">Вернуться на главную</a>