<?php
/**
 * Contains the nominet Renew request class definition.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */

namespace SclNominetEpp\Request\Lock;

use SclNominetEpp\Response\Lock\OptOut as OptOutResponse;
use SclNominetEpp\Request;

/**
 * This class build the XML for a Nominet EPP lock command.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class ContactOptOut extends Request
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

    public function setContactId($contactId)
    {
        $this->contactId = $contactId;

        return $this;
    }
    
    public function setDomainName($domainName)
    {
        $this->domainName = $domainName;

        return $this;
    }

    /**
     * (non-PHPdoc)
     * @see SclNominetEpp\Request.AbstractRequest::addContent()
     */
    protected function addContent(\SimpleXMLElement $xml)
    {
        $forkNS  = 'http://www.nominet.org.uk/epp/xml/std-locks-1.0';
        $forkXSI = $forkNS . ' std-locks-1.0.xsd';

        //$domainNS  = 'urn:ietf:params:xml:ns:domain-1.0';
        //$domainXSI = 'urn:ietf:params:xml:ns:domain-1.0 domain-1.0.xsd';

        $lock = $xml->addChild('l:lock', '', $forkNS);
        $lock->addAttribute('xsi:schemaLocation', $forkXSI, $forkNS);
        $lock->addAttribute('object', 'contact');   //Can be contact or domain
        $lock->addAttribute('type', 'opt-out'); //Can be opt-out or investigate
        
        $lock->addChild('contactId', $this->contactId);
        $lock->addChild('domainName', $this->domainName);
    }
}
