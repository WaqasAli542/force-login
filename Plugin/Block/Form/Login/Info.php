<?php

namespace WMZ\ForceLogin\Plugin\Block\Form\Login;

use Magento\Customer\Block\Form\Login\Info as LoginInfo;
use WMZ\ForceLogin\Helper\Data;

class Info
{
    /**
     * @var Data
     */
    private $dataHelper;

    /**
     * Info constructor.
     * @param Data $dataHelper
     */
    public function __construct(
        Data $dataHelper
    ) {
        $this->dataHelper = $dataHelper;
    }

    /**
     * @param LoginInfo $subject
     * @param $result
     * @return mixed|string
     */
    public function afterGetTemplate(LoginInfo $subject, $result)
    {
        if ($this->dataHelper->isEnableRegister() && $this->dataHelper->isEnable()) {
            $result = "";
        }

        return $result;
    }
}
