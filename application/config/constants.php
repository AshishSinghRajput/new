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
define('ADMIN_MIS_REPORTS', '6');
define('ADMIN_MANAGE_BANK', '7');
define('ADMIN_MANAGE_UNIT_GROUP', '8');
define('ADMIN_MANAGE_UNIT', '9');
define('ADMIN_MANAGE_PACKING', '10');
define('ADMIN_MANAGE_TAXES_GROUP', '11');
define('ADMIN_MANAGE_TAXES', '12');
define('ADMIN_MANAGE_USERS', '13');
define('ADMIN_MANAGE_USERS_TYPE', '14');
define('ADMIN_MANAGE_PERMISSION', '15');

define('ACCOUNT_DASHBOARD', '16');
define('ACCOUNT_MANAGE_SUPPLIER', '17');
define('ACCOUNT_MANAGE_PAYMENT', '18');
define('ACCOUNT_MANAGE_RECEIPT', '19');
define('ACCOUNT_MANAGE_CREDIT_NOTE', '20');
define('ACCOUNT_MANAGE_DEBIT_NOTE', '21');
define('ACCOUNT_MANAGE_EXPENSES', '22');
define('ACCOUNT_MIS_REPORTS', '23');
define('ACCOUNT_MANAGE_GROUP_SUB_GROUP', '24');

define('SUPERVISOR_DASHBOARD', '25');
define('SUPERVISOR_MANAGE_SUPPLIER', '26');
define('SUPERVISOR_ADD_OPENING', '27');
define('SUPERVISOR_MANAGE_PURCHASE_ORDER', '28');
define('SUPERVISOR_MANAGE_INWARDS', '29');
define('SUPERVISOR_MANAGE_PURCHASE', '30');
define('SUPERVISOR_MANAGE_PAYMENT', '31');
define('SUPERVISOR_MANAGE_PURCHASE_RETURN', '32');
define('SUPERVISOR_MANAGE_OUTWARDS', '33');
define('SUPERVISOR_MANAGE_SALES', '34');
define('SUPERVISOR_MANAGE_RECEIPT', '35');
define('SUPERVISOR_MANAGE_SALES_RETURN', '36');
define('SUPERVISOR_MANAGE_DIRECT_SALES', '37');
define('SUPERVISOR_MANAGE_DIRECT_SALES_RETURN', '38');
define('SUPERVISOR_DAMAGE_SHORTAGE_EXCESS_ENTRY', '39');
define('SUPERVISOR_MANAGE_CREDIT_NOTE', '40');
define('SUPERVISOR_MANAGE_DEBIT_NOTE', '41');
define('SUPERVISOR_OFFERS', '42');
define('SUPERVISOR_CHANGE_PRICE', '43');
define('SUPERVISOR_GENERATE_BARCODE', '44');
define('SUPERVISOR_MANAGE_COUNTER', '45');
define('SUPERVISOR_COUNTER_MAPPING', '46');
define('SUPERVISOR_MANAGE_CHECKEDBY_RECEIVEDBY', '47');
define('SUPERVISOR_PRODUCT_SETTINGS', '47');
define('SUPERVISOR_CHANGE_GST', '47');
define('SUPERVISOR_MIS_REPORTS', '48');

define('CASHIER_DASHBOARD', '49');
define('CASHIER_BILLING', '50');
define('CASHIER_MIS_REPORTS', '51');

define('RETURNS_DASHBOARD', '52');
define('RETURNS_MANAGE_SALES_RETURN', '53');
define('RETURNS_MIS_REPORTS', '54');
