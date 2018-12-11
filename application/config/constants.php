<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/**** USER DEFINED CONSTANTS **********/

define('ROLE_ADMIN',                            '1');
define('ROLE_MANAGER',                         	'2');
define('ROLE_EMPLOYEE',                         '3');

define('SEGMENT',								2);

/************************** EMAIL CONSTANTS *****************************/

define('EMAIL_FROM',                            'Your from email');		// e.g. email@example.com
define('EMAIL_BCC',                            	'Your bcc email');		// e.g. email@example.com
define('FROM_NAME',                             'CIAS Admin System');	// Your system name
define('EMAIL_PASS',                            'Your email password');	// Your email password
define('PROTOCOL',                             	'smtp');				// mail, sendmail, smtp
define('SMTP_HOST',                             'Your smtp host');		// your smtp host e.g. smtp.gmail.com
define('SMTP_PORT',                             '25');					// your smtp port e.g. 25, 587
define('SMTP_USER',                             'Your smtp user');		// your smtp user
define('SMTP_PASS',                             'Your smtp password');	// your smtp password
define('MAIL_PATH',                             '/usr/sbin/sendmail');


/* 都道府県 */
$pref = array();
$pref[1] = '北海道';
$pref[2]  = '青森県';
$pref[3]  = '岩手県';
$pref[4]  = '宮城県';
$pref[5]  = '秋田県';
$pref[6]  = '山形県';
$pref[7]  = '福島県';
$pref[8]  = '茨城県';
$pref[9]  = '栃木県';
$pref[10] = '群馬県';
$pref[11] = '埼玉県';
$pref[12] = '千葉県';
$pref[13] = '東京都';
$pref[14] = '神奈川県';
$pref[15] = '新潟県';
$pref[16] = '富山県';
$pref[17] = '石川県';
$pref[18] = '福井県';
$pref[19] = '山梨県';
$pref[20] = '長野県';
$pref[21] = '岐阜県';
$pref[22] = '静岡県';
$pref[23] = '愛知県';
$pref[24] = '三重県';
$pref[25] = '滋賀県';
$pref[26] = '京都府';
$pref[27] = '大阪府';
$pref[28] = '兵庫県';
$pref[29] = '奈良県';
$pref[30] = '和歌山県';
$pref[31] = '鳥取県';
$pref[32] = '島根県';
$pref[33] = '岡山県';
$pref[34] = '広島県';
$pref[35] = '山口県';
$pref[36] = '徳島県';
$pref[37] = '香川県';
$pref[38] = '愛媛県';
$pref[39] = '高知県';
$pref[40] = '福岡県';
$pref[41] = '佐賀県';
$pref[42] = '長崎県';
$pref[43] = '熊本県';
$pref[44] = '大分県';
$pref[45] = '宮崎県';
$pref[46] = '鹿児島県';
$pref[47] = '沖縄県';




