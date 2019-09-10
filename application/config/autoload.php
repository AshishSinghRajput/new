<?php defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('session', 'form_validation', 'database', 'encryption', 'Customlib', 'Excel', 'Template');
$autoload['drivers'] = array();
$autoload['helper'] = array('url', 'captcha', 'form', 'string', 'bnb_helper');
$autoload['config'] = array();
$autoload['language'] = array('system_lang');
$autoload['model'] = array('FinyearMstModel', 'UsersMstModel', 'UsersTypeMstModel', 'UsersPermissionMstModel', 'UsersLogsMstModel', 'DepartmentMstModel', 'LocationMstModel', 'BankMstModel', 'PaymentModeMstModel', 'ProjectsMstModel', 'ProjectsBankMstModel', 'ProjectsActivitesMstModel','ContractorMstModel','ContractorBankMstModel','SupervisorMstModel','DesignationMstModel', 'FundReceivedMstModel', 'ExpenditureDetailsMstModel', 'InterestMstModel');