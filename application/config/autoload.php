<?php defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('session', 'form_validation', 'database', 'encryption', 'Customlib', 'Excel', 'Template');
$autoload['drivers'] = array();
$autoload['helper'] = array('url', 'captcha', 'form', 'string', 'bnb_helper');
$autoload['config'] = array();
$autoload['language'] = array('system_lang');
$autoload['model'] = array('FinyearMstModel', 'AccountMstModel', 'UsersMstModel', 'UsersTypeMstModel', 'UsersPermissionMstModel', 'UsersLogsMstModel', 'StoreMstModel', 'LocationMstModel', 'TransferStockMstModel', 'TransferStockDetModel', 'BrandMstModel', 'CategoryMstModel', 'ProductMstModel', 'ProductAccountMstModel', 'ProductAccountDetModel', 'ProductLocationMstModel', 'BankMstModel', 'PaymentModeMstModel', 'UnitGroupMstModel', 'UnitMstModel', 'PackingMstModel', 'TaxesGroupMstModel', 'TaxesMstModel', 
'CounterMstModel', 'CounterMappingMstModel', 'GenerateBarcodeMstModel', 'PriceMstModel', 'PriceDetModel', 'StockLocationMstModel', 'CheckedReceivedMstModel', 'SupplierMstModel', 'SupplierAccountMstModel', 'SupplierAccountDetModel', 'POMstModel', 'PODetModel', 'PurchaseMstModel', 'PurchaseDetModel', 'PaymentMstModel', 'PurchaseReturnDetModel', 'PurchaseReturnMstModel', 'SalesMstModel', 'SalesDetModel', 'ReceiptMstModel', 'SalesReturnMstModel', 'SalesReturnDetModel', 'SEEMstModel', 'SEEDetModel', 'CreditNoteMstModel', 'DebitNoteMstModel');