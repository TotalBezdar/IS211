<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Свяжитесь с нами</h2>
    <form action="feedback.php" method="POST">
        <label for="name">Ваше ФИО:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label><br>
        <input for="email" id="email" name="email" required><br><br>

        <label for="message">Сообщение:</label><br>
        <textarea id="message" name="message" rows="4" required></textarea><br>

        <label for="category">Категория </label><br>
        <select name="category" id="category">
            <option value="Вопрос">Вопрос</option>
            <option value="Отзов">Отзыв</option>
            <option value="Проблема">Проблема</option>
        </select><br><br>

            
           
            <legend>Кто вы по провесии:</legend>
                <input type="radio" id="huey" name="drone" value="Рабочий" required>
                <label for="huey">Рабочий</label>
                <input type="radio" id="dewey" name="drone" value="Колхозник">
                <label for="dewey">Колхозник</label>
                <input type="radio" id="louie" name="drone" value="Студент">
                <label for="louie">Студент</label><br><br>
            </legent required>
            <input type="checkbox" id="agreement" name="agreement" value ="try" required>
            <label for="agreement">Согласие c обработкой персональных данных</label><br><br>

        <button type="submit">Отправить</button>
    </form>
</body>
</html>