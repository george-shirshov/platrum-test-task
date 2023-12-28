<?php

enum WebhookType: string
{
    case MESSAGE = 'message';
}

class WebhookController
{
    /**
     * @param array $data webhook body
     * @return void
     * @throws Exception
     */
    public function processWebhook(array $data): void
    {
        $type = $data['type'];

        if ($type !== WebhookType::MESSAGE->value) {
            throw new Exception('Unsupported type');
        }

        // нет смысла проверять текст сообщения, так как при $type !== 'message', происходит выход из метода

        $data['fields'] = json_decode($data['fields'], true);

        try {
            $this->_storeDeal('Deal from webhook', $data);
        } catch (Exception $e) {
            // todo уведомить в лог о дублирующем запросе / пропустить
        }
    }

    /**
     * @throws Exception
     */
    private function _storeDeal(string $title, array $webhookData): void
    {
        //some logic to store Deal in database
    }

    private function _setDataToCache(string $key, array $data, int $expires): void
    {
        //save data to cache with expire time (in seconds)
    }

    private function _getDealByExternalId(string $externalId): ?array
    {
        //returns deal from db if its exists, if not - returns null
        return [];
    }

    private function _getDataFromCache(string $key): ?string
    {
        //returns data from cache by key
        return null;
    }
}
