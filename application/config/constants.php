<?php defined('BASEPATH') OR exit('No direct script access allowed');
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

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

// user define
define('IS_NOT_DEFINE_SALES', '0');
define('IS_CREDIT_SALES', '1');
define('IS_CASH_SALES', '2');

define('ACCOUNT_OPENING_BALANCE', '1');
define('ACCOUNT_INWARD', '2');
define('ACCOUNT_PURCHASE', '3');
define('ACCOUNT_PAYMENT', '4');
define('ACCOUNT_PURCHASE_RETURN', '5');
define('ACCOUNT_OUTWARD', '6');
define('ACCOUNT_SALES', '7');
define('ACCOUNT_RECEIPT', '8');
define('ACCOUNT_SALES_RETURN', '9');
define('ACCOUNT_DIREST_SALES', '10');
define('ACCOUNT_DIRECT_SALES_RETURN', '11');
define('ACCOUNT_CREDIT_NOTE', '12');
define('ACCOUNT_DEBIT_NOTES', '13');
define('ACCOUNT_SEE', '14');

define('ADMIN_DASHBOARD', '1');
define('ADMIN_MANAGE_STORE', '2');
define('ADMIN_MANAGE_BRAND', '3');
define('ADMIN_MANAGE_CATEGORY', '4');
define('ADMIN_MANAGE_PRODUCT', '5');
define('ADMIN_MANAGE_UNIT_GROUP', '8');
define('ADMIN_MANAGE_UNIT', '9');
define('ADMIN_MANAGE_PACKING', '10');
define('ADMIN_MANAGE_TAXES_GROUP', '11');
define('ADMIN_MANAGE_TAXES', '12');

define('ADMIN_MANAGE_CONTRACTOR', '7');
define('ADMIN_MANAGE_SUPERVISOR', '8');
define('ADMIN_MANAGE_USERS', '13');
define('ADMIN_MIS_REPORTS', '6');
define('ADMIN_MANAGE_BANK', '7');
define('ADMIN_MANAGE_USERS_TYPE', '14');
define('ADMIN_MANAGE_PERMISSION', '15');
