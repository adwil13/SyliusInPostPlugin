<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace Tests\BitBag\SyliusInPostPlugin\Behat\Page\Admin\ShippingExport;

use Behat\Mink\Element\ElementInterface;
use Sylius\Behat\Page\Admin\Crud\IndexPage as BaseIndexPage;

final class IndexPage extends BaseIndexPage implements IndexPageInterface
{
    public function getShipmentsWithState(string $state): array
    {
        $items = $this->getDocument()->findAll('css', '.shipping-export-state');
        $result = [];

        /** @var ElementInterface $item */
        foreach ($items as $item) {
            if ($item->getText() === $state) {
                $result[] = $item;
            }
        }

        return $result;
    }

    public function exportAllShipments(): void
    {
        $this->getDocument()->pressButton('Export all new shipments');
    }

    public function exportFirsShipment(): void
    {
        $this->getDocument()->find('css', '.shipping-export-state')->click();
    }

    public function selectParcelTemplate(): void
    {
        $this->getDocument()->find('css', '.shipping-export-select-template')->click();
    }

    public function checkParcelTemplate(): void
    {
        $button = $this->getDocument()->find('xpath', '//button[@data-shipping-export-selected-template]');
        if (null === $button) {
            throw new \Exception('Parcel template is not selected.');
        }
    }
}
