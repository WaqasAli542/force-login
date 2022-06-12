<?php

namespace WMZ\ForceLogin\Plugin\CatalogSearch\Advanced;

use Closure;
use Magento\CatalogSearch\Controller\Advanced\Index as AdvancedSearch;
use Magento\Framework\Controller\Result\Redirect;
use WMZ\ForceLogin\Plugin\ForceLogin;

class Index extends ForceLogin
{
    /**
     * @param AdvancedSearch $subject
     * @param Closure $proceed
     * @return Redirect|mixed
     */
    public function aroundExecute(AdvancedSearch $subject, Closure $proceed)
    {
        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::ADVANCE_SEARCH))) {
            return $proceed();
        }
        return $this->redirectToLogin();
    }
}
