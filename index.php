<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"content="Demo application to show you the process of endTo-end payment using Jokul Checkout">

    <title>Jokul Library Example Project</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png"href="https://cdn-doku.oss-ap-southeast-5.aliyuncs.com/doku-ui-framework/doku/img/favicon.png"/>

    <!-- Bootstrap -->
    <!--    <link rel="stylesheet"-->
    <!--          href="https://cdn-doku.oss-ap-southeast-5.aliyuncs.com/doku-ui-framework/doku/stylesheet/css/bootstrap.css">-->
    <!-- Custom Styling -->
    <link rel="stylesheet" href="https://cdn-doku.oss-ap-southeast-5.aliyuncs.com/doku-ui-framework/doku/stylesheet/css/main.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="https://cdn-doku.oss-ap-southeast-5.aliyuncs.com/doku-ui-framework/doku/js/jquery-3.3.1.min.js"></script>
    <!-- Popper and Bootstrap JS -->
    <script src="https://cdn-doku.oss-ap-southeast-5.aliyuncs.com/doku-ui-framework/doku/js/popper.min.js"></script>
    <script src="https://cdn-doku.oss-ap-southeast-5.aliyuncs.com/doku-ui-framework/doku/js/bootstrap.min.js"></script>

    <style>
        .loader{
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            opacity: 0.7;
            height: 100%;
            z-index: 9999;
            background: url('//upload.wikimedia.org/wikipedia/commons/thumb/e/e5/Phi_fenomeni.gif/50px-Phi_fenomeni.gif') 
                        50% 50% no-repeat rgb(249,249,249);
        }
    </style>
</head>

<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <div class="container">
        <div class="row">
            <div class="col">
                <img src="https://cdn-doku.oss-ap-southeast-5.aliyuncs.com/doku-ui-framework/doku/img/doku1.png"
                     width="20" height="20" class="mr-2"  alt="DOKU Logo"><h5 class="d-inline font-weight-normal">Jokul Demo Store</h5>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row d-flex">
        <div class="col-12 col-md-5 order-md-2 mb-4 mb-md-0">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span>Cart</span>
                <span class="badge badge-secondary badge-pill">1</span>
            </h4>

            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div class="d-flex">
                        <div class="mr-1">
                            <img src="https://cdn-doku.oss-ap-southeast-5.aliyuncs.com/doku-ui-framework/doku/img/doku1.png"
                                 alt="DOKU Plate" class="img-fluid" width="75" height="75">
                        </div>

                        <div class="mr-1">
                            <h6 class="my-0">DOKU Plate</h6>
                            <small class="text-muted">Size: 14cm | Color: Red</small>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text dk-span-group">IDR</span>
                                </div>
                                <input type="number" class="form-control dk-text-input" id="amount" placeholder="120000"
                                       value="120000">
                            </div>
                        </div>

                    </div>

                </li>
            </ul>

            <a class="btn btn-lg btn-default btn-block" data-toggle="modal" data-target="#configuration"><i
                    class="fas fa-cogs"></i> Setup Configuration</a>
        </div>

        <div class="col-12 col-md-7 order-md-1">
            <h4>Checkout</h4>
            <form id="formRequestData" class="needs-validation" novalidate>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" class="form-control dk-text-input" name="customerName"
                                           placeholder="Anton Budiman"
                                           value="Anton Budiman" required>
                                    <div class="invalid-feedback">
                                        Valid name is required.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" class="form-control dk-text-input" name="email"
                                           placeholder="you@example.com"
                                           value="anton@budiman.com" required>
                                    <div class="invalid-feedback">
                                        Please enter a valid email address for shipping updates.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control dk-text-input" name="phoneNumber"
                                           placeholder="6281111111111"
                                           value="6281111111111" required>
                                    <div class="invalid-feedback">
                                        Please enter a valid phone number for shipping updates.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control dk-text-input" id="address"
                                           placeholder="Menara Mulia Lantai 8" name="address"
                                           value="Menara Mulia Lantai 8" required>
                                    <div class="invalid-feedback">
                                        Please enter your shipping address.
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5 mb-3">
                                        <label for="country">Country</label>
                                        <select class="form-control" id="country" name="country" required>
                                            <option value="Indonesia" selected>Indonesia</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid country.
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>City</label>
                                        <select class="form-control" id="province" required>
                                            <option value="Jakarta" selected>Jakarta</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please provide a valid state.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>Postal Code</label>
                                        <input type="text" class="form-control dk-text-input"
                                               id="postalCode" name="postalCode"
                                               value="12930"
                                               required>
                                        <div class="invalid-feedback">
                                            Postal code required.
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label>Payment Channel</label>
                                        <select class="form-control" id="channel" name="channel" required>
                                            <option value="bcava" selected>BCA VA</option>
                                            <option value="bankmandiriva">Bank Mandiri VA</option>
                                            <option value="bsiva">Bank Syariah Indonesia VA</option>
                                            <option value="dokuva">DOKU VA</option>
                                            <option value="briva">BRI VA</option>
                                            <option value="creditcard">Credit Card</option>
                                            <option value="shopeepay">ShopeePay</option>
                                            <option value="ovo">OVO</option>
                                            <option value="dw">DOKU Wallet</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid country.
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-primary btn-lg btn-block mb-3">Purchase</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <hr>

    <div class="row mt-3">
        <div class="col">
            <div class="card">
                <div class="card-body text-center">
                    <h3>Ready to Integrate with Jokul?</h3>
                    <p class="text-muted">
                        Register your business and accept payment within few steps
                    </p>
                    <p>
                        <a class="btn btn-primary" href="https://jokul.doku.com">SIGN UP NOW</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="container-fluid p-3 px-md-4 mt-3 bg-white shadow-sm">
    <div class="row text-center">
        <div class="col-12">
            <img class="mb-2"
                 src="https://cdn-doku.oss-ap-southeast-5.aliyuncs.com/doku-ui-framework/doku/img/doku-logo1.svg" alt=""
                 width="24" height="24">
            <small class="d-inline ml-1 mb-3 text-muted">&copy; 2020</small>
        </div>
    </div>
</footer>


<!-- Configuration Modal -->
<div class="modal fade" id="configuration" tabindex="-1" role="dialog" aria-labelledby="configuration"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Configuration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mb-3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="mb-3">Credentials</h4>

                            <form id="formConfig" class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label>Client ID</label>
                                    <input type="text" class="form-control dk-text-input" id="clientId" name="clientId"
                                           placeholder="MCH-0035-1213674564873" value="MCH-0035-1213674564873"
                                           required>
                                    <div class="invalid-feedback">
                                        Client ID is required.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label>Secret Key</label>
                                    <input type="text" class="form-control dk-text-input" id="sharedKey"
                                           name="sharedKey"
                                           placeholder="SK-OLXIhgLepNXegTyy26KB" value="SK-OLXIhgLepNXegTyy26KB"
                                           required>
                                    <div class="invalid-feedback">
                                        Secret Key is required.
                                    </div>
                                </div>

                                <hr class="my-3">

                                <h4 class="mb-3">Payment Settings</h4>

                                <hr class="my-3">

                                <h4 class="mb-3">Virtual Account Settings</h4>

                                <div class="mb-3">
                                    <label for="vaReusable">VA Reusable</label>
                                    <select class="form-control" id="vaReusable">
                                        <option value="false" selected>FALSE</option>
                                        <option value="true">TRUE</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Reusable status is required.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="vaExpiredTime">Expired Time</label>
                                    <input type="number" class="form-control dk-text-input" id="vaExpiredTime"
                                           placeholder="60" value="60">
                                    <div class="invalid-feedback">
                                        Expired Time is not valid.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="vaInfo1">Info 1</label>
                                    <input type="text" class="form-control dk-text-input" id="vaInfo1" value="Info1"
                                           placeholder="Free text 1">
                                    <div class="invalid-feedback">
                                        Info 1 is not valid.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="vaInfo2">Info 2</label>
                                    <input type="text" class="form-control dk-text-input" id="vaInfo2" value="Info2"
                                           placeholder="Free text 2">
                                    <div class="invalid-feedback">
                                        Info 2 is not valid.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="vaInfo3">Info 3</label>
                                    <input type="text" class="form-control dk-text-input" id="vaInfo3" value="Info3"
                                           placeholder="Free text 3">
                                    <div class="invalid-feedback">
                                        Info 3 is not valid.
                                    </div>
                                </div>

                                <button class="btn btn-primary btn-lg btn-block">Save Configuration</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="loading" class="loader"></div>
<div id="dialog" title="Basic dialog">
  <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the &apos;x&apos; icon.</p>
</div>
</body>

<script>
    $(document).ready(function(){
        $("#loading").hide();
    })

    $("#formConfig").submit(function (e) {
        $('#configuration').modal('hide');
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Configuration has been setup',
            confirmButtonText: 'Close',
        })

        e.preventDefault();
        return false;
    });

    function randomString(length, chars) {
        var result = '';
        for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
        return result;
    }


    $("#formRequestData").submit(function (e) {
        $("#loading").show();
        let unindexed_array_config = $('#formConfig').serializeArray();
        let unindexed_array_payment_request = $('#formRequestData').serializeArray();
        let indexed_array = {};

        $.map(unindexed_array_config, function (n) {
            indexed_array[n['name']] = n['value'];
        });

        $.map(unindexed_array_payment_request, function (n, i) {
            indexed_array[n['name']] = n['value'];
        });

        let reusableStatusVal = $("#vaReusable option:selected").val();
        let reusableStatus = false;
        if (reusableStatusVal === 'true') {
            reusableStatus = true;
        }

        indexed_array['amount'] = $("#amount").val();
        indexed_array['expiredTime'] = parseInt($("#vaExpiredTime").val());
        indexed_array['info1'] = $("#vaInfo1").val();
        indexed_array['info2'] = $("#vaInfo2").val();
        indexed_array['info3'] = $("#vaInfo3").val();
        indexed_array['amount'] = $("#amount").val();
        indexed_array['country'] = $("#country option:selected").val();
        indexed_array['reusableStatus'] = reusableStatus;
        indexed_array['province'] = $("#province option:selected").val();
        indexed_array['channel'] = $("#channel option:selected").val();
        indexed_array['postalCode'] = $("#postalCode").val();
        var invoiceNumber = randomString(20, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
        indexed_array['invoiceNumber'] = invoiceNumber;

        $channel = indexed_array['channel'];
        $.ajax({
            type: "POST",
            dataType: "JSON",
            data: JSON.stringify(indexed_array),
            url: "processing.php",
            contentType: "application/json",
            success: function (result) {
                $("#loading").hide();
                if ($channel == 'dokuva' || $channel == 'bankmandiriva' || $channel == 'bcava' || $channel == 'bsiva' || $channel == 'briva') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Order Success',
                        confirmButtonText: 'Close Instruction',
                        html:
                            '<h4>Your VA Number : ' + result.virtual_account_info.virtual_account_number + '</h4> ' +
                            '<h5><a target="_blank" href="'+result.virtual_account_info.how_to_pay_page+'">Click here to see payment instructions</a></h5>',
                        width: 1500,
                    });
                } else if ($channel == 'creditcard' ) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Order Success',
                        confirmButtonText: 'Close Instruction',
                        html:
                            '<h4>Your Invoice Number : ' + result.order.invoice_number + '</h4> ' +
                            '<iframe width="100%" height="700" src="'+result.credit_card_payment_page.url+'" frameborder="0"></iframe>',
                        width: 1500,
                    });
                } else if ($channel == 'shopeepay') {
                    window.open(result.shopeepay_payment.redirect_url_http, '_blank');
                } else if ($channel == 'dw') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Order Success',
                        confirmButtonText: 'Close Instruction',
                        html:
                            '<h4>Your Invoice Number : ' + result.order.invoice_number + '</h4> ' +
                            '<iframe width="100%" height="700" src="'+result.doku_wallet_payment_page.url+'" frameborder="0"></iframe>',
                        width: 1500,
                    });
                } else if ($channel == 'ovo') {
                    if (result.ovo_payment.status == "SUCCESS") {
                        $status = 'success'
                        $statusTitle = 'Success'
                    } else {
                        $status = 'error'
                        $statusTitle = 'Failed'
                    }
                    Swal.fire({
                        icon: $status,
                        title: 'Order '.$statusTitle,
                        confirmButtonText: 'Close Instruction',
                        html:
                            '<h4>Your Invoice Number : ' + result.order.invoice_number + '</h4> ' +
                            '<h6>Your Amount         : ' + result.order.amount + '</h4> ' +
                            '<h6>Your OVO ID         : ' + result.ovo_info.ovo_id + '</h4> ' +
                            '<h6>Your OVO NAME       : ' + result.ovo_info.ovo_account_name + '</h4> ' +
                            '<h6>Your OVO DATE       : ' + result.ovo_payment.date + '</h4> ' +
                            '<h6>Your STATUS PAYMENT : ' + result.ovo_payment.status + '</h4>',
                        width: 1500,
                    });
                }
            },
            error: function(xhr, textStatus, error){
                $("#loading").hide();
                Swal.fire({
                    icon: 'error',
                    title: 'Order Failed',
                    confirmButtonText: 'Close',
                })
            },
            beforeSend: function() {
                if ($channel == 'ovo') {
                    $("#loading").hide();
                    Swal.fire({
                        icon: 'success',
                        title: 'Order Pending',
                        confirmButtonText: 'Close Instruction',
                        html:
                            '<h4>please make payment to the following account</h4> ' +
                            '<h4>Your Invoice Number : ' + invoiceNumber + '</h4> ' +
                            '<h6>Your Amount         : ' + indexed_array['amount'] + '</h4> ',
                        width: 1500,
                    });
                }
            }
        });
        e.preventDefault();
        return false;
    });


</script>

</html>