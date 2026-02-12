<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak SPD Massal</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            line-height: 1.2;
            color: #000;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 15mm 20mm;
            margin: 0 auto;
            background: white;
            box-sizing: border-box;
            position: relative;
        }

        /* KOP SURAT */
        .kop-container {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        .kop-logo {
            width: 70px;
            height: auto;
            margin-right: 15px;
            margin-left: 20px;
        }

        .kop-text {
            text-align: center;
            flex: 1;
        }

        .kop-text h3 {
            font-size: 12pt;
            margin: 0;
            font-weight: normal;
        }

        .kop-text h2 {
            font-size: 16pt;
            margin: 0;
            font-weight: bold;
        }

        .kop-text p {
            font-size: 9pt;
            margin: 2px 0;
        }

        /* BODY SURAT */
        .title-surat {
            text-align: center;
            font-weight: bold;
            font-size: 12pt;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }

        .nomor-surat {
            text-align: center;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .section-row {
            display: flex;
            margin-bottom: 8px;
        }

        .label-col {
            width: 150px;
            flex-shrink: 0;
            font-weight: normal;
        }

        .colon-col {
            width: 20px;
            text-align: center;
            font-weight: bold;
        }

        .value-col {
            flex: 1;
            text-align: justify;
        }

        /* KEPADA LIST */
        .kepada-list-item {
            display: flex;
            margin-bottom: 0;
        }

        .kepada-num {
            width: 20px;
            flex-shrink: 0;
        }

        .kepada-content {
            flex: 1;
            text-align: justify;
        }

        .kepada-row {
            display: flex;
        }

        .k-label {
            width: 100px;
        }

        .k-colon {
            width: 15px;
            text-align: center;
        }

        .k-val {
            flex: 1;
            text-align: justify;
        }

        /* UNTUK LIST */
        .untuk-item {
            display: flex;
            margin-bottom: 5px;
            align-items: flex-start;
        }

        .disk-row {
            display: flex;
        }

        /* SIGNATURE */
        .signature-container {
            float: right;
            width: 300px;
            margin-top: 15px;
            text-align: left;
        }

        /* SPD TABLE SPECIFIC */
        .spd-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10pt;
            font-family: Arial, Helvetica, sans-serif;
        }

        .spd-table td {
            border: 1px solid #000;
            padding: 3px;
            vertical-align: top;
        }

        @media print {

            body,
            html {
                width: 100%;
                height: auto;
            }

            .page {
                width: 210mm;
                height: auto;
                min-height: 0;
                margin: 0;
                padding: 15mm 20mm;
                box-shadow: none;
                border: none;
                overflow: hidden;
                page-break-after: always;
            }

            .page:last-child {
                page-break-after: auto;
            }
        }
    </style>
</head>

<body>
    @foreach ($payloads as $payload)
        @include('spd.partials.print_content', $payload)
    @endforeach

    <script>
        window.print();
    </script>
</body>

</html>