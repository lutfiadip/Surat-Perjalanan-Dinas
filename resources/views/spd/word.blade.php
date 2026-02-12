<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word'
    xmlns='http://www.w3.org/TR/REC-html40'>

<head>
    <meta charset="UTF-8">
    <title>Cetak SPD</title>
    <style>
        /* Basic Reset */
        body,
        p,
        h1,
        h2,
        h3,
        h4,
        table,
        td,
        th {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            line-height: 1.15;
        }

        /* Word Page Setup */
        @page Section1 {
            size: 21.0cm 29.7cm;
            /* A4 */
            margin: 1.5cm 2.0cm 1.5cm 2.0cm;
            mso-header-margin: 35.4pt;
            mso-footer-margin: 35.4pt;
            mso-paper-source: 0;
        }

        div.Section1 {
            page: Section1;
        }

        /* Page 2 (New Section) */
        @page Section2 {
            size: 21.0cm 29.7cm;
            /* A4 */
            margin: 1.5cm 1.0cm 1.5cm 2.0cm;
            mso-header-margin: 35.4pt;
            mso-footer-margin: 35.4pt;
            mso-paper-source: 0;
        }

        div.Section2 {
            page: Section2;
        }

        /* Tighter margins for Page 3 (Back Page) */
        @page Section3 {
            size: 21.0cm 29.7cm;
            /* A4 */
            margin: 1.27cm 1.0cm 0.3cm 2.0cm;
            /* Top relaxed, Bottom tight */
            mso-header-margin: 0pt;
            mso-footer-margin: 0pt;
            mso-paper-source: 0;
        }

        div.Section3 {
            page: Section3;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            mso-table-layout-alt: fixed;
        }

        td {
            vertical-align: top;
            padding: 2px;
        }

        /* Helpers */
        .bold {
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .justify {
            text-align: justify;
        }

        .border {
            border: 1px solid black;
        }

        /* Specific override for Page 3 */
        #page3table,
        #page3table tr,
        #page3table td,
        #page3table th,
        #page3table div,
        #page3table p,
        #page3table span {
            font-size: 10pt !important;
        }
    </style>
</head>

<body>
    @include('spd.partials.word_content')
</body>

</html>