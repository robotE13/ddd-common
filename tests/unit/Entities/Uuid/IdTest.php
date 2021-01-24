<?php

namespace Entities\Uuid;

use RobotE13\DDD\Entities\Uuid\Id;
use Ramsey\Uuid\Exception\{
    InvalidArgumentException,
    InvalidUuidStringException,
    UnsupportedOperationException
};
use Ramsey\Uuid\Type\{
    Hexadecimal,
    Integer,
};

class IdTest extends \Codeception\Test\Unit
{

    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testOfUuidRepresentations()
    {
        $uuid1 = Id::next();
        $uuid2 = Id::fromBytes($uuid1->getBytes());

        expect('Представление UUID в виде строки совпадает с заданным UUID',
                $uuid1->getString())->equals($uuid2->getString());
        expect('Метод обертка `getHex()` вернет объект Hexadecimal', $uuid1->getHex())
                ->isInstanceOf(Hexadecimal::class);
        expect('Метод обертка `getInteger()` вернет объект Integer', $uuid1->getInteger())
                ->isInstanceOf(Integer::class);
        expect('Геттер для метода, иинкапсулированного в Id, класса Uuid1 не разрешенный в методе __call() не сработает.',
                fn() => $uuid1->getFields())->throws(\BadMethodCallException::class);
    }

    public function testFailToCreateIncorrectUid()
    {
        expect('Cannot create empty UUID from string', fn() => Id::fromString(''))
                ->throws(InvalidUuidStringException::class);
        expect('Cannot create from non UUID string', fn() => Id::fromString('testnontimeuuid'))
                ->throws(InvalidUuidStringException::class);

        expect('Cannot create empty UUID from bytes', fn() => Id::fromBytes(''))
                ->throws(InvalidArgumentException::class);

        expect('Cannot create non-time based UUID',
                        fn() => Id::fromBytes(\Ramsey\Uuid\Uuid::uuid4()->getBytes()))
                ->throws(UnsupportedOperationException::class,
                        'Attempting to decode a non-time-based UUID using OrderedTimeCodec');
    }

    public function testCompareUuid()
    {
        $earliest = Id::next();
        $earliestCopy = Id::fromBytes($earliest->getBytes());
        $latest = Id::next();

        expect('Сравниваемый UUID будет меньше чем созданный позже (compare вернет -1)',
                $earliest->compareTo($latest))->equals(-1);

        expect('Сравниваемый UUID будет больше, чем созданный ранее (compare вернет 1)',
                $latest->compareTo($earliest))->equals(1);

        expect('Полученные из одно представления UUID совпадают (compare вернет 0)',
                $earliest->compareTo($earliestCopy))->equals(0);

        expect('Полученные из одно представления UUID совпадают',
                $earliest->isEqualTo($earliestCopy))->true();
    }

}
