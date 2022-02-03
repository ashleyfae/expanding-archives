<?php
/**
 * ApiTest.php
 *
 * @package   expanding-archives
 * @copyright Copyright (c) 2022, Ashley Gibson
 * @license   GPL2+
 */

namespace Ashleyfae\ExpandingArchives\Tests;

use Ashleyfae\ExpandingArchives\Tests\Helpers\ApiTestCase;

/**
 * @coversDefaultClass \Ashleyfae\ExpandingArchives\Api\v1\Posts
 */
class ApiTest extends ApiTestCase
{

    /**
     * Creates some dummy posts before tests run.
     *
     * @return void
     */
    public static function set_up_before_class(): void
    {
        parent::set_up_before_class();

        // 3 posts in February 2022
        self::factory()->post->create_many(3, [
            'post_date'     => '2022-02-03 00:00:00',
            'post_date_gmt' => '2022-02-03 00:00:00',
        ]);

        // 1 post in January 2022
        self::factory()->post->create_many(1, [
            'post_date'     => '2022-01-03 00:00:00',
            'post_date_gmt' => '2022-01-03 00:00:00',
        ]);

        // 2 posts in December 2021
        self::factory()->post->create_many(2, [
            'post_date'     => '2021-12-03 00:00:00',
            'post_date_gmt' => '2021-12-03 00:00:00',
        ]);
    }

    /**
     * @covers \Ashleyfae\ExpandingArchives\Api\v1\Posts::list
     * @covers \Ashleyfae\ExpandingArchives\Api\v1\Posts::formatPost
     * @return void
     */
    public function test_api_call_returns_post_data()
    {
        $response = $this->makeRestRequest(2022, 2);
        $data     = $response->get_data();

        $this->assertSame(200, $response->get_status());
        $this->assertIsArray($data);
        $this->assertArrayHasKey('title', $data[0]);
        $this->assertArrayHasKey('link', $data[0]);
    }

    /**
     * @covers \Ashleyfae\ExpandingArchives\Api\v1\Posts::list
     * @return void
     */
    public function test_2022_2_returns_3_posts()
    {
        $response = $this->makeRestRequest(2022, 2);
        $data     = $response->get_data();

        $this->assertSame(200, $response->get_status());
        $this->assertIsArray($data);
        $this->assertCount(3, $data);
    }

    /**
     * @covers \Ashleyfae\ExpandingArchives\Api\v1\Posts::list
     * @return void
     */
    public function test_2022_1_returns_1_post()
    {
        $response = $this->makeRestRequest(2022, 1);
        $data     = $response->get_data();

        $this->assertSame(200, $response->get_status());
        $this->assertIsArray($data);
        $this->assertCount(1, $data);
    }

    /**
     * @covers \Ashleyfae\ExpandingArchives\Api\v1\Posts::list
     * @return void
     */
    public function test_2021_12_returns_2_posts()
    {
        $response = $this->makeRestRequest(2021, 12);
        $data     = $response->get_data();

        $this->assertSame(200, $response->get_status());
        $this->assertIsArray($data);
        $this->assertCount(2, $data);
    }

    /**
     * @covers \Ashleyfae\ExpandingArchives\Api\v1\Posts::register
     * @return void
     */
    public function test_request_with_invalid_dates_is_404()
    {
        $response = $this->makeRestRequest(0, 0);

        $this->assertSame(404, $response->get_status());
    }

}
