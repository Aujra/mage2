<?php

/**
 * Created by PhpStorm.
 * User: stand
 * Date: 2/28/2018
 * Time: 9:16 PM
 */
class MixPanelHelper extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $mp;
    protected $currentUser;
    public function __construct(\Magento\Framework\App\Helper\Context $context)
    {
        $this->mp = Mixpanel::getInstance("MIXPANEL_PROJECT_TOKEN");
        parent::__construct($context);
    }
    public function setPerson()
    {
        $this->mp->people->set(12345, array(
            '$first_name'       => "John",
            '$last_name'        => "Doe",
            '$email'            => "john.doe@example.com",
            '$phone'            => "5555555555",
            "Favorite Color"    => "red"
        ), $ip = 0, $ignore_time = true);
    }
    public function trackRevenue()
    {
        $this->mp->people->trackCharge(12345, "20.00", strtotime("01 Jun 2013 5:00:00 PM EST"));
    }
    public function trackEvent()
    {
        $this->mp->track("button clicked", array("label" => "sign-up"));
    }
}