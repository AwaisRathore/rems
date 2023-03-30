<?php

namespace App\Controllers;

// use APP\Models\QuotationModel;

class Invoices extends BaseController
{
    private $CLIENT_ID = 'Aey4XuNX5a-_LscBoTyfeCCZ961JECBk_UpAQ3jT3D7ZSYjSZwfOhUXGPULV8IzH0dGhTUvSFihr7Oiy';
    private $CLIENT_SECRET = 'EMU8or-v8DG_x-yGFrpcLqA0d3NY6c0uQ8ofenQP1o-NJL2rPwFvKhvDeAmEBIpZSjap_VZhvVks4WjN';
    private $API_BASE_URL = 'https://api-m.sandbox.paypal.com';
    private $auth = null;
    private $access_token = null;
    private $quotationModel = null;
    public function __construct()
    {
        $this->auth = service("auth");
        $this->access_token = $this->getPayPalAccessToken($this->CLIENT_ID, $this->CLIENT_SECRET);
        $this->quotationModel = new \App\Models\QuotationModel();
    }
    public function index()
    {
        if (!$this->auth->getUserRole()->CanViewInvoice) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $invoices = $this->getAllInvoices();
        $invoice_quotations = $this->quotationModel->getInvoicesWithQuotations();
        return view("Invoices/index", ['invoices' => $invoices->items, 'invoice_quotations' => $invoice_quotations]);
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
            CURLOPT_URL => $this->API_BASE_URL . '/v1/oauth2/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials&ignoreCache=true&return_authn_schemes=true&return_client_metadata=true&return_unconsented_scopes=true',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));
        curl_setopt($curl, CURLOPT_USERPWD, $client_id . ':' . $client_secret);
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);
        return $response['access_token'];
    }
    private function getAllInvoices()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->API_BASE_URL . '/v2/invoicing/invoices?page=1&page_size=10&total_required=true&fields=amount,items',
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
            CURLOPT_URL => $this->API_BASE_URL . '/v2/invoicing/invoices/' . $invoice_id,
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
            CURLOPT_URL => $this->API_BASE_URL . '/v2/invoicing/invoices/' . $invoice_id . '/send',
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
    public function createPayPalInvoice($data)
    {
        $invoice_number = $this->generateInvoiceNumber();
        $client_name_array = explode(" ", $data['Quotation']['Client_Name']);
        $client_email = $data['Quotation']['Client_EmailAddress'];
        $items = [];
        $total_amount = 0;
        foreach ($data['Projects'] as $project) {
            $description = [];
            foreach ($data['ProjectScopes'] as $scope) {
                if ($scope['Project_Id'] == $project['Id']) {
                    array_push($description, $scope['Type_Names']);
                }
            }
            $total_amount += $project['Lump_Sump_Charges'];
            $item = array(
                "name" => $project['Project_Name'],
                "description" => ' ' . join(',', $description) . ' ',
                "quantity" => "1",
                "unit_amount" => [
                    "currency_code" => "USD",
                    "value" => $project['Lump_Sump_Charges'] . ".00"
                ],
                "discount" => [
                    "percent" => "0"
                ],
                "unit_of_measure" => "QUANTITY"
            );
            array_push($items, $item);
        }
        $post_data = array(
            "detail" => array(
                "invoice_number" => $invoice_number,
                "invoice_date" =>  date('Y-m-d'),
                "payment_term" => array(
                    "term_type" => "DUE_ON_RECEIPT",
                    "due_date" => date('Y-m-d')
                ),
                "currency_code" => "USD",
                "note" => "All checks must be Paid to Remote Estimation LLC.",
            ),
            "primary_recipients" => array(
                0 => array(
                    "billing_info" => array(
                        "name" => array(
                            "given_name" => $client_name_array[0],
                            "surname" => (isset($client_name_array[1])) ? $client_name_array[1] : " "
                        ),
                        "email_address" =>  $client_email,
                    ),
                )
            ),
            "items" => $items,
            "configuration" => array(
                "partial_payment" => array(
                    "allow_partial_payment" => true,
                    "minimum_amount_due" => array(
                        "currency_code" => "USD",
                        "value" => $total_amount / 2
                    )
                ),
                "allow_tip" => true,
            ),
            "amount" => array(
                "breakdown" => array(
                    "item_total" => array(
                        "currency_code" => "USD",
                        "value" => $total_amount
                    ),
                    "discount" => array(
                        "invoice_discount" => array(
                            "percent" => $data["Quotation"]["Discount"]
                        )
                    )
                )
            )
        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->API_BASE_URL . '/v2/invoicing/invoices',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($post_data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'PayPal-Request-Id: 93686827-f664-4bbb-9179-90a6a96fc676',
                'Prefer: return=representation',
                'Authorization: Bearer ' . $this->access_token
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
    private function generateInvoiceNumber()
    {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->API_BASE_URL . '/v2/invoicing/generate-next-invoice-number',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->access_token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
        return $response->invoice_number;
    }
}

// CURLOPT_POSTFIELDS => '{
//     "detail": {
//         "invoice_number": "' . $invoice_number . '",
//         "invoice_date": "' . date('Y-m-d') . '",
//         "payment_term": {
//             "term_type": "DUE_ON_RECEIPT",
//             "due_date": "' . date('Y-m-d') . '"
//         },
//         "currency_code": "USD",
//         "note": "All checks must be Paid to Remote Estimation LLC.",
//     },
//     "primary_recipients": [
//         {
//             "billing_info": {
//                 "name": {
//                     "given_name": "' . $client_name_array[0] . '",
//                     "surname": "' . (isset($client_name_array[1])) ? $client_name_array[1] : "" . '"
//                 },
//                 "email_address": "' . $client_email . '",

//             },

//         }
//     ],
//     "items": ' . json_encode($items) . ',
//     "configuration": {
//         "partial_payment": {
//             "allow_partial_payment": true,
//             "minimum_amount_due": {
//                 "currency_code": "USD",
//                 "value": "' . $total_amount / 2 . '.00"
//             }
//         },
//         "allow_tip": true,
//     },
//     "amount": {
//         "breakdown": {
//             "item_total": {
//                 "currency_code": "USD",
//                 "value": "' . $total_amount . '.00"
//             },
//             "discount": {
//                 "invoice_discount": {
//                     "percent": "' . $data["Quotation"]["Discount"] . '"
//                 }
//             }
//         }
//     }
// }'
