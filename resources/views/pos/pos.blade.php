@extends('layout.app')
@section('page_title')
    Point Of Sales
@endsection

<script type="text/javascript">
    function closePrint() {
        document.body.removeChild(this.__container__);
    }

    function setPrint() {
        this.contentWindow.__container__ = this;
        this.contentWindow.onbeforeunload = closePrint;
        this.contentWindow.onafterprint = closePrint;
        this.contentWindow.focus(); // Required for IE
        this.contentWindow.print();
    }

    function printPage(sURL) {
        var oHiddFrame = document.createElement("iframe");
        oHiddFrame.onload = setPrint;
        oHiddFrame.style.visibility = "hidden";
        oHiddFrame.style.position = "fixed";
        oHiddFrame.style.right = "0";
        oHiddFrame.style.bottom = "0";
        oHiddFrame.src = sURL;
        document.body.appendChild(oHiddFrame);
    }
</script>



@section('page_content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text py-1 px-2 bg-success fw-bold" id="basic-addon3">I want to</span>
                            <select id="action" class="form-control py-1 px-1">
                                <option value="sales">Make Sales</option>
                                @if (auth()->user()->role == 'administrator')
                                    <option value="restock">Restock</option>
                                @endif
                                <option value="return">Return</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    @include('pos.search')
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" id="customer" class="form-control py-1" placeholder="customer phone ">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">

            @if (isset($_GET['action']))
                <div class="alert mt-3 alert-warning">
                    You are editing a closed sale
                </div>
            @endif

            <div class="card mt-3  all_content " style="min-height: 70vh">
                <div class="card-body p-3 ">
                    <form>

                        <div class="table-responsive">
                            <table class="table table-sm " style="border: 0 !important">
                                <thead>
                                    <tr>
                                        <th>Item#</th>
                                        <th colspan="2">Item Name</th>
                                        <th>Avail Qty</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Ext Price</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="cart_list">
                                </tbody>
                            </table>
                        </div>

                        <div class="total_area">

                        </div>


                    </form>
                </div>
            </div>


        </div>
        <div>
            <div class="fixed-bottom" style="left: 250px;">
                <div class=" p-3 d-flex justify-content-end ">
                    <select class="form-control me-3" style="width: 100px" name="payment_mode" id="payment_mode">
                        <option>cash</option>
                        <option>pos</option>
                        <option>transfer</option>
                    </select>
                    <a href="/pos?trno={{ rand(111111, 3444444445409) }}" class="btn btn-secondary me-2"><i
                            class="fa fa-stop"></i> Put On Hold</a>
                    <button class="btn btn-danger clear_cart me-2" data-trno="{{ $_GET['trno'] }}"> <i
                            class="fa fa-ban"></i> Cancel</button>
                    <button class="btn btn-success checkout-only me-2"> <i class="fa fa-save"></i> Save Only</button>
                    <button class="btn btn-primary checkout"> <i class="fa fa-print"></i> Save and Print</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(function() {


            function trno() {
                return Math.floor(Math.random() * 10000000000000000);
            }

            const money_format = (num) => {
                var numb = new Intl.NumberFormat();
                return '₦ ' + numb.format(num);
            }

            trno = `<?= $_GET['trno'] ?>`;

            function getItems() {
                items = (localStorage.getItem(trno) == null) ? [] : JSON.parse(localStorage.getItem(trno));
                return items;
            }

            function setItem(trno, items) {
                localStorage.setItem(trno, JSON.stringify(items));
            }

            function displayCart() {
                items = getItems();
                card = $('.cart_list');
                card.html(``);

                if (items == null || items.length == 0) {
                    $('.all_content').hide();
                    return;
                }
                $('.all_content').show();

                cart_total = 0;

                total_qty = 0;

                items.map((item, index) => {
                    console.log(item);

                    total_qty += parseInt(item.qty);

                    total = parseInt(item.qty) * parseInt(item.price);
                    cart_total += parseInt(total)

                    card.append(`

                        <tr>
                            <td># ${item.uuid}</td>
                            <td colspan="2" ><span class="fw-bold " >${item.name}</span></td>
                            <td><span>${(item.quantity > 0) ? item.quantity : 0 }</span></td>
                            <td><input type="number" class="cart_qty form-control px-2 me-2 py-0 p-0" min="1" value="${item.qty}" data-index=${item.uuid} style="width:60px"></td>
                            <td>
                                <input type="number" class="cart_price form-control px-2 me-2 py-0 p-0" min="1" value="${item.price}" data-index=${item.uuid} style="width:80px">
                            </td>
                            <td>
                                <span>${money_format(total)}</span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" >
                                    <a href="javascript:;" class="remove_item mt-1 text-danger fs-4 fw-bolder " data-uuid=${item.uuid} >
                                        <i class="fe fe-minus-circle"></i>
                                    </a> 
                                </div>      
                            </td>
                        </tr>
                    `)
                })

                $('.total_area').html(`
                    <div class="row sales_sum mt-2 bg-light px-2 py-3 ">
                        <div class="col-md-6 offset-md-6">
                            <div class="row  ">
                                <div class="col text-end">
                                    <p class="mb-0">No. of items Sold</p>
                                    <p class="mb-0">Total Quantity</p>
                                    <p class="mb-0">SubTotal</p>
                                </div>
                                <div class="col text-end">
                                    <p class="mb-0"> ${items.length} </p>
                                    <p class="mb-0">${total_qty}</p>
                                    <p class="mb-0">${money_format(cart_total)}</p>
                                </div>
                            </div>
                            <h2 class="fw-bold fs-3 float-end">Total ${money_format(cart_total)}</h2>
                        </div>
                        <div class="col-md-12" >
                            <hr>
                            <h2 class="fw-bold text-danger float-end">
                                Amount Due 
                                <span class="cart_total" data-cart-total='${cart_total}' >${money_format(cart_total)}</span
                            </h2>
                        </div>
                    </div>
                `)

            }


            displayCart();

            $('body').on('click', '.remove_item', function() {
                uuid = $(this).data('uuid');
                items = getItems();
                const index = items.findIndex(object => {
                    return object.uuid == uuid;
                });
                items.splice(index, 1);
                setItem(trno, items);
                displayCart()
            })


            var timeout = null;

            $('body').on('change', '.cart_qty', function() {
                clearTimeout(timeout);
                val = parseInt($(this).val());
                if (val == "" || isNaN(val)) {
                    console.log('In valid number');
                    return;
                }
                uuid = $(this).data('index')
                items = getItems();
                const index = items.findIndex(object => {
                    return object.uuid == uuid;
                });
                items[index].qty = val
                console.log(uuid, index);
                setItem(trno, items);
                displayCart()
            })

            $('body').on('change', '.cart_price', function() {
                val = $(this).val();
                uuid = $(this).data('index')
                items = getItems();
                const index = items.findIndex(object => {
                    return object.uuid == uuid;
                });
                items[index].price = val
                console.log(uuid, index);
                setItem(trno, items);
                displayCart()
            })

            $('#advance').on('keyup', function() {
                tot = $('.cart_total').data('cart-total')
                adv = $(this).val()
                $('#balance').val(tot - parseInt(adv))
            })





            function checMeJusOut(btn, print) {
                action = $('#action').val();
                user = $('#customer').val();
                advance = $('#advance').val();
                mode = $('#payment_mode').val();

                if (!user) {
                    user = 09000000000
                }


                end_point = ''

                if (action == 'sales') {
                    end_point = '/make_sales'
                } else if (action == 'return') {
                    end_point = '/return_items'
                } else {
                    end_point = '/admin/stock/restock'
                }

                btn_html = btn.html();

                summary_id = `{{ $sales_id }}`;
                console.log(summary_id);

                $.ajax({
                    method: 'post',
                    url: end_point,
                    data: {
                        '_token': `{{ csrf_token() }}`,
                        items: getItems(),
                        customer_phone: user,
                        sales_id: trno,
                        advance: advance,
                        mode: mode,
                        action: action,
                        delete_id: summary_id
                    },
                    beforeSend: () => {
                        btn.html(`
                         <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Checking Out...  
                    `)
                    }
                }).done(function(res) {
                    localStorage.removeItem(trno)

                    Toastify({
                        text: `${res.message}`,
                        className: "info",
                        style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)",
                        }
                    }).showToast();

                    btn.html(`${btn_html}`);
                    $('.all_content').hide();
                    $('#customer').val('');

                    if (action == 'sales' && print == 'print') {
                        var strWindowFeatures =
                            "location=yes,height=70,width=20,scrollbars=yes,status=yes";
                        loc = location.href
                        loc = loc.replace('/pos', `/receipt/${res.sales_id}`);
                        var URL = loc;
                        var win = window.open(URL, "_blank", strWindowFeatures);
                        window.open(URL, '_blank');
                        // printPage(URL)
                    }

                    if (summary_id > 0) {
                        window.location.href = `/pos?trno=${trno}`
                    }



                }).fail(function(res) {
                    console.log(res);
                    btn.html(`${btn_html}`)

                })
            }

            $('.checkout').on('click', function(e) {
                e.preventDefault();
                console.log(trno);
                btn = $(this)
                checMeJusOut(btn, 'print');
            })

            $('.checkout-only').on('click', function(e) {
                e.preventDefault();
                btn = $(this)
                checMeJusOut(btn, 'no-print');
            })


            $('.clear_cart').on('click', function() {
                trno = $(this).data('trno');
                localStorage.removeItem(trno);
                displayCart()
            })


            $(document).on('click', '.search_item', function() {
                console.log(this);
                item = $(this).data('data');
                cart = (localStorage.getItem(trno) == null) ? [] : JSON.parse(localStorage.getItem(
                    trno));
                arr = {
                    uuid: Math.floor(Math.random() * 1000),
                    id: item.id,
                    name: `${item.name} (${item.brand})`,
                    price: item.price,
                    qty: 1,
                    quantity: item.quantity
                }
                cart.push(arr);
                $('.sbox').hide();
                $('#search').val(``);
                $('#search').removeAttr('autofocus');
                $('#search').attr('autofocus', 'autofocus');
                localStorage.setItem(trno, JSON.stringify(cart));
                displayCart();
            });




            function getSaleAndPutToSession(sales_id) {

                if (sales_id == 0) {
                    return;
                }


                console.log(sales_id);

                $.ajax({
                    method: 'get',
                    url: `/get_sales/${sales_id}`
                }).done(function(res) {
                    console.log(res);


                    cart = [];

                    res.sales.forEach(sale => {
                        arr = {
                            uuid: Math.floor(Math.random() * 1000),
                            id: sale.id,
                            name: sale.item.name,
                            price: sale.price,
                            qty: sale.quantity,
                            quantity: sale.item.stock_qty
                        }
                        cart.push(arr);
                    });
                    localStorage.setItem(trno, JSON.stringify(cart));

                    displayCart();

                }).fail(function(res) {
                    console.log(res);
                })
            }

            let sales_id = `{{ $sales_id }}`
            getSaleAndPutToSession(sales_id);






        })
    </script>
@endpush
