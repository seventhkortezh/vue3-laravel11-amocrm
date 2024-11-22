<?php
namespace App\Services;

use GuzzleHttp\Client;
use App\Models\Deal;
use App\Models\Contact;

class AmoCrmService
{
    protected Client $client;
    protected array $config;

    public function __construct()
    {
        $this->config = config('amocrm');

        $this->client = new Client([
            'base_uri' => 'https://' . $this->config['sub_domain'] . '.amocrm.ru/api/v4/',
            'headers' => [
                'Authorization' => 'Bearer ' . $this->config['access_token'],
                'User-Agent' => 'AmoAppIntegration 1.0.0',
            ]
        ]);
    }

    public function fetchDeals(): array
    {
        $response = $this->client->get('leads?with=contacts');
        $deals = json_decode($response->getBody(), true)['_embedded']['leads'] ?? [];

        return $deals;
    }

    // Метод для создания контакта в AmoCRM
    public function createContact(Contact $contact): array
    {
        try {
            $response = $this->client->post('contacts', [
                'json' => [
                    [
                        'name' => $contact->name,
                        'custom_fields_values' => [
                            [
                                'field_code' => 'PHONE',
                                'field_type' => 'multitext',
                                'values' => [
                                    [
                                        'value' => $contact->phone,
                                        'enum_code' => "MOB"
                                    ]
                                ],
                            ]
                        ],
                    ],
                ],
            ]);
        }catch (\Exception $exception){
            HistoryService::log(HistoryService::CONTACT_TYPE, $contact->id, $exception->getMessage(), false);
        }

        return json_decode($response->getBody(), true);
    }

    // Метод для создания примечаения контакта в AmoCRM
    public function createNote(Contact $contact, int $contactIdInAmo): array
    {
        $response = $this->client->post('contacts/' . $contactIdInAmo . '/notes', [
            'json' => [
                [
                    'note_type' => 'common',
                    'params' => [
                        'text' => $contact->comment,
                    ],
                ]
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    // Метод для связывания контактов со сделками
    public function linkContactToDeal(int $contactIdInAmo, int $dealId): void
    {
        $this->client->post("leads/{$dealId}/link", [
            'json' => [
                [
                    'to_entity_id' => $contactIdInAmo,
                    'to_entity_type' => 'contacts',
                    'metadata' => [
                        'is_main' => true,
                    ]
                ]
            ],
        ]);
    }
}
