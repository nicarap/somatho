<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .text-primary {
            color: #52b8e3;
        }

        h2 {
            margin: 0;
            text-transform: uppercase;
        }

        .invoice-container {
            width: 700px;
            position: relative;
            height: 100vh;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        .invoice-body {
            margin-top: 30px;
        }

        .bg-gray {
            background-color: rgb(240, 240, 241);
        }

        .invoice-patient {
            padding: 0.5rem;
            margin-top: 1rem;
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

            border: 1px solid rgb(187, 190, 196);
        }

        .invoice-table th {
            color: rgb(148 163 184);
            background-color: rgb(226 232 240);
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
            color: rgb(148 163 184);
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h2 class="text-primary">Facture</h2>
            @php($therapist = $invoice->traitment->therapist)
            @php($therapist_address = $invoice->traitment->therapist->addresses()->firstWhere('default', true) ?? $invoice->traitment->therapist->addresses()->first())
            <table style="width: 100%;">
                <tbody>
                    <tr>
                        <td><span class="subtitle">Adresse</span></td>
                        <td><span class="subtitle">thérapeute</span></td>
                    </tr>
                    <tr>
                        <td>{{ $therapist_address->street }}</td>
                        <td><span>{{ $therapist->name }}</span></td>
                    </tr>
                    <tr>
                        <td><span>{{ $therapist_address->context }}</span></td>
                        <td><span>{{ $therapist->tel }}</span></td>
                    </tr>
                    <tr>
                        <td><span>{{ $therapist_address->postcode }}</span></td>
                        <td><span>{{ $therapist->email }}</span></td>
                    </tr>
                    <tr>
                        <td><span>{{ $therapist_address->city }}</span></td>
                    </tr>
                </tbody>
            </table>

        </div>

        <div class="invoice-body">
            <div>
                <h2 class="text-primary">Note d'honoraires</h2>
                <small>Facture N° <strong>{{ $invoice->number }}</strong></small>
            </div>

            <div class="invoice-patient bg-gray">
                <table style="width: 100%">
                    <tr>
                        <td>
                            <strong>{{ $invoice->traitment->patient->name }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>{{ $invoice->patient_label }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>{{ $invoice->patient_context }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>{{ $invoice->patient_postcode }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>{{ $invoice->patient_city }}</span>
                        </td>
                    </tr>
                </table>
            </div>

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
                        <td style="width: 100%; font-size:normal"> Soin somatopathique </td>
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
                                    <td style="border:0; text-align: right;" class="text-primary">
                                        <strong>{{ $invoice->traitment->price }}€</strong>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
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
                        <td>N° SIRET {{ $invoice->traitment->therapist->siren }}</td>
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
