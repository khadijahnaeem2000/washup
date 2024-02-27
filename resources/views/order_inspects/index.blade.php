@extends('layouts.master')
@section('title','Order')
@section('content')
    @include( '../sweet_script')
    {!! Form::open(array('route' => 'order_inspects.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data')) !!}
        {{  Form::hidden('created_by', Auth::user()->id ) }}
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-header py-3">
                        <div class="card-title">
                            <h3 class="card-label">Inspect Order (Content)</h3>
                        </div>
                        <div class="card-toolbar">
                            <div style="margin-right: 10px">
                                <h4 style="text-align:center">  Distribution Hub </h4>
                                {!! Form::select('hub_id',$hubs, null, array('class' => 'form-control','autofocus' => '','required'=>'true','id'=>'hub_id')) !!}
                            </div>
                            <div style="margin-right: 10px">
                                <h4 style="text-align:center">  Action </h4>
                                <button type="submit" id="btn_receive" name = "btn_receive" class="btn btn-success font-weight-bolder">Received to Hub <i class="fas fa-check"></i></button>
                            </div>
                        </div>
                    </div>
                    <?php $checkvar = false; ?>
                    @can('special_polybag-print')
                        <?php $checkvar = true; ?>
                    @endcan
                 
                    @if(!$checkvar)
                        <style>
                            .chk_prm{
                                display:none;
                            }
                        </style>
                    @endif

                    
                        <style>
                            .cls16{
                                display:none;
                            }
                        </style>
                    
                    <div class="card-body"> 
                        <div style="width: 100%; padding-left: -10px; ">
                            <div class="table-responsive">
                                <table id="myTable" class="table" style="width: 100%;" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="2%" >
                                            <!-- <input hidden name="checkAll" class="checkAll"  type="checkbox" /> -->
                                                <!-- <div class="checkbox-inline">
                                                    <label class="checkbox checkbox-success">
                                                        <input name="checkAll" class="checkAll"  type="checkbox" />
                                                        <span></span> 
                                                    </label>
                                                </div> -->
                                                <!-- <button name="checkAll" id="checkAll" class="btn btn-success btn-xs"> -->
                                                    <i class="fas fa-check" id="checkAll" class="btn btn-success btn-xs"></i>
                                                <!-- </button> -->
                                            </th>
                                            <th width="2%" >#</th>
                                            <th>Order#</th>
                                            <th>Name</th>
                                            <th>Contact#</th>
                                            <th>Pickup Date</th>
                                            <th>Delivery Date</th>
                                            <th>Status</th>
                                            <th title="Order Packed">
                                                <i class="fas fa-box"></i>
                                            </th>
                                            <th width="10%" >Inspect</th>
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
    {!! Form::close() !!}


    <script>
        $(document).ready(function () {
           var hub_id          = document.getElementById('hub_id').value;  
           if(hub_id > 0){
               var order_table =  $('#myTable').DataTable({
                   "aaSorting": [],
                   "processing": true,
                   "serverSide": true,
                   "ajax": "{{ url('order_inspect_list') }}" +'/'+hub_id,
                   "method": "GET",
                   "columns": [
                        {"data": "checkbox",orderable:false,searchable:false},
                        {"data": "srno"},
                        {"data": "id"},
                        {"data": "name"},
                        {"data": "contact_no"},
                        {"data": "pickup_date"},
                        {"data": "delivery_date"},
                        {"data": "status_name"},
                        {"data": "polybags_printed"},
                        {"data": "action",orderable:false,searchable:false}
                   ]
               });

               // BEGIN:: Btn Assign 
               $('#btn_receive').click(function (e) {
                    e.preventDefault();
                    $.ajax({
                        data: $('#form').serialize(),
                        url: "{{ route('order_inspects.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            if(data.success){
                                toastr.success(data.success);
                                var hub_id          = document.getElementById('hub_id').value;  
                                order_table.ajax.url( 'order_inspect_list/'+hub_id ).load(); 
                            }else{
                                console.log("fetching");
                                var hub_id          = document.getElementById('hub_id').value;  
                                order_table.ajax.url( 'order_inspect_list/'+hub_id ).load(); 
                                toastr.error(data.error);
                            }
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                });
                // END:: Btn Assign 
             
               $('#hub_id').change(function () {
                   var hub_id          = document.getElementById('hub_id').value;  
                   order_table.ajax.url( 'order_inspect_list/'+hub_id ).load();
               });
           }else{
               $('#hub_id').append('<option value = "0">--- No Hub ---</option>');
           }
        });
    </script>

    <script>
        $("#checkAll").click(function(){
            if ($("input[type=checkbox]").prop("checked")) {
                console.log("un-checked");
                $('input:checkbox').prop('checked', false);
            } else { 
                console.log("checked"); 
                $('input:checkbox').prop('checked',true);
            } 
        });
    </script>
@endsection
