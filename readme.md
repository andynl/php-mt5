
## PHP MT5

This is PHP Package for MT5 Web API
- [Official MT5 Web Api Documentation](https://support.metaquotes.net/en/docs/mt5/api/webapi).


## Documentation

### Installing 
To install the package, in terminal:
```
composer require tarikh/php-mt5
```

## Usage

### Create Deposit
```php
use Tarikh\PhpMeta\Entities\Trade;
use Tarikh\PhpMeta\LaravelMt5;

use Tarikh\PhpMeta\MetaTraderClient;
use Tarikh\PhpMeta\Entities\User;
use Tarikh\PhpMeta\src\Lib\MTEnDealAction;

$server = "SERVER_MT4_IP";
$port = 443;
$login = "MANAGER LOGIN";
$password = "API PASSWORD";
$exampleLogin = 21001480007;

$client = new MetaTraderClient($server, $port, $login, $password);
$trade = new Trade();
$trade->setLogin(6000189);
$trade->setAmount(100);
$trade->setComment("Deposit");
$trade->setType(Trade::DEAL_BALANCE);
$result = $client->trade($trade);
```

The result variable will return Trade class with ticket information, you can grab ticket number by calling ``$result->getTicket()``

### Create User
```php
use Tarikh\PhpMeta\MetaTraderClient;
use Tarikh\PhpMeta\Entities\User;

$server = "SERVER_MT4_IP";
$port = 443;
$login = "MANAGER LOGIN";
$password = "API PASSWORD";
$exampleLogin = 21001480007;

$client = new MetaTraderClient($server, $port, $login, $password);
$user = new User();
$user->setName("John Due");
$user->setEmail("john@due.com");
$user->setGroup("demo\demoforex");
$user->setLeverage("50");
$user->setPhone("0856123456");
$user->setAddress("Sukabumi");
$user->setCity("Sukabumi");
$user->setState("Jawa Barat");
$user->setCountry("Indonesia");
$user->setZipCode(1470);
$user->setMainPassword("Secure123");
$user->setInvestorPassword("NotSecure123");
$user->setPhonePassword("NotSecure123");

$result = $client->createUser($user);
```

The result variable will return User class with login information, you can grab login number by calling ``$result->getLogin()``

### Change Client Password
```php
use Tarikh\PhpMeta\MetaTraderClient;

$server = "SERVER_MT4_IP";
$port = 443;
$login = "MANAGER LOGIN";
$password = "API PASSWORD";
$exampleLogin = 21001480007;

$client = new MetaTraderClient($server, $port, $login, $password);
// $type = "MAIN"; // Change $type to INVESTOR if you want to change investor password
$client->changePasswordUser($exampleLogin, 'SecurePassword', $type);
```

### Get Order By Ticket ID
```php
use Tarikh\PhpMeta\MetaTraderClient;

$server = "SERVER_MT4_IP";
$port = 443;
$login = "MANAGER LOGIN";
$password = "API PASSWORD";
$exampleLogin = 21001480007;

$client = new MetaTraderClient($server, $port, $login, $password);
$order = $client->getOrder($ticket = 100);
```

### Get User Information
```php
use Tarikh\PhpMeta\MetaTraderClient;

$server = "SERVER_MT4_IP";
$port = 443;
$login = "MANAGER LOGIN";
$password = "API PASSWORD";
$exampleLogin = 21001480007;

$client = new MetaTraderClient($server, $port, $login, $password);
$user = $client->getUser($exampleLogin);
var_dump($user);
```

### Get Last Tick (Price)
```php
use Tarikh\PhpMeta\MetaTraderClient;

$server = "SERVER_MT4_IP";
$port = 443;
$login = "MANAGER LOGIN";
$password = "API PASSWORD";
$exampleLogin = 21001480007;

$client = new MetaTraderClient($server, $port, $login, $password);

// symbol — comma separated symbols, the prices of which should be received. The value length must not exceed 4096 characters. You may use the mask "*" and the negation sign "!" to specify groups of symbols. Example.
// symbol=EURUSD,USDJPY — get quotes for symbols EURUSD and USDJPY.
// symbol=Forex\Major*, GOLD — get quotes of all symbols from the Major subgroup and quotes of GOLD.
// symbol=Forex\Crosses*,!AUDUSD — get quotes of all symbols of the Crosses subgroup except AUDUSD.
// symbol=Forex\Major\EUR* — get quotes of all symbols with the basic currency EUR from the Major subgroup.

$ticks = $client->getLastTick("AUDCAD");
foreach ($ticks as $key => $tick) {
    echo "{$tick->Symbol} BID {$tick->Bid} {$tick->Ask}\n";
}
```


### Todo

- [x] Deposit or Withdrawal
- [x] Create Account
- [x] Change Password
- [x] Get Order By Ticket ID
- [x] Get User Information
- [x] Get Last Tick (Price)
- [ ] Get Accounts
- [ ] Remove Account
- [ ] Get Trades
- [ ] Get Group
   
## Contributing

Thank you for considering contributing to the Laravel MT5! you can fork this repository and make pull request.

## Security Vulnerabilities

If you discover a security vulnerability within Laravel MT5, please send an e-mail to Tarikh Agustia via [agustia.tarikh150@gmail.com](mailto:agustia.tarikh150@gmail.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
