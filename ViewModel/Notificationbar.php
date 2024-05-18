<?php

declare(strict_types=1);

namespace Lotsofpixels\NotificationBar\ViewModel;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 *
 */
class Notificationbar implements ArgumentInterface
{
    /**
     *
     */
    const string STATUS_BAR = "lotsofpixels_notificationbar/Setting/status";
    /**
     *
     */
    const string CONTENT_BAR = "lotsofpixels_notificationbar/content/content1";
    /**
     *
     */
    const string BACKGROUND_COLOR = "lotsofpixels_notificationbar/styling/background_color";

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        private readonly ScopeConfigInterface  $scopeConfig,
        private readonly StoreManagerInterface $storeManager
    )
    {
    }

    /**
     * @throws NoSuchEntityException
     */
    public function getBarStatus(): string
    {
        return $this->scopeConfig->getValue(self::STATUS_BAR,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $this->storeManager->getStore()->getStoreId());
    }

    /**
     * @throws NoSuchEntityException
     */
    public function getNotificationContent(): mixed
    {
        return $this->scopeConfig->getValue(self::CONTENT_BAR,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $this->storeManager->getStore()->getStoreId());
    }

    /**
     * @return void
     * @throws NoSuchEntityException
     */
    public function getBackgroundColor(): string

    {
        $background_style = $this->scopeConfig->getValue(self::BACKGROUND_COLOR,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $this->storeManager->getStore()->getStoreId());
        return 'style="background:'. $background_style . '"';
    }
}