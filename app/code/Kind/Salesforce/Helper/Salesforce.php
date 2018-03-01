<?php

/**
 * Created by PhpStorm.
 * User: stand
 * Date: 2/28/2018
 * Time: 8:48 PM
 */
class Salesforce extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $client;

    public function __construct(\Magento\Framework\App\Helper\Context $context)
    {
        $this->client = new \FuelSdk\ET_Client();
        parent::__construct($context);
    }

    public function getClient()
    {
        return $this->client;
    }

    public function doesUserExist($email)
    {
        $dataextension = new \FuelSdk\ET_DataExtension();
        $dataextension->authStub = $this->client;
        $dataextension->props = array('Email', 'SubscriberFlag');
        $dataextension->filter = array('Property' => 'Email', 'SimpleOperator' => 'equals', 'Value' => $email);
        $response = $dataextension->get();
        return $response;
    }

    public function isAlreadySubbed($response, $email)
    {
        return $response['SubscriberFlag'] == true;
    }

    public function addUser($email)
    {
        $dataextension = new \FuelSdk\ET_DataExtension();
        $dataextension->authStub = $this->client;
        $dataextension->props = array("Name" => "SDKDataExtension", "Description" => "SDK Created Data Extension");
        $dataextension->columns = array();
        $dataextension->columns[] = array("Name" => "Key", "FieldType" => "Text", "IsPrimaryKey" => "true", "MaxLength" => "100", "IsRequired" => "true");
        $dataextension->columns[] = array("Name" => "Value", "FieldType" => "Text");
        $results = $dataextension->post();
        return $results;
    }

    public function reSubUser($email)
    {
        $dataextension = new \FuelSdk\ET_DataExtension();
        $dataextension->authStub = $this->client;
        $dataextension->props = array("CustomerKey" => "151515151", "Name" => "SDK Example, now Updated!");
        $results = $dataextension->patch();
    }

    public function sendJourney($email)
    {
        $json = '
        Host: https://www.exacttargetapis.com
POST /interaction/v1/events
Content-Type: application/json
Authorization: Bearer '.$this->client->getAuthToken().'
{
    "ContactKey": "ID601",
    "EventDefinitionKey":"AcmeBank-AccountAccessed",
    "EstablishContactKey": true,
    "Data": {
        "accountNumber":"123456",
        "patronName":"John Smith" }
}
        ';
    }
}