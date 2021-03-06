<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConferenceControllerTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Give your feedback');
    }

    public function testCommentSubmission()
    {
        $client = static::createClient();
        $client->request('GET', '/conference/amsterdam-2019');
//        $client->submitForm('Submit', [
//            'comment_form[author]' => 'Fabien',
//            'comment_form[text]' => 'Some feedback from an automated functional test',
//            'comment_form[email]' => $email = 'me@automat.ed',
//            'comment_form[photo]' => dirname(__DIR__, 2).'/public/images/under-construction.gif',
//        ]);
//        $this->assertResponseRedirects();
//
//        $comment = self::$container->get(CommentRepository::class)->findByEmail($email);
//        $comment[0]->setState('published');
//        self::$container->get(EntityManagerInterface::class)->flush();

//        $client->followRedirect();
        $this->assertSelectorExists('div:contains("There are 2 comments")');
    }

    public function testConferencePage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertCount(2, $crawler->filter('h4'));

        $client->clickLink('View');

        $this->assertPageTitleContains('Amsterdam');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Amsterdam 2019 Conference');
        $this->assertSelectorExists('div:contains("There are 2 comments")');
    }
}
