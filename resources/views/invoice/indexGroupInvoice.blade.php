

     <table id="table"
     
                                   
                data-toggle="table"
                data-icon-size="sm"
                data-toolbar-align="right"
                data-buttons-align="left"
                data-buttons-class="primary"
                data-search-align="left"
                data-maintain-selected="true"
                data-sort-name="Invoice Month"
                data-sort-order="asc"
                data-search="true"
                data-show-pagination-switch="true"
                data-sticky-header="true"
                data-pagination="true"
                data-page-list="[100, 200, 250, 500, ALL]"
                data-page-size="100"
                data-show-footer="false"
                data-side-pagination="client"
                class="table table-hover table-striped"
                    style="font-size:12px">
                <thead class="sticky-header">
                    <tr class="tableheading">
                        <th></th>
                        <th data-sortable="true"  >Invoice Period</th>
                        <th data-sortable="true" >Invoice Type </th>
                        <th data-sortable="true" >No of Invoices</th>
                        <th>Total Amount Paid</th>
                        <th>Actions</th>      
                    </tr>

                </thead>
        @if (Route::currentRouteName() == 'Invoices.view')
                <tbody style="padding-left:0; padding-right:0px">
                
                @foreach($yearinvoicegrouping as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{$item->year}} </td>
                        <td>{{$item->invoicetype}}</td>
                        <td>{{$item->noofinvoices}} {{$item->amountdue}}</td>
                        @if($item->totalamountpaid == 0)
                        <td><span style="color:red"><b>NO PAYMENT</b></span></td>
                        @else
                        <td>{{$item->totalamountpaid}}</td>
                        @endif
                        <td>
                        <a href="{{ url('invoice/'.$item->year. '/' .$item->invoicetype) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-calendar-multiple"></i>Month View </a>
 
                        </td>
                    </tr>
                @endforeach
                </tbody>
        @else
                <tbody style="padding-left:0; padding-right:0px">
                @foreach($invoicegrouping as $key => $item)
               
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{$item->year}}-{{\Carbon\Carbon::parse($item->month)->format('m')}}-{{$item->month}}</td>
                        <td>{{$item->invoicetype}}</td>
                        <td>{{$item->noofinvoices}}</td>
                        @if($item->totalamountpaid == 0)
                        <td><span style="color:red"><b>NO PAYMENT</b></span></td>
                        @else
                        <td>{{$item->totalamountpaid}}</td>
                        @endif
                        <td>
                        <a href="{{ url('invoices/ListInvoices/'.$item->year. '/' . $item->month. '/' .$item->invoicetype) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-file-multiple"></i> View All </a>
                        </td>
                    </tr>
                
                @endforeach
                </tbody>
        @endif 
           
    </table>
    
