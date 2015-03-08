<?php

class RenderTreeTextTest extends \TestCase {

    /**
     * @test
     */
    public function should_populate_results()
    {
        $handle = new \AlfredNutileInc\RenderTreeTextGrepperWorker\RenderTreeGrepperHandler();
        $payload = new \AlfredNutileInc\RenderTreeTextGrepperWorker\RenderTreeTextDTO(
            'foo-bar',
            ['foo', 'bar', 'baz'],
            ['text1', 'text2'],
            [
                'caller'     => 'http://someposturl.dev/rendertree_results',
                'params'     => ['foo', 'bar']
            ],
            false,
            false
        );
        $results = $handle->handle($payload);

        var_dump($results);
        $this->assertNotNull($results);
    }
}