<?php
/**
 * Contains the nominet Renew request class definition.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */

namespace SclNominetEpp\Request\Update\Lock;

use SclNominetEpp\Response\Update\Lock\OptOut as OptOutResponse;
use SclNominetEpp\Request\Update\Lock\AbstractLock;

/**
 * This class provides specific information for the building of the Nominet EPP lock command.
 *
 * @author Merlyn Cooper <merlyn.cooper@hotmail.co.uk>
 */
class ContactOptOut extends AbstractLock
{
    const OBJECT = 'contact';
    const TYPE   = 'opt-out';

    /**
     * Tells the parent class what the action of this request is.
     */
    public function __construct()
    {
        parent::__construct(
            self::OBJECT,
            self::TYPE,
            new OptOutResponse()
        );
    }
}
