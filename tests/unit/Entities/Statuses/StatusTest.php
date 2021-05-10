<?php

namespace Entities\Statuses;

use RobotE13\DDD\Entities\Status\SwitchState;

class StatusTest extends \Codeception\Test\Unit
{

    use \Codeception\Specify;

    /**
     * @var \UnitTester
     */
    protected $tester;

    // tests
    public function testSuccessCreate()
    {
        $this->specify('Create Enabled', function() {
            $switch = new SwitchState(SwitchState::ENABLED);
            expect('Enabled is true', $switch->isEnabled())->true();
            expect('Disabled is false', $switch->isDisabled())->false();
            expect('Numeric value is `SwitchState::ENABLED`', $switch->getState())->equals(SwitchState::ENABLED);
            expect('Text value is `Enabled`', $switch->getTextValue())->equals('Enabled');
        });

        $this->specify('Create Disabled', function() {
            $switch = new SwitchState(SwitchState::DISABLED);
            expect('Enabled is false', $switch->isEnabled())->false();
            expect('Disabled is true', $switch->isDisabled())->true();
            expect('Numeric value is `SwitchState::DISABLED`', $switch->getState())->equals(SwitchState::DISABLED);
            expect('Text value is `Enabled`', $switch->getTextValue())->equals('Disabled');
        });
    }

    public function testFailToCreateWithUnknownStateValue()
    {
        expect('Exception on create object with unknown state', fn() => new SwitchState(10000))
                ->throws(\Webmozart\Assert\InvalidArgumentException::class);
    }

    public function testSwitchStates()
    {
        $switch = new SwitchState(SwitchState::ENABLED);
        $switch->disable();
        expect('Disabled is true', $switch->isDisabled())->true();
        $switch->enable();
        expect('Enabled is true', $switch->isEnabled())->true();
    }

}
