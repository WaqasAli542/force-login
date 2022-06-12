<?php

namespace WMZ\ForceLogin\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class RedirectPage implements OptionSourceInterface
{
    const DEFAULT_VALUE = 'customer/account/index';
    const HOME_PAGE = 'home';
    const CUSTOM_URL = 'customerurl';

    /**
     * Get Redirect Url
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'label' => __('Default'),
                'value' => self::DEFAULT_VALUE,
            ],
            [
                'label' => __('Home Page'),
                'value' => self::HOME_PAGE
            ],
            [
                'label' => __('Custom Url'),
                'value' => self::CUSTOM_URL
            ],
        ];
    }
}
