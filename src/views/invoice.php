<?php

session_start();

function generateInvoice($date){
    $invoice = "<!DOCTYPE html>
    <html lang=\"en\">
        <head>
            <meta charset=\"utf-8\" />
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />

            <!-- Invoice styling -->
            <style>
                body {
                    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                    text-align: center;
                    color: #777;
                }

                body h1 {
                    font-weight: 300;
                    margin-bottom: 0px;
                    padding-bottom: 0px;
                    color: #000;
                }

                body h3 {
                    font-weight: 300;
                    margin-top: 10px;
                    margin-bottom: 20px;
                    font-style: italic;
                    color: #555;
                }

                body a {
                    color: #06f;
                }

                .invoice-box {
                    max-width: 800px;
                    margin: auto;
                    padding: 30px;
                    border: 1px solid #eee;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
                    font-size: 16px;
                    line-height: 24px;
                    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                    color: #555;
                }

                .invoice-box table {
                    width: 100%;
                    line-height: inherit;
                    text-align: left;
                    border-collapse: collapse;
                }

                .invoice-box table td {
                    padding: 5px;
                    vertical-align: top;
                }

                .invoice-box table tr td:nth-child(2) {
                    text-align: right;
                }

                .invoice-box table tr.top table td {
                    padding-bottom: 20px;
                }

                .invoice-box table tr.top table td.title {
                    font-size: 45px;
                    line-height: 45px;
                    color: #333;
                }

                .invoice-box table tr.information table td {
                    padding-bottom: 40px;
                }

                .invoice-box table tr.heading td {
                    background: #eee;
                    border-bottom: 1px solid #ddd;
                    font-weight: bold;
                }

                .invoice-box table tr.details td {
                    padding-bottom: 20px;
                }

                .invoice-box table tr.item td {
                    border-bottom: 1px solid #eee;
                }

                .invoice-box table tr.item.last td {
                    border-bottom: none;
                }

                .invoice-box table tr.total td:nth-child(2) {
                    border-top: 2px solid #eee;
                    font-weight: bold;
                }

                @media only screen and (max-width: 600px) {
                    .invoice-box table tr.top table td {
                        width: 100%;
                        display: block;
                        text-align: center;
                    }

                    .invoice-box table tr.information table td {
                        width: 100%;
                        display: block;
                        text-align: center;
                    }
                }
            </style>
        </head>

        <body>
            

            <div class=\"invoice-box\">
                <table>
                    <tr class=\"top\">
                        <td colspan=\"2\">
                            <table>
                                <tr>
                                    <td class=\"title\">
                                    <a href=\"\">
                                        <svg width=\"250px\" height=\"29px\" viewBox=\"0 0 200 29\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\"
                                            xmlns:xlink=\"http://www.w3.org/1999/xlink\">
                                            <g id=\"Page-1\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\" font-size=\"40\"
                                                font-family=\"AustinBold, Austin\" font-weight=\"bold\">
                                                <g id=\"Group\" transform=\"translate(-108.000000, -297.000000)\" fill=\"#000000\">
                                                    <text id=\"AVIATO\">
                                                        <tspan x=\"108.94\" y=\"325\">YEM-YEM</tspan>
                                                    </text>
                                                </g>
                                            </g>
                                        </svg>
                                    </a>
                                    </td>

                                    <td>
                                        " . $date . "
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr class=\"information\">
                        <td colspan=\"2\">
                            <table>
                                <tr>
                                    <td>";
                                $invoice .= htmlspecialchars($_SESSION['name']) . "<br />";
                                $invoice .= htmlspecialchars($_SESSION['address']) . "<br />";
                                $invoice .= htmlspecialchars($_SESSION['email']) . "
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr class=\"heading\">
                        <td>Item</td>

                        <td>Price</td>
                    </tr>";

                    $total = 0;
                    foreach($_SESSION['cart'] as $item) {
                        $invoice .= "<tr class=\"item\">";
                        $invoice .= "<td>" . htmlspecialchars($item['title']) . "(x" . htmlspecialchars($item['quantity'])  . ")</td>";
                        $invoice .= "<td>₦" . number_format($item['price'] * $item['quantity'], 2) . "</td>";
                        $invoice .= "</tr>";
                        $total += $item['price'] * $item['quantity'];
                    }

                    $invoice .= "<tr class=\"total\">
                        <td></td>

                        <td>Total: ₦" . number_format($total, 2) . "</td>
                    </tr>
                </table>
            </div>
        </body>
    </html>";
    return $invoice;
}