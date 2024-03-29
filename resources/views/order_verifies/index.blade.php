@extends('layouts.master')
@section('title','Order')
@section('content')
    @include( '../sweet_script')
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header py-3">
                    <div class="card-title">
                        <h3 class="card-label">Verify Order (Content)</h3>
                    </div>
                    <div class="card-toolbar">
                        <div style="margin-right: 5px">
                            {!! Form::select('hub_id',$hubs, null, array('class' => 'form-control','required'=>'true','id'=>'hub_id')) !!}
                        </div>
                    </div>
                </div>
                <?php $checkvar = false; ?>
                    @can('special_tag-print')
                        <?php $checkvar = true; ?>
                    @endcan
                <?php 
                    if(!$checkvar){?>
                        <style>
                            .chk_prm{
                                display:none;
                            }
                        </style>
                <?php } ?>
                <div class="card-body">
                <h4 id="note" style="color:red; font-weight:bold; text-align:center"></h4>
                     <div style="width: 100%; padding-left: -10px; ">
                        <div class="table-responsive">
                            <table id="myTable" class="table" style="width: 100%;" cellspacing="0">
                              <thead>
                                <tr>
                                    <th width="2%" >#</th>
                                    <th width="5%" >Order#</th>
                                    <th>Name</th>
                                    <th>Contact#</th>
                                    <th>Pickup Date</th>
                                    <th>Status</th>
                                    <th>Wash House</th>
                                    <th width="10%" >Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
    </div>


    <script>
      
        $(document).ready(function () {
            var hub_id          = document.getElementById('hub_id').value;  
            if(hub_id > 0){
                // console.log("hub-id: " + hub_id) ;
                var order_table =  $('#myTable').DataTable({
                    "aaSorting": [],
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ url('order_verify_list') }}" +'/'+hub_id,
                    "method": "GET",
                    "columns": [
                        {"data": "srno"},
                        {"data": "id"},
                        {"data": "name"},
                        {"data": "contact_no"},
                        {"data": "pickup_date"},
                        {"data": "status_name"},
                        {"data": "wash_house_name"},
                        {"data": "action",orderable:false,searchable:false}
                    ]
                });

                $('#hub_id').change(function () {
                    var hub_id          = document.getElementById('hub_id').value;  
                    order_table.ajax.url( 'order_verify_list/'+hub_id ).load();
                });
            }else{
                $('#note').text('!!!! logged in user does not have any distribution hub !!!!');
                $('#hub_id').append('<option disabled>--- No Hub ---</option>');
            }
        });
    </script>
@endsection
