<?php


class HomeTest extends TestCase
{
    public function testHomeRouteExiste()
    {
        $this->get('/');
        $this->assertResponseStatus(200, $this->response->status());
    }
}
