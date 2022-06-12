<?php

namespace WMZ\ForceLogin\Controller\Account;

use Magento\Customer\Controller\Account\Login as CustomerLogin;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Catalog\Model\Session as CatalogSession;
use Magento\Store\Model\StoreManagerInterface;

class Login extends CustomerLogin
{
    const CUSTOMER_CREATE_PASSWORD_PATH = 'customer/account/createpassword';

    const CUSTOMER_ACCOUNT_PATH = 'customer/account/index';

    /**
     * @var PageFactory $resultPageFactory
     */
    protected $resultPageFactory;

    /**
     * @var CatalogSession
     */
    private $catalogSession;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * Login constructor.
     * @param Context $context
     * @param Session $customerSession
     * @param PageFactory $resultPageFactory
     * @param CatalogSession $catalogSession
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        Session $customerSession,
        PageFactory $resultPageFactory,
        CatalogSession $catalogSession,
        StoreManagerInterface $storeManager
    ) {
        parent::__construct(
            $context,
            $customerSession,
            $resultPageFactory
        );
        $this->catalogSession = $catalogSession;
        $this->storeManager = $storeManager;
    }

    /**
     * Execute
     *
     * @return Redirect|Page
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $previousUrl = $this->_redirect->getRefererUrl();
        $baseUrl = $this->storeManager->getStore()->getBaseUrl();
        $controllerName = str_replace($baseUrl, "", $previousUrl);
        if ($controllerName == self::CUSTOMER_CREATE_PASSWORD_PATH) {
            $previousUrl = $baseUrl . self::CUSTOMER_ACCOUNT_PATH;
        }
        $this->catalogSession->setPreviousUrl($previousUrl);
        return parent::execute();
    }
}
