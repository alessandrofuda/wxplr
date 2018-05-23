<?php

/*
 * This file is part of Laravel Vimeo.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Vimeo Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'client_id' => '6c2d3abe951d47d86a9c2c3c7d840191a0b38f75',
            'client_secret' => 'VUAPkK91/KW8WniuLsbI+0Cf3t9a0KPpKDh+kKZ0H5ftOKVvKN45ytnydw6SP1C/jcVIIz3sTiHpFr+aj5ikAWSUi1L63pH+lBAo8+zndTU1NuFlrG88mRIK0x/iTe1Y',
            'access_token' => 'd8096ba6f94e47974ae83f2bffd11b48',
        ],

        /*'alternative' => [
            'client_id' => '6c2d3abe951d47d86a9c2c3c7d840191a0b38f75',
            'client_secret' => 'VUAPkK91/KW8WniuLsbI+0Cf3t9a0KPpKDh+kKZ0H5ftOKVvKN45ytnydw6SP1C/jcVIIz3sTiHpFr+aj5ikAWSUi1L63pH+lBAo8+zndTU1NuFlrG88mRIK0x/iTe1Y',
            'access_token' => 'd8096ba6f94e47974ae83f2bffd11b48',
        ],*/

    ],

];
