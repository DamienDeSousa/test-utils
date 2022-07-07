<?php

/**
 * Defines the NavigationAction trait.
 *
 * @author Damien DE SOUSA
 */

declare(strict_types=1);

namespace Dades\TestUtils\Provider\Actions;

use Dades\EasyAdminExtensionBundle\Controller\Admin\Index;
use Dades\TestUtils\Provider\Selector\Admin\UtilsAdminSelector;
use Exception;
use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Panther\Client;
//use Symfony\Component\Panther\DomCrawler\Crawler;

/**
 * Used to provide navigation methods for tests.
 */
trait NavigationAction
{
    public function navigateLeftMenu(Crawler $crawler, string $crudController): ?string
    {
        $siteLink = null;
        $crawler
            ->filter(UtilsAdminSelector::LEFT_MENU_LINKS_SELECTOR)
            ->each(function ($node) use (&$siteLink, $crudController) {
                if (str_contains($node->attr('href'), urlencode($crudController))) {
                    $siteLink = $node->attr('href');
                }
            });

        return $siteLink;
    }

    public function navigateLeftMenuLink(AbstractBrowser $client, string $fullClassName): Crawler
    {
        $crawler = $client->request('GET', Index::ADMIN_HOME_PAGE_URI);
        $itemLink = $this->navigateLeftMenu($crawler, $fullClassName);

        return $client->request('GET', $itemLink);
    }

    public function navigateToActionPage(
        Client $client,
        string $fullClassName,
        int $entityId,
        string $actionSelector
    ): Crawler {
        $crawler = $this->navigateLeftMenuLink($client, $fullClassName);
        $crawler = UtilsAdminSelector::findRowInDatagrid($crawler, $entityId);
        $crawler->filter(UtilsAdminSelector::ENTITY_ACTIONS_DROPDOWN)->click();
        $crawler->filter(
            sprintf(
                '#main > table > tbody > tr > td.actions.actions-as-dropdown > div > div > %s',
                $actionSelector
            )
        )->click();
        sleep(1);

        return $client->refreshCrawler();
    }

    /**
     * @throws Exception
     */
    public function submitFormAndReturn(Client $client): Crawler
    {
        $this->clickElement($client, UtilsAdminSelector::SAVE_AND_RETURN_BUTTON_SELECTOR);
        $client->refreshCrawler();

        return $client->getCrawler();
    }

    /**
     * @throws Exception
     */
    public function clickElement(Client $client, string $elementCssSelector): Crawler
    {
        $client->executeScript(
            sprintf(
                "document.querySelector('%s').click()",
                $elementCssSelector
            )
        );

        return $client->refreshCrawler();
    }

    /**
     * @throws Exception
     */
    public function navigateToCreatePage(Client $client, string $fullClassName): Crawler
    {
        $this->navigateLeftMenuLink($client, $fullClassName);
        $this->clickElement($client, UtilsAdminSelector::CREATE_BUTTON_SELECTOR);

        return $client->refreshCrawler();
    }
}
