<?php
namespace App\Services;

use App\Models\Contact;
use App\Models\Deal;
use Carbon\Carbon;

class DealService
{
    public function importMany(array $dealsData): void
    {
        $deals = Deal::all();
        $contactService = new ContactService();

        foreach ($dealsData as $dealData) {
            try {
                if( $deals->contains('external_id', $dealData['id']) ){
                    $deal = $deals->where('external_id', $dealData['id'])->first();
                    $action = 'update';
                }else{
                    $deal = new Deal();
                    $action = 'add';
                }

                $deal->contact_id = $contactService->getContactId($dealData['_embedded']);
                $deal->external_id = $dealData['id'];
                $deal->name = $dealData['name'];
                $deal->date = new Carbon($dealData['created_at']);

                $deal->save();

                HistoryService::log(HistoryService::DEAL_TYPE, $deal->refresh()->id, $action . ' deal', true);
            } catch (\Exception $e) {
                HistoryService::log(HistoryService::DEAL_TYPE, $deal?->id ?? 0, $e->getMessage(), false);
            }

        }
    }

}
