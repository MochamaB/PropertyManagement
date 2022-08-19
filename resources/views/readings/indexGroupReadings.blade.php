
                   <table id="table"
                                   
                                   data-toggle="table"
                                   data-icon-size="sm"
                                   data-toolbar-align="right"
                                   data-buttons-align="left"
                                   data-search-align="left"
                                   data-search="true"
                                   data-show-pagination-switch="true"
                                   data-sticky-header="true"
                                   data-pagination="true"
                                   data-page-list="[100, 200, 250, 500, ALL]"
                                   data-page-size="100"
                                   data-show-footer="false"
                                   data-side-pagination="client"
								   data-buttons-class="primary"
                                   class="table table-hover table-striped"
                                   style="font-size:12px">
                                <thead style="" class="sticky-header">
                            <tr>
                                <th></th>
                                <th data-sortable="true">Reading Month</th>
                                <th>Number of Readings</th>
                                <th>Actions</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                              @foreach($readingsgrouping as $key => $item) 
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{$item->year}}-{{$item->month}}</td>
                                <td>{{$item->noofreadings}}</td>
                                <td>
                                   <a href="{{ url('readings/readingsperitem/'.$item->year. '/' . $item->month) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-lead-pencil"></i> View All </a>
                                </td>
                               
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
