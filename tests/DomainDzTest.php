<?php

use PiteurStudio\NicDz;

test('isAvailable() : return false when domain is not available', function () {

    $domainDz = new NicDz('google.dz');

    expect($domainDz->isAvailable())->toBeFalse();
});

test('isAvailable() :  return true when domain is available', function () {

    $domainDz = new NicDz('google-domain-makacho.dz');

    expect($domainDz->isAvailable())->toBeTrue();
});

it('has whois data when its unavailable', function () {

    $domainDz = new NicDz('google.dz');

    expect($domainDz->whois()->toArray())->toBeArray()
        ->and($domainDz->whois()->toJson())->toBeJson()
        ->and($domainDz->whois()->toObject())->toBeObject()
        ->and($domainDz->whois()->toString())->toBeString();

});

it('has whois message when its available', function () {

    $domainDz = new NicDz('google-makacho.dz');

    expect($domainDz->whois()->toArray())->toBeArray()
        ->and($domainDz->whois()->toJson())->toBeJson()
        ->and($domainDz->whois()->toObject())->toBeObject()
        ->and($domainDz->whois()->toString())->toBeString()
        ->and($domainDz->whois()->toArray())->toBe([
            'domain' => 'google-makacho.dz',
            'title' => 'Whois Record Not Available',
            'message' => 'This domain is not registered.',
        ]);

});
