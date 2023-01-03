<html>
<body>
<code><?

function show_form($s="") {
if ($s) echo "Ошибка: $s";
?>
<?
exit();
};

// если не было добавления сообщения, выводим форму
if (!$_POST['a']) show_form();

// проверяем данные формы
if (!$_POST['name']) show_form("Укажите Ваше имя!");
if (!$_POST['email']) show_form("Укажите Ваш email!");
if (!$_POST['message']) show_form("Вы не заполнили текст сообщения!");

// описываем переменные и rfc заголовки письма

// обратный адрес будет указанным адресом отправителя сообщения
$from = $_POST['email'];
$recipients = "ashyrowkakajan6@gmail.com"; // Ваш email
$subject="Тема письма";
$body=$_POST['message'];
$headers = "content-type: text/plain; charset=windows-1251"; // кодировка письма

if(strpos($_SERVER['SERVER_SOFTWARE'], '(Win32)')===FALSE)
{
// открываем sendmail и отправляем письмо
$mail = popen("/usr/sbin/sendmail -i -f$from -- $recipients", 'w');
$text_headers = "from: $fromnsubject: $subject".$headers;
fputs($mail, $text_headers);
fputs($mail, "n");
fputs($mail, $body);

// проверяем на ошибку
$result = pclose($mail) >> 8 & 0xff;
}
else $result=(mail($recipients, $subject, $body, "from: ".$from."rn".$headers) ? FALSE : TRUE);

if ($result) echo "Сообщение не было отправлено!";
else echo "Спасибо, Ваше сообщение отправлено. Администратор свяжется с Вами в ближайшее время!";
?></code>
</body>
</html>
