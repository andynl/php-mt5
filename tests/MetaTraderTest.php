<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Tarikh\PhpMeta\Entities\Trade;
use Tarikh\PhpMeta\Entities\User;
use Tarikh\PhpMeta\Exceptions\UserException;
use Tarikh\PhpMeta\MetaTraderClient;

class MetaTraderTest extends TestCase
{
    private $client;

    private $exampleLogin;

    private $exampleGroup;

    public function setUp(): void
    {

        $server = getenv('SERVER_HOST');
        $port =  getenv('SERVER_PORT');
        $login =  getenv('LOGIN');
        $password =  getenv('PASSWORD');
        $this->exampleLogin =  getenv('EXAMPLE_LOGIN');
        $this->exampleGroup =  getenv('EXAMPLE_GROUP');

        $this->client = new MetaTraderClient($server, $port, $login, $password);
    }

    public function testApiConnection()
    {
        $conn = $this->client->connect();

        $this->assertEquals(0, $conn, 'Failed when connecting to MT5 Web API Server, check your configuration');
    }

    public function testCreateAccountFailedWithWrongGroup()
    {
        $this->expectException(UserException::class);
        $this->expectExceptionMessage('Invalid parameters');

        $user = new User();
        $user->setName("John Due");
        $user->setEmail("john@due.com");
        $user->setGroup('xxxxx');
        $user->setLeverage("50");
        $user->setPhone("0856123456");
        $user->setAddress("Jakarta");
        $user->setCity("Jakarta");
        $user->setState("Jawa Barat");
        $user->setCountry("Indonesia");
        $user->setZipCode(1470);
        $user->setMainPassword("Secure123");
        $user->setInvestorPassword("NotSecure123");
        $user->setPhonePassword("NotSecure123");
        $this->client->createUser($user);
    }

    public function testCreateAccounSuccess()
    {
        $user = new User();
        $user->setName("John Due");
        $user->setEmail("john@due.com");
        $user->setGroup($this->exampleGroup);
        $user->setLeverage("50");
        $user->setPhone("0856123456");
        $user->setAddress("Jakarta");
        $user->setCity("Jakarta");
        $user->setState("Jawa Barat");
        $user->setCountry("Indonesia");
        $user->setZipCode(1470);
        $user->setMainPassword("Secure123");
        $user->setInvestorPassword("NotSecure123");
        $user->setPhonePassword("NotSecure123");
        $result = $this->client->createUser($user);

        $this->assertInstanceOf(Tarikh\PhpMeta\Entities\User::class, $result);
        $this->assertGreaterThan(0, $result->getLogin());
    }

    public function testDepositSuccess()
    {
        $trade = new Trade();
        $trade->setLogin($this->exampleLogin);
        $trade->setAmount(100);
        $trade->setComment("Deposit");
        $trade->setType(Trade::DEAL_BALANCE);
        $result = $this->client->trade($trade);

        $this->assertInstanceOf(Trade::class, $result, 'Failed to deposit');
        $this->assertGreaterThan(0, $result->getTicket(), 'Deposit function don\'t return actual ticket');
    }
}
