<?php

namespace lwOrganizations\Domain\Organization\Specification;

class isDeletable 
{
    public function __construct()
    {
    }
    
    static public function getInstance()
    {
        return new isDeletable();
    }
    
    public function isSatisfiedBy(\lwOrganizations\Domain\Organization\Object\organization $entity)
    {
        return true;
    }
}