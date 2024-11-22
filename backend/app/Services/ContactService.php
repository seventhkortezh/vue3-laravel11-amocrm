<?php
namespace App\Services;

use App\Models\Contact;
use App\Models\Deal;
use Carbon\Carbon;

class ContactService
{
    /**
     * Метод проверяет если ли приязанный контакт и возвращает его Id
     * @todo получать все контакты и сохранять локально, с множественной привязкой к сделкам
     * @param array $embedded
     * @return int
     */
    public function getContactId(array $embedded): ?int
    {
        if( !empty($embedded['contacts']) ){
            $contact = current($embedded['contacts']);
        }

        return $contact['id'] ?? null;
    }

}
