<?php

namespace App\Controllers;

class Invoices extends BaseController
{
    private $CLIENT_ID = 'Aey4XuNX5a-_LscBoTyfeCCZ961JECBk_UpAQ3jT3D7ZSYjSZwfOhUXGPULV8IzH0dGhTUvSFihr7Oiy';
    private $CLIENT_SECRET = 'EMU8or-v8DG_x-yGFrpcLqA0d3NY6c0uQ8ofenQP1o-NJL2rPwFvKhvDeAmEBIpZSjap_VZhvVks4WjN';
    private $auth = null;
    private $access_token = null;
    public function __construct()
    {
        $this->auth = service("auth");
        $this->access_token = $this->getPayPalAccessToken($this->CLIENT_ID, $this->CLIENT_SECRET);
    }
    public function index()
    {
        if (!$this->auth->getUserRole()->CanViewInvoice) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $invoices = $this->getAllInvoices();
        return view("Invoices/index", ['invoices' => $invoices->items]);
    }
    public function view($invoice_id)
    {
        if (!$this->auth->getUserRole()->CanViewInvoice) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        // dd($this->getInvoiceDetails($invoice_id));
        return view('Invoices/view', ['invoice' => $this->getInvoiceDetails($invoice_id)]);
    }
    public function delete()
    {
        $invoice_id = $this->request->getGet('delete_id');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v2/invoicing/invoices/' . $invoice_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->access_token
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        if (json_decode($response) == null) {
            $output = array('success', "Invoice deleted successfully.");
            return $this->response->setJSON($output);
        } else {
            $output = array('failure', "Invoice cannot be deleted.");
            return $this->response->setJSON($output);
        }
    }
    public function send($invoice_id)
    {
        dd($this->sendInvoice($invoice_id));
    }
    private function getPayPalAccessToken($client_id, $client_secret)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v1/oauth2/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials&ignoreCache=true&return_authn_schemes=true&return_client_metadata=true&return_unconsented_scopes=true',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic QWV5NFh1Tlg1YS1fTHNjQm9UeWZlQ0NaOTYxSkVDQmtfVXBBUTNqVDNEN1pTWWpTWndmT2hVWEdQVUxWOEl6SDBkR2hUVXZTRmlocjdPaXk6RU1VOG9yLXY4REdfeC15R0ZycGNMcUEwZDNOWTZjMHVROG9mZW5RUDFvLU5KTDJyUHdGdktodkRlQW1FQklwWlNqYXBfVlpodlZrczRXak4=',
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response, true);
        return $response['access_token'];
    }
    private function getAllInvoices()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v2/invoicing/invoices?page=1&page_size=10&total_required=true&fields=amount,items',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->access_token
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
    private function getInvoiceDetails($invoice_id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v2/invoicing/invoices/' . $invoice_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->access_token
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
    private function sendInvoice($invoice_id, $additionalCC = null)
    {
        // $request_id = com_create_guid();
        $post_data = array(
            'subject' => '<Payment Notification for Remote Estimation LLC>',
            "send_to_recipient" => true,
            "additional_recipients" => $additionalCC,
            "send_to_invoicer" => false
        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v2/invoicing/invoices/' . $invoice_id . '/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "subject": "<The subject of the email that is sent as a notification to the recipient.>",
                "note": "<A note to the payer.>",
                "send_to_recipient": true,
                "send_to_invoicer": false
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'PayPal-Request-Id: c1104c36-5389-482a-b374-127bda14ca7c',
                'Authorization: Bearer ' . $this->access_token
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
}
