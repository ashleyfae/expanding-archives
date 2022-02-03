<?php
/**
 * ApiTestCase.php
 *
 * @package   expanding-archives
 * @copyright Copyright (c) 2022, Ashley Gibson
 * @license   GPL2+
 */

namespace Ashleyfae\ExpandingArchives\Tests\Helpers;

use PHPUnit\Framework\TestCase;

/**
 * @mixin TestCase
 */
class ApiTestCase extends \WP_UnitTestCase
{
    protected static \WP_REST_Server $server;

    public static function set_up_before_class()
    {
        parent::set_up_before_class();

        global $wp_rest_server;
        self::$server = $wp_rest_server = new \WP_REST_Server();

        do_action('rest_api_init');
    }

    protected function makeRestRequest(int $year, int $month): \WP_REST_Response
    {
        $request = new \WP_REST_Request(
            \WP_REST_Server::READABLE,
            '/expanding-archives/v1/posts/'.$year.'/'.$month
        );

        $request->set_header('Content-Type', 'application/json');

        return self::$server->dispatch($request);
    }
}
