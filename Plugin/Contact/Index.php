<?php

namespace WMZ\ForceLogin\Plugin\Contact;

use Closure;
use Magento\Contact\Controller\Index\Index as ContactPage;
use Magento\Framework\Controller\Result\Redirect;
use WMZ\ForceLogin\Plugin\ForceLogin;

class Index extends ForceLogin
{
    /**
     * @param ContactPage $subject
     * @param Closure $proceed
     * @return Redirect|mixed
     */
    public function aroundExecute(ContactPage $subject, Closure $proceed)
    {
        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::CONTACT))) {
            return $proceed();
        }
        return $this->redirectToLogin();
    }
}
