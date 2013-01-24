<?php

/**************************************************************************
*  Copyright notice
*
*  Copyright 2013 Logic Works GmbH
*
*  Licensed under the Apache License, Version 2.0 (the "License");
*  you may not use this file except in compliance with the License.
*  You may obtain a copy of the License at
*
*  http://www.apache.org/licenses/LICENSE-2.0
*  
*  Unless required by applicable law or agreed to in writing, software
*  distributed under the License is distributed on an "AS IS" BASIS,
*  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
*  See the License for the specific language governing permissions and
*  limitations under the License.
*  
***************************************************************************/

namespace lwOrganizations\Controller;

class BackendController extends \LWmvc\Controller
{
    public function __construct()
    {
        parent::__construct("\\lwOrganizations\\", "showListAction");
    }
    
    protected function showListAction()
    {
        $view = new \lwOrganizations\View\OrganizationList();

        $response = $this->executeDomainEvent('Organization', 'getAllOrganizationsAggregate');
        $view->setAggregate($response->getDataByKey('allOrganizationsAggregate'));

        $response = $this->executeDomainEvent('Organization', 'getIsDeletableSpecification');
        $view->setIsDeletableSpecification($response->getDataByKey('isDeletableSpecification'));
        
        return $this->returnRenderedView($view);
    }    
    
    protected function addFormAction($error = false)
    {
        $formView = new \lwOrganizations\View\OrganizationForm('add');

        $response = $this->executeDomainEvent('Organization', 'getOrganizationsEntityFromArray', array(), array("postArray"=>$this->request->getPostArray()));
        $formView->setEntity($response->getDataByKey('OrganizationsEntity'));
        $formView->setErrors($error);
        return $this->returnRenderedView($formView);
    }    
    
    protected function editFormAction($error=false)
    {
        if ($error) {
            $response = $this->executeDomainEvent('Organization', 'getOrganizationsEntityFromArray', array(), array("postArray"=>$this->request->getPostArray()));
            $entity = $response->getDataByKey('OrganizationsEntity');
            $entity->setId($this->request->getInt("id"));
        }
        else {
            $response = $this->executeDomainEvent('Organization', 'getOrganizationsEntityById', array("id"=>$this->request->getInt("id")));
            $entity = $response->getDataByKey('OrganizationsEntity');
        }
        $formView = new \lwOrganizations\View\OrganizationForm('edit');
        $formView->setEntity($entity);
        $formView->setErrors($error);
        return $this->returnRenderedView($formView);
    }    
    
    protected function addAction()
    {
        return $this->buildAddAction('Organization', $this->request->getPostArray(), $this->request->getInt("id"));
    }     
    
    protected function saveAction()
    {
        return $this->buildSaveAction('Organization', $this->request->getPostArray(), $this->request->getInt("id"));
    } 
    
    protected function deleteAction()
    {
        return $this->buildDeleteAction('Organization', $this->request->getInt("id"));
    }    
}