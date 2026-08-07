<?php

it('returns the prototype home screen for guests', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Find the best local professionals.');
    $response->assertSee('Sign in');
});
