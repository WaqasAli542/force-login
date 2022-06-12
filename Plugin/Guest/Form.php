<?php

namespace WMZ\ForceLogin\Plugin\Guest;

use Closure;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Sales\Controller\Guest\Form as MagentoGuestForm;
use WMZ\ForceLogin\Plugin\ForceLogin;

class Form extends ForceLogin
{
    /**
     * @param MagentoGuestForm $subject
     * @param Closure $proceed
     * @return Redirect|mixed
     */
    public function aroundExecute(MagentoGuestForm $subject, Closure $proceed)
    {
        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::ORDER_RETURN))) {
            return $proceed();
        }
        return $this->redirectToLogin();
    }
}
