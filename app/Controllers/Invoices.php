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
        $total_items = $invoices->total_items;
        if ($total_items > 100) {
            $remaining_items = $total_items - 100;
            $count = 2;
            while ($remaining_items > 0) {
                $invoices->items = array_merge($invoices->items, $this->getAllInvoices($count)->items);
                $remaining_items = $remaining_items - 100;
                $count++;
            }
        }
        // dd($invoices);
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
        $invoice_id = $this->request->getPost('delete_id');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->API_BASE_URL . '/v2/invoicing/invoices/' . $invoice_id,
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
        // return $this->response->setJSON($response);
        if (json_decode($response) == null) {
            $output = array('status' => "success", 'message' => "Invoice deleted!");
            return $this->response->setJSON($output);
        } else {
            $output = array('status' => "error", 'message' => "Failed!", "response" => $response);
            return $this->response->setJSON($output);
        }
    }
    public function cancel()
    {
        $invoice_id = $this->request->getPost('cancel_id');
        $response = $this->cancelPayPalInvoice($invoice_id);
        // return $this->response->setJSON($response);
        if ($response == null) {
            $output = array('status' => "success", 'message' => "Invoice cancelled!");
            return $this->response->setJSON($output);
        } else {
            $output = array('status' => "error", 'message' => "Failed!", "response" => $response);
            return $this->response->setJSON($output);
        }
    }
    public function remind()
    {
        $invoice_id = $this->request->getPost('invoice_id');
        $invoice_details = $this->getInvoiceDetails($invoice_id);
        $response = $this->sendPayPalInvoiceReminder($invoice_id, $invoice_details);
        if ($response == null) {
            $output = array('status' => "success", 'message' => "Invoice reminder sent successfully!");
            return $this->response->setJSON($output);
        } else {
            $output = array('status' => "error", 'message' => "Failed!", "response" => $response);
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
    private function getAllInvoices($page = 1)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->API_BASE_URL . '/v2/invoicing/invoices?page=' . $page . '&page_size=100&total_required=true&fields=amount,items',
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
    public function sendInvoice($invoice_id, $additionalCC = null)
    {


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
                "subject": "<Payment Invoice | Remote Estimation LLC.>",
                "note": "<All checks must be paid to Remote Estimation LLC.>",
                "send_to_recipient": true,
                "send_to_invoicer": true
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'PayPal-Request-Id: 509a22c1-b7f6-4f2f-990b-5d47637a72fb',
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
                "note" => "All cheques must be Paid to Remote Estimation LLC.",
            ),
            "invoicer" => array(
                "name" => [
                    "given_name" => "Remote",
                    "surname" => "Estimation",
                    "full_name" => "Remote Estimation"
                ],
                "address" => [
                    "address_line_1" => "356 wayne st",
                    "address_line_2" => "",
                    "admin_area_2" => "Jersey City",
                    "admin_area_1" => "NJ",
                    "postal_code" => "07302",
                    "country_code" => "US"
                ],
                "phones" => [
                    0 => [
                        "country_code" => "001",
                        "national_number" => "2018952723",
                        "phone_type" => "MOBILE"
                    ]
                ],
                "website" => "http://remoteestimation.us",
                "tax_id" => "85-2178360",
                "logo_url" => "https://pics.paypal.com/00/s/NDEzWDEwNzlYSlBH/p/MGEyY2E1MmUtZmZiYi00YTU1LWEzN2UtMjgxMjhlZjMwYjM3/image_109.JPG",
                "additional_notes" => "<Any additional information. Includes business hours.>"
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
                        "value" => ($total_amount - ($total_amount * ($data["Quotation"]["Discount"] / 100))) / 2
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
        $response = json_decode($response);
        return ($response);
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
    private function cancelPayPalInvoice($invoice_id)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->API_BASE_URL . '/v2/invoicing/invoices/' . $invoice_id . '/cancel',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "subject": "<Invoice Cancelled! Remote Estimation LLC>",
                "note": "<Your invoice by Remote Estimation LLC has been cancelled.>",
                "send_to_invoicer": true,
                "send_to_recipient": true
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->access_token
            ),
        ));
        $response = curl_exec($curl);
        $response = json_decode($response);
        if ($response != null) {
            $info = curl_getinfo($curl);
            $response->request = $info;
        }
        curl_close($curl);
        return $response;
    }
    private function sendPayPalInvoiceReminder($invoice_id, $invoice)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->API_BASE_URL . '/v2/invoicing/invoices/' . $invoice_id . '/remind',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "subject": "Reminder: Payment due for the invoice #'.$invoice->detail->invoice_number.'",
                "note": "Please pay before the due date to avoid incurring late payment charges which will be adjusted in the next bill generated.",
                "send_to_recipient": true,
                "send_to_invoicer": true
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->access_token
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
}
