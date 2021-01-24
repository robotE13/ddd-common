<?php

/**
 * This file is part of the ddd-common.
 *
 * Copyright 2021 Evgenii Dudal <wolfstrace@gmail.com>.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * @package ddd-common
 */

namespace RobotE13\DDD\Entities\Uuid;

use Webmozart\Assert\Assert;
use Ramsey\Uuid\{
    UuidFactory,
    Codec\OrderedTimeCodec,
    Rfc4122\UuidV1
};

/**
 * Description of Id
 *
 * @method string getBytes() returns the binary string representation of the UUID
 * @method \Ramsey\Uuid\Type\Hexadecimal getHex() returns the hexadecimal representation of the UUID
 * @method \Ramsey\Uuid\Type\Integer getInteger() returns the integer representation of the UUID
 * @method string getString() returns the string standard representation of the UUID
 * @author Evgenii Dudal <wolfstrace@gmail.com>
 */
class Id
{

    /**
     * @var UuidV1
     */
    private $uuid;

    /**
     * Constructor.
     *
     * @param string $representation A binary string
     * @throws \Ramsey\Uuid\Exception\InvalidUuidStringException if a valid UUID of type 1 cannot be build from string $reperesentation
     * @throws \InvalidArgumentException if resukt not UUID of type 1.
     */
    private function __construct(string $representation = null, $from = 'string')
    {
        $factory = new UuidFactory();
        $factory->setCodec(new OrderedTimeCodec($factory->getUuidBuilder()));

        $fromName = 'from' . ucfirst($from);
        $this->uuid = $representation === null ? $factory->uuid1() : $factory->{$fromName}($representation);

        Assert::isInstanceOf($this->uuid, UuidV1::class);
    }

    /**
     * Creates a new ordered by time UUID.
     * @return self
     */
    public static function next()
    {
        return new self();
    }

    /**
     * Initializes the UUID object from given bytes representation `$bytes`.
     * @param string $bytes
     * @return self
     * @throws \Ramsey\Uuid\Exception\InvalidUuidStringException if a valid UUID of type 1 cannot be build from bytes $reperesentation
     */
    public static function fromBytes($bytes)
    {
        return new self($bytes, 'bytes');
    }

    /**
     * Initializes the UUID object from given string representation `$string`.
     * @param string $string
     * @return self
     * @throws \Ramsey\Uuid\Exception\InvalidUuidStringException if a valid UUID of type 1 cannot be build from string $reperesentation
     */
    public static function fromString($string)
    {
        return new self($string, 'string');
    }

    /**
     * Calls the named method which is not a class method.
     *
     * This method creates wrapper methods over some methods of the Uuid1 getters.
     *
     * Do not call this method directly as it is a PHP magic method that
     * will be implicitly called when an unknown method is being invoked.
     * @param string $name the method name
     * @param array $arguments method parameters
     * @return mixed the method return value
     * @throws \BadMethodCallException when calling unknown method
     */
    public function __call($name, $arguments)
    {
        $isAllowedGetter = strpos($name, 'get') === 0 && in_array($name, ['getBytes', 'getHex', 'getInteger']);
        if($isAllowedGetter && method_exists($this->uuid, $name))
        {
            return $this->uuid->$name();
        } elseif($name === "getString")
        {
            return $this->uuid->toString();
        }
        throw new \BadMethodCallException('Calling unknown method: ' . get_class($this) . "::$name()");
    }

    /**
     * Returns -1, 0, or 1 if the UUID is less than, equal to, or greater than
     * the other UUID
     *
     * The first of two UUIDs is greater than the second if the most
     * significant field in which the UUIDs differ is greater for the first
     * UUID.
     *
     * @param self $other The UUID to compare
     * @return int -1, 0, or 1 if the UUID is less than, equal to, or greater than $other
     */
    public function compareTo(self $other): int
    {
        return strcmp($this->getString(), $other->getString()) <=> 0;
    }

    /**
     * Checks that the ID is equal to the provided object.
     *
     * @param self $other An object to test for equality with this ID
     * @return bool True if the other object is equal to this ID
     */
    public function isEqualTo(self $other): bool
    {
        return $this->compareTo($other) === 0;
    }

}
