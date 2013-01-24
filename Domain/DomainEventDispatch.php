<?php

namespace lwOrganizations\Domain;

class DomainEventDispatch 
{
    public function __construct()
    {
        
    }
    
    public static function getinstance()
    {
        return new DomainEventDispatch();
    }
    
    public function execute($event)
    {
        $DomainEventHandlerClass = "\\lwOrganizations\\Domain\\".$event->getDomainName()."\\EventHandler";
        return $DomainEventHandlerClass::getInstance()->execute($event);
    }
}