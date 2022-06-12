<?php

namespace WMZ\ForceLogin\Plugin\CatalogSearch\Result;

use Closure;
use Magento\CatalogSearch\Controller\Result\Index as SearchResults;
use Magento\Framework\Controller\Result\Redirect;
use WMZ\ForceLogin\Plugin\ForceLogin;

class Index extends ForceLogin
{
    /**
     * @param SearchResults $subject
     * @param Closure $proceed
     * @return Redirect|mixed
     */
    public function aroundExecute(SearchResults $subject, Closure $proceed)
    {
        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::SEARCH_RESULT))) {
            return $proceed();
        }
        return $this->redirectToLogin();
    }
}
