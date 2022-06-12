<?php

namespace WMZ\ForceLogin\Plugin\Index;

use Closure;
use Magento\Checkout\Controller\Index\Index as MagentoCheckoutPage;
use Magento\Framework\Controller\Result\Redirect;
use WMZ\ForceLogin\Plugin\ForceLogin;

class Index extends ForceLogin
{
    /**
     * @param MagentoCheckoutPage $subject
     * @param Closure $proceed
     * @return Redirect|mixed
     */
    public function aroundExecute(MagentoCheckoutPage $subject, Closure $proceed)
    {
        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::CHECKOUT_INDEX))) {
            return $proceed();
        }
        return $this->redirectToLogin();
    }
}
