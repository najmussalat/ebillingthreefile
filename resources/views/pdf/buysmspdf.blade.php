<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>invoice</title>
    <style>
        table,
        th,
        td {
            padding: 10px;
            border: 1px solid black;
            border-collapse: collapse;
        }

    </style>
</head>

<body style="width:210mm">
    <div class="main-invoice" >
        <h2 style="text-align: center; margin-bottom: 50px;">
            Payment Receipt
        </h2>


        <div style="display: flex;">
            <div style="width: 70%;">
                <p style="margin: 10px 0;">
                    Receipt Number: #00{{$infos->id}}
                </p>
                <p style="margin: 10px 0;">
                    Date:Date: {{ date('M-d-Y', strtotime(@Carbon\Carbon::now())) }}
                </p>
                <p style="margin: 10px 0;">
                    Company Name:  {{Auth::user()->company}}
                </p>
                <p style="margin: 10px 0;">
                    Name:  {{Auth::user()->name}}
                </p>
                <p style="margin: 10px 0;">
                    Email: {{Auth::user()->email}}
                </p>
                <p style="margin: 10px 0;">
                    Address and phone:  {{Auth::user()->address}} . <br> {{Auth::user()->phone}}
                </p>




            </div>

            <div style="width: 70%; text-align: right;">
                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG(Request::url(), 'QRCODE') }}" />
            </div>
        </div>




        <div class="table">
            <table style="width: 80%; border: 1px solid">
                <tbody>
                    <tr>
                        <td>Amount</td>
                        <td>{{$infos->payamount}}</td>
                    </tr>
                    <tr>
                        <td>Pay By</td>
                        <td>{{@$infos->payment->paymentname}}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>@if ($infos->status==0)
                          Peding
                          @else
                          Aproved
                      @endif</td>
                    </tr>
                </tbody>
            </table>
            <!-- DivTable.com -->
            
        <div>
          
          <p>Authorized Signature</p>
         
      </div>
        </div>



    </div>

</body>

</html>
