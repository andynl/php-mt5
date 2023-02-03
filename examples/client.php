<?php
require_once __DIR__."/../vendor/autoload.php";

use Tarikh\PhpMeta\MetaTraderClient;
use Tarikh\PhpMeta\Entities\User;
use Tarikh\PhpMeta\src\Lib\MTEnDealAction;
use Tarikh\PhpMeta\Entities\Trade;
use Tarikh\PhpMeta\Enums\OrderFilling;
use Tarikh\PhpMeta\Enums\OrderTime;
use Tarikh\PhpMeta\Enums\OrderType;
use Tarikh\PhpMeta\Enums\TradeAction;

// $server = "api.jksconsultants.com";
// $port = 443;
// $login = "2012";
// $password = "drade32@!AV";
$exampleLogin = 98779104;
$server = "mt5-demo.uw-global.com";
$port = 443;
$login = "1004";
$password = "mugen1996";
$exampleLogin = 2132650062;

$api = new MetaTraderClient($server, $port, $login, $password, false);

// Open Pending order
$trade = new Trade();
$trade->setAction(TradeAction::TA_DEALER_ORD_PENDING);
$trade->setLogin($exampleLogin);
$trade->setSymbol("AUDJPY'");
$trade->setVolume(1000);
$trade->setType(OrderType::OP_BUY_LIMIT);
$trade->setPriceOrder(90.100);
$trade->setTypeFill(OrderFilling::ORDER_FILL_RETURN);
$trade->setTypeTime(OrderTime::ORDER_TIME_SPECIFIED);
$trade->setTimeExpiration(1675419314);

$result = $api->newOrder($trade);

var_dump($result);


// $result = $api->trade($trade);
// $user = $api->newOrder();


// var_dump($result);

/**
 * User Function
 */
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

// Update User Information
// $user = $client->getUser(21001480007);
// $user->Name = "Name Changed";
// $newUser = $client->updateUser($user);


// Delete User
// $user = $api->deleteUser(2024);

// Change User Password
// $type = "MAIN"; // Change $type to INVESTOR if you want to change investor password
// $api->changePasswordUser($exampleLogin, 'SecurePassword', $type);

/**
 * ORDER FUNCTION
 */

// Get Order Detail
// $order = $api->getOrder($ticket = 100);
// var_dump($order);


// Get Open Order Total and pagination
// $total = $api->getOrderTotal($exampleLogin);
// $trades = $api->getOrderPagination($login, $offset, $total);
// var_dump($total);


// Get Closed Order Details by ticket
// $order = $api->getOrderHistory(4914208);
// var_dump($order);

// Get Closed Order Total and pagination
// $total = $api->getOrderHistoryTotal($exampleLogin, $timestampfrom, $timestampto);
// $trades = $api->getOrderHistoryPagination($exampleLogin, $timestampfrom, $timestampto, 0, $total);
// foreach ($trades as $trade) {
//     // see class MTOrder
//     echo "LOGIN : ".$trade->Login.PHP_EOL;
//     echo "TICKET : ".$trade->Order.PHP_EOL;
// }

// Get Open Position
// $total = $api->getPositionTotal($exampleLogin);
// $positions = $api->getPositionPaginate($exampleLogin, 0, $total);
// foreach ($positions as $p) {
//     echo "SYMBOL : ".$p->Symbol.PHP_EOL;
//     echo "LOGIN : ".$p->Login.PHP_EOL;
// }

// Get Deal By Ticket
// $deal = $api->dealGet(1402053);

// Get Deal Paginate
// $total = $api->dealGetTotal($exampleLogin, $timestampfrom, $timestampto);
// $deals = $api->dealGetPaginate($exampleLogin, $timestampfrom, $timestampto, 0, $total);
// var_dump($deals);


/**
 * BALANCE OPERATION
 */
// Conduct User Balance (CREDIT, DEBIT, DEPOSIT, WITHDRAWAL) see MTEnDealAction
// $ticket = $api->conductUserBalance(2024 , MTEnDealAction::DEAL_BALANCE, 100, 'your comment here');
