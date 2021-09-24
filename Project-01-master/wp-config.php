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
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'project_01' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'admin' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'phpmyadmin' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ')xrSiOis>q7)dSjiq0|?y;H]UN~6iO`eq2[Ap^UNf!*nV|[~h_:z8Qy94EK@35]3' );
define( 'SECURE_AUTH_KEY',  'Tuxkue#GhCGsQ(n0a&9gGk[`-1kLE!9h/K;o|Si^1D:]qS-C(q7@I9?[l;/vwSIA' );
define( 'LOGGED_IN_KEY',    'K$1RZY-i]zP}.;X(Qy~FoZ)(1cJz(>`<mOJXlTi;a>DA8PMH=WfgW@SOI2.^#-1<' );
define( 'NONCE_KEY',        'hL^^KQ.6l-39itEVUSFg*1cq|QD*o<OOI8z2#u?F8mLn|NjmBpWU&J.?SNyy>j#J' );
define( 'AUTH_SALT',        '5#|iM`k>I1dnY<v25vkNI{}9%65v|=r8O{kLv-N@=e]}iiSv<Ur`0HU2P[Gq9$ZO' );
define( 'SECURE_AUTH_SALT', 'y`ulKW]nrGqv<Qjd+uS.x()S)5*V<asRrpDU(nT?71{z6{(`Q/l}sqgZgLb* ~hp' );
define( 'LOGGED_IN_SALT',   '~>B_M;lE$YbE>=^:eW~p>,lN@kS,M!S2~iplK)qT?yW&Ng8v6*L}m;+>V#W%R<U-' );
define( 'NONCE_SALT',       'Sq/4PuW]O{}b@O%9>/{VibevjK;%{oX50)[d/S_pLn<(&2CNX1r%V`*pzgJXQka^' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
//define('WP_DEBUG_DISPLAY', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
