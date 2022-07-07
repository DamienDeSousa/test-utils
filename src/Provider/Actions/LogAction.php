<?php

/**
 * File that defines the LogAction trait.
 *
 * @author    Damien DE SOUSA <desousadamien30@gmail.com>
 * @copyright 2021 Damien DE SOUSA
 */

declare(strict_types=1);

namespace Dades\TestUtils\Provider\Actions;

use Symfony\Component\Security\Core\User\UserInterface;
use Dades\TestUtils\Provider\Selector\Admin\UtilsAdminSelector;
use Exception;
use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Exception\TimeoutException;
use Symfony\Component\Panther\Client;
use Symfony\Component\Panther\DomCrawler\Crawler;

/**
 * This trait is used to provides log actions to the tests.
 */
trait LogAction
{
    public function login(UserInterface $user, string $loginUrl, Client $client): \Symfony\Component\DomCrawler\Crawler
    {
        $crawler = $client->request('GET', $loginUrl);
        $loginForm = $crawler->selectButton('_submit')->form([
            '_username' => $user->getUsername(),
            '_password' => $user->getPassword()
        ]);

        return $client->submit($loginForm);
    }

    /**
     * @throws NoSuchElementException
     * @throws TimeoutException
     * @throws Exception
     */
    public function adminLogout(Client $client, \Symfony\Component\DomCrawler\Crawler $crawler): Crawler
    {
        $client->waitFor(UtilsAdminSelector::USER_DETAIL_SELECTOR);
        $client->executeScript(
            sprintf("document.querySelector('%s').click()", UtilsAdminSelector::USER_DETAIL_SELECTOR)
        );
        sleep(1);
        $link = $crawler->filter(UtilsAdminSelector::USER_LOGOUT_LINK_SELECTOR)->attr('href');

        return $client->request('GET', $link);
    }

    public function initUserConnection(): Client
    {
        $this->setUpTrait();
        /** @var UserInterface $user */
        $user = $this->fixtureRepository->getReference('user');
        $client = static::createPantherClient();
        $this->login($user, $this->provideAdminLoginUri(), $client);

        return $client;
    }
}
