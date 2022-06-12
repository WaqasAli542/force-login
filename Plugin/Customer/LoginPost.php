<?php

namespace WMZ\ForceLogin\Plugin\Customer;

use Magento\Customer\Controller\Account\LoginPost as MagentoLoginPost;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\Result\RedirectFactory;
use WMZ\ForceLogin\Helper\Data;
use Magento\Framework\App\Action\Context;
use WMZ\ForceLogin\Model\Config\Source\RedirectPage;

class LoginPost
{
    /**
     * @var Data
     */
    private $helperData;

    /**
     * @var RedirectFactory
     */
    private $resultRedirectFactory;

    /**
     * LoginPost constructor.
     * @param Context $context
     * @param Data $helperData
     */
    public function __construct(
        Context $context,
        Data $helperData
    ) {
        $this->helperData = $helperData;
        $this->resultRedirectFactory = $context->getResultRedirectFactory();
    }

    /**
     * @param MagentoLoginPost $subject
     * @param $resultRedirect
     * @return Redirect
     */
    public function afterExecute(MagentoLoginPost $subject, $resultRedirect)
    {
        $enable = $this->helperData->isEnable();
        if ($enable) {
            $resultRedirect = $this->resultRedirectFactory->create();
            $configRedirectUrl = $this->getLoginRedirectUrl();
            return $resultRedirect->setPath($configRedirectUrl);
        } else {
            return $resultRedirect;
        }
    }

    /**
     * @return string
     */
    public function getLoginRedirectUrl()
    {
        $configRedirectUrl = $this->helperData->getRedirectUrl();
        if ($configRedirectUrl == RedirectPage::CUSTOM_URL) {
            return $this->helperData->getCustomUrl();
        } elseif ($configRedirectUrl == RedirectPage::DEFAULT_VALUE) {
            return $configRedirectUrl;
        }

        return "";
    }
}
