<button class="btn btn-danger text-white mb-0 me-0 float-end" onclick="history.back()"><i class="mdi mdi-keyboard-return">Back To List</i></button>

                        <table id="table"
                                   
                                        data-toggle="table"
                                        data-icon-size="sm"
                                        data-toolbar-align="right"
                                        data-buttons-align="left"
                                        data-search-align="left"
                                        data-maintain-selected="true"
                                        data-sort-name="First Name"
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
                                        <thead style="" class="sticky-header">
                                                <tr class="tableheading">                    
                                <th></th>
                                <th>Tenant</th>
                                <th>House No:</th>
                                <th>Utility</th>
                                <th>Last Reading</th>
                                <th>Current Reading</th>
                                <th>Units Used</th>
                                <th>Amount Due</th>
                                <th>Bill Month</th>
                                <th>Actions</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($readings as $key=>$item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{$item->firstname}} {{$item->lastname}}</td>
                                <td>{{$item->housenumber}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->lastreading}}</td>
                                <td>{{$item->currentreading}}</td>
                                <td>{{$item->currentreading - $item->lastreading}}</td>
                                <td>{{$item->amountdue}}</td>
                                <td>{{\Carbon\Carbon::parse($item->fromdate)->format('Y M d')}}</td>
                                
                                <td>
                                    <a href="" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                               
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
