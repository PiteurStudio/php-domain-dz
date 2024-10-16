<?php

namespace PiteurStudio;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\Retry\GenericRetryStrategy;
use Symfony\Component\HttpClient\RetryableHttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class NicDz
{
    public string $domain;

    public int $timeout = 3;

    public int $maxRetries = 3;

    private string $nicdz_endpoint = 'https://api.nic.dz/';

    private HttpClientInterface $client;

    private ?ResponseInterface $response = null;

    private array $whoisData = [];

    public function __construct(string $domain)
    {
        $this->domain = $domain;

        $this->client = HttpClient::create([
            'verify_peer' => false,
            'verify_host' => false,
            'timeout' => $this->timeout, // Timeout in seconds
        ]);

        // Retry  on nic.dz api fail  (400 : Bad request and 409 : Conflict status codes)

        $this->client = new RetryableHttpClient(
            $this->client,
            new GenericRetryStrategy([400, 409]), // Retry on these status codes, max 3 retries
            $this->maxRetries, // Max retry attempts
        );

        try {
            $this->response = $this->client->request(
                'GET',
                $this->nicdz_endpoint.'v1/domains/'.$this->domain,
            );
        } catch (TransportExceptionInterface $e) {
            throw new \RuntimeException('Error retrieving domain data: '.$e->getMessage());
        }
    }

    /**
     * Check if the domain is available.
     */
    public function isAvailable(): bool
    {
        $statusCode = $this->response->getStatusCode();

        // 302	=> successful operation ( strange status code from nic.dz ) , mean domain is not available

        if ($statusCode === 302) {
            return false;
        } elseif ($statusCode === 404) {
            return true;
        }

        throw new \RuntimeException('Unexpected status code: '.$statusCode);
    }

    /**
     * Get WHOIS information for the domain.
     *
     * @return NicDz
     *
     * @throws \Exception if domain is available or no WHOIS data is present
     */
    public function whois(): static
    {

        $array = $this->response->toArray(false); // use `false` to bypass 302 status code exception

        if ($this->isAvailable()) {

            $this->whoisData = [
                'domain' => $this->domain,
                'title' => 'Whois Record Not Available',
                'message' => 'This domain is not registered.',
            ];

        } else {

            // Remove id and _links keys as they are not needed in most cases
            unset($array['id']);
            unset($array['_links']);

            $this->whoisData = $array;

        }

        return $this;
    }

    /*Whois Record Not Available*/

    public function toArray(): array
    {
        return $this->whoisData;
    }

    public function toJson(): string
    {
        return json_encode($this->whoisData);
    }

    public function toObject(): object
    {
        return json_decode($this->toJson());
    }

    public function toString(): string
    {
        $result = '';

        foreach ($this->whoisData as $key => $value) {
            $result .= $key.' : '.$value."\n"; // Append key : value and newline
        }

        return $result;
    }
}
