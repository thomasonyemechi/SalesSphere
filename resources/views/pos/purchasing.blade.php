@extends('layout.app')
@section('page_title')
    Purchasing On Hold
@endsection

@section('page_content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class=" d-flex justify-content-between align-items-center">
                <div class=" mb-lg-0">
                    <h1 class="mb-1 h2 fw-bold">
                        Sales On Hold
                    </h1>
                    <!-- Breadcrumb  -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Pos</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                On Hold
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-12">
            <div class="alert mt-3 alert-warning">
                Sales in this sections are no registered therefore inventory is not affected these trnasaction else
                completed
                <br>
                <b>Transaction will disappear in 24 hours</b>
            </div>
            <div class="card p-3 mt-3">
                <table class="table table-sm " style="border: 0 !important">
                    <thead>
                        <tr>
                            <th>#id</th>
                            <th colspan="2">Items</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="cart_list">


                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection



@push('scripts')
    <script>
        $(function() {

            function getItems() {
                return localStorage;
            }

            const money_format = (num) => {
                var numb = new Intl.NumberFormat();
                return '₦ ' + numb.format(num);
            }


            function allStorage() {

                var values = [],
                    keys = Object.keys(localStorage),
                    i = keys.length;

                while (i--) {
                    values.push({
                        title: keys[i],
                        data: localStorage.getItem(keys[i])
                    });
                }

                return values;
            }


            function displayCart() {
                items = allStorage();


                card = $('.cart_list');
                card.html(``);

                // if (items == null || items.length == 0) {
                //     return;
                // }

                items.map(item => {


                    console.log(item.data);


                    cart_total = 0;
                    total_qty = 0;
                    item_names = '';
                    JSON.parse(item.data).forEach(product => {
                        item_names += `${product.name} ,`
                        total_qty += parseInt(product.qty);

                        total = parseInt(product.qty) * parseInt(product.price);
                        cart_total += parseInt(total)

                    });



                    card.append(`

                        <tr>
                            <td> <a class="fw-bold mt-1" href="/pos?trno=${item.title}"> ${item.title} </a></td>
                            <td colspan="2" ><span class="fw-bold " >${item_names}</span></td>
                            <td><span>${money_format(cart_total)}</span></td>
                            <td>
                                <div class="d-flex justify-content-end" >
                                    <a href="javascript:;" class="remove_item mt-1 text-danger fs-4 fw-bolder " data-trno=${item.title} >
                                        <i class="fe fe-minus-circle"></i>
                                    </a> 
                                </div>      
                            </td>
                        </tr>

                

                    `)

                })


            }


            displayCart();

            $('body').on('click', '.remove_item', function() {
                trno = $(this).data('trno');
                localStorage.removeItem(trno);
                displayCart()
            })



        })
    </script>
@endpush
