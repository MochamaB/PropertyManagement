

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
             <th data-sortable="true"  >Payment Period</th>
             <th data-sortable="true" >Payment Type</th>
             <th data-sortable="true" >No of Payments</th>
             <th>Total Amount Paid</th>
             <th>Actions</th>      
         </tr>

     </thead>
@if (Route::currentRouteName() == 'payments')
     <tbody style="padding-left:0; padding-right:0px">
     @foreach($yearpaymentgrouping as $key => $item)
         <tr>
             <td>{{ $key+1 }}</td>
             <td>{{$item->year}}</td>
             <td>{{$item->paymentitem}}</td>
             <td>{{$item->noofpayments}}</td>
             <td>{{$item->totalamountpaid}}</td>
             
             <td>
             <a href="{{ url('payments/'.$item->year. '/' .$item->paymentitem) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-calendar-multiple"></i>Month View </a>

             </td>
         </tr>
     @endforeach
     </tbody>
@else
<tbody style="padding-left:0; padding-right:0px">
     @foreach($paymentgrouping as $key => $item)
         <tr>
             <td>{{ $key+1 }}</td>
             <td>{{$item->year}} {{$item->month}}</td>
             <td>{{$item->paymentitem}}</td>
             <td>{{$item->noofpayments}}</td>
             <td>{{$item->totalamountpaid}}</td>
             
             <td>
             <a href="{{ url('payments/Listpayments/'.$item->year. '/' .$item->month. '/' .$item->paymentitem) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-calendar-multiple"></i>Month View </a>

             </td>
         </tr>
     @endforeach
     </tbody>
@endif

</table>


                   