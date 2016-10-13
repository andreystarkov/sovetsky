<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'wpapi-test');

/** Имя пользователя MySQL */
define('DB_USER', 'wpapi-test');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'wpapi-test');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'T8PG9;YPdysvLeWA~r]rEx-VfwOX{kjw~EnA<J,hVM{rmDO)<j3bEX pC/pAkBgT');
define('SECURE_AUTH_KEY',  'kgWU)*A<LPZ{;rzT:lZy#vwykIH>z}3/NiyDTdz{Oag)n?2)^qPU<o0,qWCQS!/3');
define('LOGGED_IN_KEY',    'rJ0Ulnb0|$h;5W/Kr~sN3!XwxWGgJ4bwo>Q|?JW+9ae(KbCEPpf+yPK9~,F8CrnG');
define('NONCE_KEY',        '/Ra6er13H{=+O|Pjt-EB+i3WD!-;0O:XP*Ja4zr>S;|V%Cm!$>^3p|#7RBgMR`QH');
define('AUTH_SALT',        'ekI9yMrd?a6f7LIlv5Nh80$D-#>=c]Uw:L2YC.&-^EzWf/I` !XgsT.{(B)~.Qu(');
define('SECURE_AUTH_SALT', 'lD[:(#:L?UN$1|TUjI3`hA.L,;jGxvWY3TEGYgeS8a%Ex=/aCR{wD9*a^u;.TjOl');
define('LOGGED_IN_SALT',   '=2&fV#^?~17@jI($L@)H`M41G^A4LJcZUO,sd{P+xZ-s7OOgsvJ%yxYf@Tb( Lf1');
define('NONCE_SALT',       '(2KVBw~ObA`O[i=_1c@XyO?rfbKI Sd(N8I5TR$GT0ca?adETW=h_JsTp{}UG!|i');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
