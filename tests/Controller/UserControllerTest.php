<?php

namespace App\Tests\Controller;

use Symfony\Component\Panther\PantherTestCase;
use Symfony\Contracts\Translation\TranslatorInterface;

class UserControllerTest extends PantherTestCase
{
    public function testSomething(): void
    {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/');

        $this->assertSelectorTextContains('p', $this->getContainer()->get(TranslatorInterface::class)->trans('Please sign in'));
    }
}
