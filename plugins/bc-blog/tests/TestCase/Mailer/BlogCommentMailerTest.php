<?php
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) NPO baser foundation <https://baserfoundation.org/>
 *
 * @copyright     Copyright (c) NPO baser foundation
 * @link          https://basercms.net baserCMS Project
 * @since         5.0.0
 * @license       https://basercms.net/license/index.html MIT License
 */

namespace BcBlog\Test\TestCase\Mailer;

use BaserCore\Service\ContentsService;
use BaserCore\Service\ContentsServiceInterface;
use BaserCore\Test\Scenario\InitAppScenario;
use BaserCore\TestSuite\BcTestCase;
use BcBlog\Mailer\BlogCommentMailer;
use BcBlog\Model\Entity\BlogPost;
use BcBlog\Service\BlogCommentsService;
use BcBlog\Service\BlogCommentsServiceInterface;
use BcBlog\Service\BlogPostsService;
use BcBlog\Service\BlogPostsServiceInterface;
use BcBlog\Test\Scenario\BlogCommentsServiceScenario;
use BcBlog\Test\Scenario\BlogContentScenario;
use Cake\Routing\Router;
use Cake\TestSuite\IntegrationTestTrait;
use CakephpFixtureFactories\Scenario\ScenarioAwareTrait;

/**
 * BlogCommentMailerTest
 * @property  BlogCommentMailer $BlogCommentMailer
 * @property BlogCommentsService $BlogCommentsService

 *
 */
class BlogCommentMailerTest extends BcTestCase
{

    /**
     * Trait
     */
    use ScenarioAwareTrait;
    use IntegrationTestTrait;
    /**
     * set up
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->BlogCommentsService = new BlogCommentsService();
    }

    /**
     * tearDown
     *
     * @return void
     */
    public function tearDown(): void
    {
        parent::tearDown();
    }


    /**
     * test sendCommentToAdmin
     */
    public function test_sendCommentToAdmin()
    {
        $this->loadFixtureScenario(InitAppScenario::class);
        $this->loadFixtureScenario(
            BlogContentScenario::class,
            1,  // id
            1, // siteId
            null, // parentId
            'news1', // name
            '/news/' // url
        );
        $this->loadFixtureScenario(BlogCommentsServiceScenario::class);
        $blogComment = $this->BlogCommentsService->get(1);
        $blogPostsService = $this->getService(BlogPostsServiceInterface::class);
        $blogPost = $blogPostsService->get(1);
        $contentService = $this->getService(ContentsServiceInterface::class);
        $content = $blogPost->blog_content->content;
        $site = $content->site;
        $postUrl = $contentService->getUrl($content->url .  '/archives/' . $blogPost->no, true, $site->use_subdomain);
        $mailer = $this->execPrivateMethod($this->BlogCommentsService, 'getMailer', ['BcBlog.BlogComment']);
        try {
            $result = $mailer->send('sendCommentToAdmin',
                [
                    $site->title,
                    [
                        'blogComment' => $blogComment,
                        'blogPost' => $blogPost,
                        'contentTitle' => $content->title,
                        'postUrl' => $postUrl,
                        'adminUrl' => Router::url([
                            'plugin' => 'BcBlog',
                            'prefix' => 'Admin',
                            'controller' => 'BlogComments',
                            'action' => 'index',
                            $blogComment->blog_content_id
                        ], true)
                    ]
                ]);
            dd($result);
        } catch (\Throwable $e) {
            throw $e;
        }
        //準備

        //正常系実行

        //異常系実行


    }

    /**
     * test sendCommentToUser
     */
    public function test_sendCommentToUser()
    {
        //準備

        //正常系実行

        //異常系実行


    }

}
