<?php

namespace lwOrganizations\Services;

class dic
{
    public function __construct()
    {
        
    }
    
    public function getRepository()
    {
        if (!$this->Repository) {
            $this->Repository = new \lwOrganizations\Domain\Organization\Model\Repository();
        }
        return $this->Repository;
    }
  
    public function getDbObject()
    {
        return \lw_registry::getInstance()->getEntry("db");
    }
    
    public function getConfiguration()
    {
        return \lw_registry::getInstance()->getEntry("config");
    }
    
    public function getLwResponse()
    {
        return \lw_registry::getInstance()->getEntry("response");
    }
    
    public function getLwRequest()
    {
        return \lw_registry::getInstance()->getEntry("request");
    }
}