<?php

namespace WMZ\ForceLogin\Helper;

use Magento\Catalog\Model\SessionFactory as CatalogSessionFactory;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Stdlib\Cookie\CookieMetadataFactory;
use Magento\Framework\Stdlib\Cookie\PhpCookieManager;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    /**
     * @var CookieMetadataFactory
     */
    private $cookieMetadataFactory;

    /**
     * @var PhpCookieManager
     */
    private $cookieMetadataManager;

    /**
     * Data constructor.
     * @param CookieMetadataFactory $cookieMetadataFactory
     * @param PhpCookieManager $cookieMetadataManager
     * @param Context $context
     */
    public function __construct(
        CookieMetadataFactory $cookieMetadataFactory,
        PhpCookieManager $cookieMetadataManager,
        Context $context
    ) {
        parent::__construct($context);
        $this->cookieMetadataFactory = $cookieMetadataFactory;
        $this->cookieMetadataManager = $cookieMetadataManager;
    }

    /**
     * To Enable Force Login on All Pages
     * @return bool
     */
    public function isEnable(): bool
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/general/enable',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable force login for product page
     * @return bool
     */
    public function isEnableProductPage(): bool
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/page/product_page',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable force login for category page
     * @return bool
     */
    public function isEnableCategoryPage(): bool
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/page/category_page',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable force login for cart page
     * @return bool
     */
    public function isEnableCartPage(): bool
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/page/cart_page',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable force login for checkout page
     * @return bool
     */
    public function isEnableCheckoutPage(): bool
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/page/checkout_page',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable force login for contact page
     * @return bool
     */
    public function isEnableContactPage(): bool
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/page/contact_page',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable force login for Guest Form Page
     * @return bool
     */
    public function isEnableGuestForm(): bool
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/page/order_return',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable force login for search term page
     * @return bool
     */
    public function isEnableSearchTermPage(): bool
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/page/search_term_page',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable force login for search result page
     * @return bool
     */
    public function isEnableSearchResultPage(): bool
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/page/search_results_page',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable force login for advanced search page
     * @return bool
     */
    public function isEnableAdvancedSearchPage(): bool
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/page/advanced_search_page',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return bool
     */
    public function isEnableOtherPage(): bool
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/page/other_page',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable customer register
     * @return bool
     */
    public function isEnableRegister(): bool
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/general/disable_register',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get alert message after redirect login page
     * @return string|null
     */
    public function getAlertMessage(): ?string
    {
        return $this->scopeConfig->getValue(
            'forcelogin/page/message',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get redirect url after login
     * @return string|null
     */
    public function getRedirectUrl(): ?string
    {
        return $this->scopeConfig->getValue(
            'forcelogin/redirect/page',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get customer url after login
     * @return string|null
     */
    public function getCustomUrl(): ?string
    {
        $pageRedirect = $this->scopeConfig->getValue(
            'forcelogin/redirect/custom_url',
            ScopeInterface::SCOPE_STORE
        );

        $this->scopeConfig->getValue(
            'system_config_path',
            ScopeInterface::SCOPE_WEBSITE
        );

        return $pageRedirect;
    }

    /**
     * Enable force login for cms page
     * @return bool
     */
    public function isEnableCmsPage(): bool
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/page/enable',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get cms Page id
     * @return string|null
     */
    public function getCmsPageId(): ?string
    {
        return $this->scopeConfig->getValue(
            'forcelogin/page/page_id',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get Cms Index Page Id
     * @param string $pathPage
     * @return mixed
     */
    public function getCmsPageConfig(string $pathPage)
    {
        return $this->scopeConfig->getValue(
            $pathPage,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return mixed
     */
    public function getDirectUrl()
    {
        return $this->scopeConfig->getValue(
            'forcelogin/page/direct_access',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return PhpCookieManager|mixed
     */
    public function getCookieManager()
    {
        if (!$this->cookieMetadataManager) {
            $this->cookieMetadataManager = ObjectManager::getInstance()->get(
                PhpCookieManager::class
            );
        }
        return $this->cookieMetadataManager;
    }

    /**
     * @return CookieMetadataFactory|mixed
     */
    public function getCookieMetadataFactory()
    {
        if (!$this->cookieMetadataFactory) {
            $this->cookieMetadataFactory = ObjectManager::getInstance()->get(
                CookieMetadataFactory::class
            );
        }
        return $this->cookieMetadataFactory;
    }
}
