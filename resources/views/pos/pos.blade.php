@extends('layout.app')
@section('page_title')
    Point Of Sales
@endsection

@section('page_content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-md-9">
                    @include('pos.search')
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" id="customer" class="form-control py-1"
                            placeholder="Enter customer name or phone number">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card mt-3  all_content " style="min-height: 70vh">
                <div class="card-body p-3 ">
                    <form>

                        <div class="table-responsive">
                            <table class="table table-sm " style="border: 0 !important" >
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

                        <div class="total_area" >

                        </div>
                  

                    </form>
                </div>
            </div>


        </div>
        <div>
            <div class="fixed-bottom" style="left: 250px;">
                <div class=" p-3 d-flex justify-content-end ">
                    <button class="btn btn-secondary me-2"><i class="fa fa-stop"></i> Put On Hold</button>
                    <button class="btn btn-danger me-2"> <i class="fa fa-ban"></i> Cancel</button>
                    <button class="btn btn-success me-2"> <i class="fa fa-save"></i> Save Only</button>
                    <button class="btn btn-primary"> <i class="fa fa-print"></i> Save and Print</button>
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
                            <td><span>0</span></td>
                            <td><input type="number" class="cart_qty form-control px-2 me-2 py-1 p-0" min="1" value="${item.qty}" data-index=${item.uuid} style="width:60px"></td>
                            <td><span>${item.price}</span></td>
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

            $('.checkout').on('click', function(e) {
                e.preventDefault();
                console.log(trno);
                user = $('#customer').val();
                advance = $('#advance').val();

                if (!user) {
                    user = 09000000000
                }

                btn = $(this);

                $.ajax({
                    method: 'post',
                    url: '/make_slaes',
                    data: {
                        '_token': `{{ csrf_token() }}`,
                        items: getItems(),
                        customer_phone: user,
                        sales_id: trno,
                        advance: advance
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

                    btn.html(`Checkout`);
                    $('.all_content').hide();
                    $('#customer').val('');

                    // var strWindowFeatures =
                    //     "location=yes,height=570,width=520,scrollbars=yes,status=yes";
                    // loc = location.href
                    // loc = loc.replace('/pos/index', `/pos/receipt.php?sales=${res.sales_id}`);
                    // var URL = loc;
                    // var win = window.open(URL, "_blank", strWindowFeatures);
                    // window.open(URL, '_blank').focus();
                    // printPage(URL)

                    // setTimeout(() => {
                    //     location.reload();
                    // }, 3000);

                }).fail(function(res) {
                    console.log(res);
                    btn.html(`Checkout`)

                })

            })


            $(document).on('click', '.search_item', function() {
                console.log(this);
                item = $(this).data('data');
                cart = (localStorage.getItem(trno) == null) ? [] : JSON.parse(localStorage.getItem(trno));
                arr = {
                    uuid: Math.floor(Math.random() * 1000),
                    id: item.id,
                    name: item.name,
                    price: item.price,
                    qty: 1
                }
                cart.push(arr);
                $('.sbox').hide();
                $('#search').val(``);
                localStorage.setItem(trno, JSON.stringify(cart));
                displayCart();
            });

        })
    </script>
@endpush