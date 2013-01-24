<?php

namespace lwOrganizations\Domain\Organization\Model;

class Repository extends \LWddd\Repository
{
    public function __construct()
    {
        parent::__construct();
        $this->dic = new \lwOrganizations\Services\dic();
        $this->baseNamespace = "lwOrganizations\\Domain\\Organization\\";
    }
    
    protected function buildObjectById($id)
    {
        return new \lwOrganizations\Domain\Organization\Object\organization($id);
    }    
    
    public function getAllObjectsByCategoryAggregate($categoryId)
    {
        $items = $this->getQueryHandler()->loadAllEntriesByCategoryId($categoryId);
        return $this->buildAggregateFromQueryResult($items);
    }
}