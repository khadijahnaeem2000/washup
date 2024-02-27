@extends('layouts.master')
@section('title','Order Verify')
@section('content')
    @include( '../sweet_script')
    <style type="text/css">
        #loaderDiv{
            width:100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background: rgba(0,0,0,0.2);
            z-index:9999;
            display:none;
        }
    </style>
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div id= "loaderDiv"><i class="fas fa-spinner fa-spin" style="position:absolute; left:50%; top:50%;font-size:80px; color:#3a7ae0"></i> </div>
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">Edit @yield('title')</h3>
                  
                    <div class="card-toolbar">
                        <a  href="{{ route('order_verifies.index') }}" class="btn btn-primary btn-sm ">
                        <i class="fas fa-arrow-left"></i></a>
                    </div>
                </div>
                <!--begin::Form-->
                
               
                {!! Form::model($data, array('id'=>'order_form','enctype'=>'multipart/form-data')) !!}
                    {{  Form::hidden('updated_by', Auth::user()->id ) }}
                    {{  Form::hidden('id', $data->id,array('id' => 'id') ) }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                {!! Html::decode(Form::label('name','Customer Name <span class="text-danger">*</span>')) !!}
                                {{ Form::text('name', null, array('placeholder' => 'Enter customer name','class' => 'form-control','readonly' => 'true' )) }}
                                    @if ($errors->has('name'))  
                                        {!! "<span class='span_danger'>". $errors->first('name')."</span>"!!} 
                                    @endif
                                {{ Form::hidden('customer_id', null, array('id'=>'customer_id','placeholder' => 'Enter customer id','class' => 'form-control','readonly' => 'true' )) }}
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    {!! Html::decode(Form::label('contact_no','Account/Contact No: <span class="text-danger">*</span>')) !!}
                                    {{ Form::number('contact_no', null, array('placeholder' => 'Enter account or contact no','class' => 'form-control' ,'readonly' => 'true')) }}
                                    @if ($errors->has('contact_no'))  
                                        {!! "<span class='span_danger'>". $errors->first('contact_no')."</span>"!!} 
                                    @endif
                                  
                                </div>
                            </div>
                           
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                {!! Html::decode(Form::label('order_id','Order No <span class="text-danger">*</span>')) !!}
                                {{ Form::text('order_id', null, array('placeholder' => 'Enter order no','class' => 'form-control','readonly' => 'true' )) }}
                                    @if ($errors->has('order_id'))  
                                        {!! "<span class='span_danger'>". $errors->first('order_id')."</span>"!!} 
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    {!! Html::decode(Form::label('status_id','Status')) !!}
                                    {!! Form::select('status_id', $statuses,null, array('class' => 'form-control')) !!}
                                    @if ($errors->has('status_id'))  
                                        {!! "<span class='span_danger'>". $errors->first('status_id')."</span>"!!} 
                                    @endif
                                </div>
                            </div>


                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    {{ Form::hidden('pickup_date', null, array('id'=>'pickup_date','readonly'=>'true','class' => 'form-control dpicker')) }}
                                    {!! Html::decode(Form::label('delivery_date','Delivery Date: ')) !!}
                                    {{ Form::text('delivery_date', null, array('readonly'=>'true','autocomplete'=>'off','placeholder' => 'Enter delivery date','class' => 'form-control dpicker')) }}
                                    @if ($errors->has('delivery_date'))  
                                        {!! "<span class='span_danger'>". $errors->first('delivery_date')."</span>"!!} 
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    {!! Html::decode(Form::label('permanent_note','Permanent Note: ')) !!}
                                    {!! Form::textarea('permanent_note', null, array('placeholder' => 'Permanent Note','rows'=>5, 'class' => 'form-control','readonly' => 'true' )) !!}
                                    @if ($errors->has('permanent_note'))  
                                        {!! "<span class='span_danger'>". $errors->first('permanent_note')."</span>"!!} 
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    {!! Html::decode(Form::label('order_note','Order Note: ')) !!}
                                    {!! Form::textarea('order_note', null, array('placeholder' => 'Order Note','rows'=>5, 'class' => 'form-control')) !!}
                                    @if ($errors->has('order_note'))  
                                        {!! "<span class='span_danger'>". $errors->first('order_note')."</span>"!!} 
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    {!! Html::decode(Form::label('rider_note','Rider Note: ')) !!}
                                    {!! Form::textarea('rider_note', null, array('placeholder' => 'Rider Note','rows'=>5, 'class' => 'form-control','readonly' => 'true' )) !!}
                                    @if ($errors->has('rider_note'))  
                                        {!! "<span class='span_danger'>". $errors->first('rider_note')."</span>"!!} 
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card-title">
                            <h5 class="card-label">
                                <div class="form-group row">
                                    <div class="col-lg-2">
                                        Service Name:
                                    </div>
                                    <div class="col-lg-7 col-md-12 sm-12">
                                        {!! Form::select('service', $services,null, array('class' => 'form-control','id'=>'service')) !!}
                                        @if ($errors->has('service'))  
                                            {!! "<span class='span_danger'>". $errors->first('service')."</span>"!!} 
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-md-12 sm-12">
                                        <input class='btn btn-primary btn-block font-weight-bolder' type='button' value='Add new service'  onclick="add_service_div()">
                                    </div>
                                </div>
                            </h5>
                        </div>

                        <div id="service_items">
                            <?php $ids = ""; foreach($selected_services as $service_key => $service_value){?>
                                <table class="table" id="table<?php echo $service_value->service_id?>">
                                    <thead>
                                        <tr>
                                            <th colspan="5"><center><?php echo $service_value->service_name?> </center></th>							
                                        </tr>
                                        <tr>
                                            <th  style="width: 25%;">Item</th>
                                            <th  style="width: 10%;">Qty</th>
                                            <th  style="width: 25%;">Addons</th>
                                            <!-- <th style="width: 20%;">Image</th>	 -->
                                            <th style="width: 45%;">Note</th>		
                                            <th style="width: 5%;"></th>									
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($selected_items as $item_key => $item_value){
                                            if( $service_value->service_id ==  $item_value->service_id){?>
                                            <tr>
                                                <td>
                                                    <input type="hidden" value="<?php echo $service_value->service_id?>" class="form-control service_cls" name="service_id[<?php echo $service_value->service_id?>]"/>
                                                    <select class="form-control item_select" name="item_id[<?php echo $service_value->service_id?>][]" required>
                                                        <option value="" disabled>---Select Item ---</option>
                                                        @foreach($items as $key => $value)
                                                            @if($value->service_id  == $service_value->service_id)
                                                                @if($value->item_id == $item_value->item_id )
                                                                    <option value="{{ $value->item_id }}" selected>{{ $value->item_name }}</option>
                                                                @else
                                                                    <option value="{{ $value->item_id }}">{{ $value->item_name }}</option>
                                                                @endif
                                                            @else
                                                                @continue
                                                            @endif
                                                        @endforeach
                                                            
                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="number" class="form-control calc_num" value="<?php echo $item_value->pickup_qty?>" name="pickup_qty[<?php echo $service_value->service_id?>][]"  onchange="calc_value(<?php echo $service_value->service_id?>)" required min="1" />
                                                    @foreach($adn as $adn_key => $adn_value)
                                                        @if($adn_key ==  $item_value->ord_itm_id)
                                                            <?php $ids = $adn_value; break;?>
                                                        @else
                                                            <?php $ids = ''; ?>
                                                        @endif
                                                    @endforeach
                                                    <input type="hidden" class="form-control adn_arr" value="<?php echo $ids?>" name="addon_ids[<?php echo $service_value->service_id?>][]" />
                                                </td>
                                               
                                                <td class="item_addons">
                                                    @foreach($addons as $addon_key => $addon_value)
                                                        @if(($item_value->service_id == $addon_value->service_id) && ($item_value->item_id == $addon_value->item_id) )
                                                            <?php $check = 0; ?>
                                                            @foreach($selected_addons as $s_addon_key => $s_adddon_value)
                                                                @if(($s_adddon_value->ord_itm_id == $item_value->ord_itm_id ) && ($addon_value->addon_id == $s_adddon_value->addon_id))
                                                                    <?php $check = true; break;?>
                                                                @endif
                                                            @endforeach
                                                            <div class="checkbox-inline">
                                                                <label class="checkbox checkbox-success"> 
                                                                    <input type ="checkbox" value = "{{ $addon_value->addon_id }}" name="item_addons[<?php echo $service_value->service_id?>][<?php echo $item_value->item_id?>][<?php echo $addon_value->addon_id?>]"  <?php echo ($check == true ? 'checked=checked' : '');?> class="adn_check" >
                                                                    <span></span>
                                                                        {{ $addon_value->addon_name }}
                                                                </label>
                                                            </div>
                                                        @endif 
                                                    @endforeach
                                                </td>

                                                <!-- <td>
                                                    <input type="file" class="form-control" value="c:/passwords.txt" name="item_image[<?php echo $service_value->service_id?>][]" id="item_image" />
                                                   
                                                </td> -->
                                                <td>
                                                    <input type="text" class="form-control note" value="<?php echo $item_value->note?>"  placeholder="Note"  name="item_note[<?php echo $service_value->service_id?>][]"/>
                                                </td>
                                                
                                                <td>
                                                    <a href="javascript:void(0);" data-id="<?php echo $service_value->service_id?>" class="btn btn-danger del_row btn-sm btn-clean btn-icon">
                                                        <i class="la la-minus"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } }?>
                                    </tbody>
                                </table>
                                <table id="table_summary<?php echo $service_value->service_id?>" class="table">
                                <tbody>
                                    <tr>
                                        <th width="25">
                                            Total Quantity
                                        </th>
                                        <td width="25%">
                                            <input type="number" class="form-control" value="<?php echo $service_value->service_qty?>" name="qty[<?php echo $service_value->service_id?>]" readonly="true" />
                                        </td>
                                    
                                        <th width="25">
                                            Total Weight
                                        </th>
                                        <td width="25%">
                                            <input type="number" step="any"  class="form-control" value="<?php echo $service_value->service_weight?>" name="weight[<?php echo $service_value->service_id?>]" required min="0.1" />
                                        </td>
                                    </tr>
                               <tbody>
                            </table>

                            <table id="table_tab<?php echo $service_value->service_id?>" class="table">
                                <tbody>
                                    <tr>
                                        <td colspan="4" style="text-align:right"> Add New Row</td>
                                        <td width="5%"> <input class="btn btn-success btn-sm add_row" data-id="<?php echo $service_value->service_id?>" type="button"  value="+"></td>
                                    </tr>
                               <tbody>
                            </table>
                            <?php } ?>
                           
                        </div>

                        
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            
                            <div class="col-lg-12 text-right">
                                <!-- <button type="submit" class="btn btn-primary mr-2">Save</button> -->
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm font-weight-bolder" id="btn_verify_order">
                                    <i class="flaticon2-check-mark"></i>Save
                                </a>
                                <!-- <button type="reset" class="btn btn-secondary">Reset</button> -->
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
                <!--end::Form-->
            </div>
        </div>
    </div>


    <!-- BEGIN::restricting past dates in delivery date -->
    <script type="text/javascript">
         var incre= 0;
        $(document).ready(function(){
            // restricting past dates
            var disableSpecificDates = fetch_holidays() ;
            $('.dpicker').datepicker({
                startDate: new Date(),
                format: 'yyyy-mm-dd',
                daysOfWeekDisabled: [0],
                beforeShowDay: function(date){
                    dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
                    if(disableSpecificDates.indexOf(dmy) != -1){
                        return false;
                    }else{
                        return true;
                    }
                }
            });
        });

        // formating date
        function format_date(date) { 
            var day     = date.getDate(); 
            var month   = date.getMonth() + 1; 
            var year    = date.getFullYear(); 
            var myDate  = day + "-" + month + "-" + year; 
            return myDate;
        }

        // fetching holidays  
        function fetch_holidays(){
            var hDays       = new Array();
            var holidays    = {!! json_encode($holidays->toArray()) !!};
            holidays.forEach(function(rec,index) {
                hDays[index] = format_date(new Date(rec.holiday_date)); 
            }); 
            return hDays;
        }

        function fn_delivery_date(pickup_date,inc){
            this.incre= 0;
            for(var i=1; i<=inc; i++){
                this.incre++;
                calc_delivery_date(pickup_date,this.incre);
                
            }

        }
        
        // calc_delivery_date(new Date());
        function calc_delivery_date(pickup_date,incre){
            var today       = new Date(pickup_date);
            var finalDate   = new Date(today);

            finalDate.setDate(today.getDate() + this.incre);
            var temp        = new Date(finalDate);
            // console.log(temp);

            if( temp.getDay() == 0) {
                this.incre = this.incre +1;
                // console.log("getDay "+incre);
                calc_delivery_date(pickup_date,this.incre);
            }else{
                var check       = 0 ;
                var disableSpecificDates = fetch_holidays() ;
                year            = temp.getFullYear();
                day             = temp.getDate() ;
                month           = temp.getMonth();
                month           = month+1;
                // day             = ('0' + day).slice(-2);
                // month           = ('0' + month).slice(-2);
                var delivery_date = year+'-'+month+'-'+day;
                
                var test_date   = temp.getDate()+'-'+month+'-'+year; 
                disableSpecificDates.forEach(function(rec,index) {
                    if(rec == test_date){
                       check = 1;
                    }
                }); 
                if(check ==1){
                    this.incre = this.incre +1;
                    calc_delivery_date(pickup_date,this.incre);
                }else{
                    $('#delivery_date').val(delivery_date); 
                }
            }
        }
        
    </script>
    <!-- END::restricting past dates in delivery date -->


    <!-- BEGIN :: fetching service and its items -->
    <script type="text/javascript">
        var customer_id = document.getElementById('customer_id').value; 
        function add_service_div(){
            var service_id  = document.getElementById('service').value; 
            // console.log("Serivce id: "  + service_id );
            fetch_items(service_id,customer_id);
        }
        
        
        function fetch_items($service_id,$customer_id){
            // alert($contact_no);
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "{{ url('fetch_items') }}",
                method: 'POST',
                data: {service_id:$service_id,customer_id:$customer_id, _token:token},
                success: function(data) {
                    var tab_id ="table"+$service_id;
                    if(document.getElementById(tab_id) )
                    {
                        toastr.error("Service: "+data.service_name+" already exist")
                        // alert("service already exist");
                    }else
                    {
                        toastr.success("Service: "+data.service_name+" added successfully")
                        
                        html = '<table class="table" id="table'+$service_id+'">'+
                                '<thead>'+
                                    '<tr>'+
                                        '<th colspan="5"><center>' + data.service_name +'</center></th>	'+										
                                    '</tr>'+
                                    '<tr>'+
                                        '<th  style="width: 25%;">Item</th>'+
                                        '<th  style="width: 10%;">Qty</th>'+
                                        '<th  style="width: 25%;">Addons</th>'+
                                        // '<th style="width: 20%;">Image</th>'+	
                                        '<th style="width: 35%;">Note</th>'+		
                                        '<th style="width: 5%;"></th>	'+										
                                    '</tr>'+
                                '</thead>'+
                                '<tbody>'+
                                    '<tr>'+
                                        '<td>'+
                                            '<input type="hidden" value="'+$service_id+'" class="form-control service_cls" placeholder="Note" name="service_id['+$service_id+']"/>'+
                                            '<select class="form-control item_select" name="item_id['+$service_id+'][]" required >'+
                                                data.data +
                                            '</select>'+
                                        '</td>'+

                                        '<td>'+
                                            '<input type="number" class="form-control calc_num"  value="1" name="pickup_qty['+$service_id+'][]" onchange="calc_value('+$service_id+')" required min="1" />'+
                                            '<input type="hidden" class="form-control adn_arr" name="addon_ids['+$service_id+'][]" id ="addon_ids['+$service_id+'][]" />'+
                                        '</td>'+

                                        '<td class="item_addons">'+
                                            '--No addon--'+
                                        '</td>'+

                                        // '<td>'+
                                        //     '<input type="file" class="form-control" placeholder="Image" name="item_image['+$service_id+'][]" id="item_image"/>'+
                                        //     '<label for="item_image" id="image"><i class="fas fa-pencil-alt"></i> select image</lable>'+
                                        // '</td>'+
                                        '<td>'+
                                            '<input type="text" class="form-control note" placeholder="Note" name="item_note['+$service_id+'][]"/>'+
                                        '</td>'+
                                        
                                        '<td>'+
                                            '<a href="javascript:void(0);" data-id="'+$service_id+'" class="btn btn-danger del_row btn-sm btn-clean btn-icon">'+
                                                '<i class="la la-minus"></i>'+
                                            '</a>'+
                                        '</td>'+
                                    '</tr>'+

                                '</tbody>'+
                            '</table>'+
                            '<table id="table_summary'+$service_id+'" class="table">'+
                                '<tbody>'+
                                    '<tr>'+
                                        '<th width="25">'+
                                            'Total Quantity'+
                                        '</th>'+
                                        '<td width="25%">'+
                                            '<input type="number" class="form-control" value="1" name="qty['+$service_id+']"  readonly="true" />'+
                                        '</td>'+
                                    
                                        '<th width="25">'+
                                            'Total Weight'+
                                        '</th>'+
                                        '<td width="25%">'+
                                            '<input type="number" step="any" class="form-control" value="0.1" min="0.1" required name="weight['+$service_id+']"  />'+
                                        '</td>'+
                                    '</tr>'+
                               '<tbody>'+
                            '</table>'+

                            '<table id="table_tab'+$service_id+'" class="table">'+
                                '<tbody>'+
                                    '<tr>'+
                                        '<td colspan="4" style="text-align:right"> Add New Row</td>'+
                                        '<td width="5%"> <input class="btn btn-success btn-sm add_row" data-id="'+$service_id+'" type="button"  value="+"></td>'+
                                    '</tr>'+
                               '<tbody>'+
                            '</table>';

                            $('#service_items').append(html);
                    }
                }
            });
        }

        $(document).on('click','.adn_check', function(){
            var rec     =  $(this).parent('label').parent('div').parent('td').find('.adn_check');
            var data    = '';
            var record  = new Array();
            rec.each(function() {
                if ($(this).prop("checked")) {
                    record.push($(this).val());
                }
            })
            data        = record.toString();
            if(data){
                $(this).parent('label').parent('div').parent('td').parent('tr').find('.adn_arr').val(data);
            }else{
                $(this).parent('label').parent('div').parent('td').parent('tr').find('.adn_arr').val('');
            }
        });
        
        $(document).on('change','.item_select', function(){
            var currSelect  = $(this);
            var $item_id    = $(this).val();
            var service_id  = $(this).parent('td').find('.service_cls').val();
            
            $(this).parent('td').parent('tr').find('.adn_arr').val('');
            // var service_id  = document.getElementById('service').value;
            // console.log("Addon Serivce id: "  + service_id );
            // console.log("Addon Item id: "  +  $item_id);

            var token = $("input[name='_token']").val();
            $.ajax({
                url: "{{ url('fetch_addons') }}",
                method: 'POST',
                data: {item_id:$item_id,service_id:service_id, _token:token},
                success: function(data) {
                    // console.log(data.data);
                    if(data.data){
                        currSelect.parent('td').parent('tr').find('.item_addons').html(data.data);
                    }else{
                        currSelect.parent('td').parent('tr').find('.item_addons').html('--No addon--');
                    }
                    
                }
            });
        });

        $(document).on('click','.add_row', function(){
            var service_id  = $(this).data('id');
            var table_id    = 'table'+service_id;
                var $el     = $('#'+table_id+' tbody tr:first-child').clone(); 
                // $el.find('input').val(0);
                $el.find('.item_addons').html('--No addon--');
                $el.find('.calc_num').val(1);
                $el.find('.item_select').val('');
                $el.find('.adn_arr').val('');
                $el.find('.note').val('');
                $('#'+table_id+' tbody').append($el); 
                calc_value(service_id)
        })


        $(document).on('click','.del_row', function(){
            var service_id      = $(this).data('id');
            var table_id        = 'table'+service_id;
            var table_tab       = 'table_tab'+service_id;
            var table_summary   = 'table_summary'+service_id;
            
            // console.log(table_id);
            var rowCount        = $('#'+table_id+' tbody tr').length;
            // console.log(rowCount);
            if(rowCount==1){
                $("#"+table_id).remove();
                $("#"+table_tab).remove();
                $("#"+table_summary).remove();
            }else{
                var tr = $(this).parent('td').parent('tr');
                tr.remove();
            }
            calc_value(service_id);
        })

        function calc_value(service_id){
            var table_summary   = 'table_summary'+service_id;
            var item_qty        = 0;
            var q               = 0;

            var qty     = $("input[name='pickup_qty\\["+service_id+"][\\]']")
                            .map(function(){
                                return $(this).val();
                            }).get();

            for (x in qty) {
                q = parseInt(qty[x]);
                item_qty += q;
            }
            $("input[name='qty["+service_id+"]']").val(item_qty);
            // $('#qty['+service_id+']').val(item_qty);
            // console.log(item_qty);
        }
    </script>
    <!-- END :: fetching service and its items -->

    <!-- BEGIN :: verify orders  -->
    <script>

       

        $(function () {
            // Ajax request setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $('#btn_verify_order').click(function (e) {
                e.preventDefault();
                $("#loaderDiv").show();
                var order_id = $('#id').val();
                // console.log(order_id);
                
                // console.log( $('#order_form').serialize());
                $.ajax({
                    data: $('#order_form').serialize(),
                    url: "{{ url('verify_order') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $("#loaderDiv").hide();
                        if(data.success){
                            $("#loaderDiv").hide();
                            // fn_redraw_table(dt,tbl,fn);
                            // re_draw_all();
                            toastr.success(data.success);
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "Do you want to print tags!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, print tags!'
                            }).then((result) => {
                                console.log(result);
                                if (result.isConfirmed) {
                                    window.location.href = "/order_verifies/show_tags/"+order_id;
                                }else if (result.isDismissed) {
                                    window.location.href = "{{ route('order_verifies.index') }}";
                                    // Swal.fire('Changes are not saved', '', 'info')
                                }
                            })
                           
                            // window.location.href = "{{ route('order_inspects.index') }}";
                        }else{
                            var txt = '';
                            var count = 0 ;
                            $.each(data.error, function() {
                                txt +=data.error[count++];
                                txt +='<br>';
                            });
                            toastr.error(txt);
                        }
                    },
                    error: function (data) {
                        $("#loaderDiv").hide();
                        toastr.error("Something went wrong!!!");
                        console.log('Error:', data);
                    }
                });
                
                

        });
    </script>
    <!-- END :: verify orders  -->
@endsection

