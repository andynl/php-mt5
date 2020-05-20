<?php
require_once __DIR__."/../vendor/autoload.php";

use Tarikh\PhpMeta\MetaTraderClient;
use Tarikh\PhpMeta\Entities\User;
use Tarikh\PhpMeta\src\Lib\MTEnDealAction;

$server = "SERVER_MT4_IP";
$port = 443;
$login = "MANAGER LOGIN";
$password = "API PASSWORD";
$exampleLogin = 21001480007;

$client = new MetaTraderClient($server, $port, $login, $password);

// Create Account
// $user = new User();
// $user->setName("John Due Test");
// $user->setEmail("john@due.com");
// $user->setGroup("grouphere");
// $user->setLeverage("50");
// $user->setPhone("0856123456");
// $user->setAvar_dumpress("Sukabumi");
// $user->setCity("Sukabumi");
// $user->setState("Jawa Barat");
// $user->setCountry("Indonesia");
// $user->setZipCode(1470);
// $user->setMainPassword("Secure123");
// $user->setInvestorPassword("NotSecure123");
// $user->setPhonePassword("NotSecure123");

// $result = $api->createUser($user);
// var_dump($result);

// Get Client ID by login
// $login = [];
// $request = $api->getUserLogins('demoforex', $login);

// Get User Information
// $user = $api->getUser($exampleLogin);
// var_dump($user);

// Delete User
// $user = $api->deleteUser(2024);

/**
 * ORDER FUNCTION
 */

// Get Order Detail
// $order = $api->getOrder($ticket = 100);
// var_dump($order);

// Get Open Order Total
// $total = $api->getOrderTotal(2024);
// var_dump($total);

// Get Open Order Pagination
// $total = $api->getOrderTotal(2024);
// var_dump($total);

/**
 * BALANCE OPERATION
 */
// Conduct User Balance (CREDIT, DEBIT, DEPOSIT, WITHDRAWAL) see MTEnDealAction
// $ticket = $api->conductUserBalance(2024 , MTEnDealAction::DEAL_BALANCE, 100, 'Avar_dumping 100 USD');
