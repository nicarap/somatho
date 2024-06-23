<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Invoice</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .text-primary-500 {
            color: #4b7c7f;
        }

        .text-primary-200 {
            color: #8ebaba;
        }

        h2 {
            margin: 0;
            text-transform: uppercase;
        }

        .invoice-container {
            width: 700px;
            position: relative;
            margin: 0 auto;
            height: 98vh;
            margin-top: 1vh;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
        }

        .invoice-body {
            margin-top: 30px;
            flex-grow: 1;
        }

        .invoice-footer {
            padding-top: 1rem;
            padding-bottom: 1rem;
            padding-left: 20px;
            padding-right: 20px;
        }

        .bg-gray {
            background-color: #4b7c7f50;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            font-size: .875rem;
        }

        .invoice-table th,
        .invoice-table td {
            padding: 8px 16px;
            text-align: left;
            margin-top: 30px;
            border-bottom-width: 1px;
            font-weight: 500;
            text-align: left;
            padding-top: 0;
            padding-left: 2rem;
            padding-bottom: 0.75rem;
            padding: 1rem;
        }

        .invoice-table th {
            background-color: #325053;
            color: white;
        }

        .invoice-table tr:nth-child(odd):not(:last-child) {
            background-color: #dcebeb;
            color: #325053;
        }

        .total-price {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            text-wrap: nowrap;
            padding: 0.2rem;
        }

        .subtitle {
            text-transform: uppercase;
        }

        .fill-primary-200 {
            fill: #4b7c7f
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <div class="custom-shape-divider-top-1703755415 -top-1 md:-top-3"
                 style="
               position: absolute;
               left: 0;
               width: 100%;
               overflow: hidden;
               top: 0;
               line-height: 0;
               
               ">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                     preserveAspectRatio="none" class="fill-primary-200">
                    <path d="
             M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
                          opacity=".25" class="shape-fill">
                    </path>
                    <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z"
                          opacity=".5" class="shape-fill"></path>
                    <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"
                          class="shape-fill"></path>
                </svg>
            </div>
            <div style="padding-top: 80px; 
                padding-left: 20px;
                padding-right: 20px;">
                @php($therapist = $invoice->traitment->therapist)
                @php($therapist_address = $invoice->traitment->therapist->address)
                <table style="width: 100%;">
                    <tbody>
                        <tr>
                            <td style="width:100%"><span>{{ $therapist->name }}</span></td>
                            <td rowspan="5"><span class="subtitle text-primary-200">
                                    <div class="text-primary-200 fill-primary-200" style="height: 8rem;">
                                        <img src="images/test.png" />
                                    </div>
                                </span></td>
                        </tr>
                        <tr>
                            <td><span>Tel : {{ $therapist->tel }}</span></td>
                        </tr>
                        <tr>
                            <td><span>Email: {{ $therapist->email }}</span></td>
                        </tr>
                        <tr>
                            <td>
                                <span>{{ $therapist_address->city }}</span>,
                                <span>{{ $therapist_address->context }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>

                                <span>{{ $therapist_address->postcode }}</span>, {{ $therapist_address->street }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="fill-primary-200" style="; display: flex; width: 100%; justify-content: flex-end;">

                </div>
            </div>
        </div>

        <div class="invoice-body">

            <div class="bg-gray"
                 style="padding-top: 2rem; padding-bottom: 2rem; padding-left: 20px; padding-right: 20px;">
                {{-- INVOICE INFORMATIONS --}}
                <div>
                    <h2 class="text-primary-500">Facture</h2>
                    <div>Numéro de facture : {{ $invoice->number }}</div>
                    <div>Date :
                        {{ \Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y') }} à
                        {{ \Carbon\Carbon::parse($invoice->created_at)->format('H:i') }}
                    </div>
                </div>
            </div>

            <div style="margin-top: 2rem; padding-left: 20px; padding-right: 20px;">
                <table>
                    <tr>
                        <td>
                            <strong class="text-primary-500">{{ $invoice->traitment->patient->name }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>{{ $invoice->patient_street }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>{{ $invoice->patient_context }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>{{ $invoice->patient_postcode }}</span>,
                            <span>{{ $invoice->patient_city }}</span>
                        </td>
                    </tr>
                </table>
            </div>
            <div style="padding-left: 20px; padding-right: 20px;">
                <table class="invoice-table" style="margin-top: 20px;">
                    <thead>
                        <tr>
                            <th class="subtitle">Prestation du
                                {{ \Carbon\Carbon::parse($invoice->realized_at)->format('d/m/Y') }}</th>
                            <th class="subtitle">Tarif</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 100%; font-size:normal"> Soin somatopathie </td>
                            <td style="text-align: right;">{{ $invoice->traitment->price }}€</td>
                        </tr>
                        <tr>
                            <td style="padding:0.2rem;border:0"></td>
                            <td style="padding:0.2rem;border:0"></td>
                        </tr>
                        <tr style="border:0; padding:0">
                            <td style="border:0"></td>
                            <td class="bg-gray total-price" style="padding:0; font-size: 16px;">
                                <table style="width: 100%; border:0">
                                    <tr>
                                        <td style="border:0; white-space: nowrap;"><span class="subtitle">Total :</span>
                                        </td>
                                        <td style="border:0; text-align: right;" class="text-primary-500">
                                            <strong>{{ $invoice->traitment->price }}€</strong>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>



        <div class="invoice-footer">
            <table style="width: 100%;">
                <tbody>
                    <tr style="font-size:10px">
                        <td>Note d'honoraire émise le
                            {{ \Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y') }} à
                            {{ \Carbon\Carbon::parse($invoice->created_at)->format('H:i') }}</td>
                    </tr>
                    <tr style="font-size:10px">
                        <td>N° SIRET : {{ $invoice->traitment->therapist->siren }}</td>
                    </tr>
                    <tr style="font-size:10px">
                        <td>TVA non applicable en vertu de l'article 261 du Code Général des impôts.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
