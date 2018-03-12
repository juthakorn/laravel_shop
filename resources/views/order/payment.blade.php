@extends('layouts.standard')

@section('content')

<div class="container m-t-3">
    <div class="row">

<!--        <div class="col-sm-4 col-md-3 m-b-3">
            <div class="title m-b-2" ><span>test </span></div>
            
        </div>--> 
        <div class="col-sm-3">
            @include("partials.category-left")
            @include("forum.bast-sell-left")             
        </div>
        <!-- My Profile Content -->
        <div class="col-sm-9 ">
            <div class="title m-b-2" ><span>{{ trans('cart.Payment') }} </span></div>

            @include("partials.alert-session")               

            <div class="row">
                @if( Auth::guest()) 
                <div class="col-sm-12">
                    <div class="well" >                         
                        <div  class="font14 pull-left"><strong>กรุณาเข้าสู่ระบบก่อนแจ้งชำระเงินค่ะ</strong></div>                       
                        <a href="{{ url(login()) }}" class="btn btn-primary pull-right"><i class="fa fa-sign-in"></i> {{ trans('common.login') }}</a>                            
                         
                        <div class="clearfix"></div>
                    </div>
                </div>
                @else              
                <div class="form-horizontal">  
                    {!! Form::open([
                    'url' => url(UrlPayment()),
                    'method' => 'POST', 'id'=>'form-payment', 'files' => true
                    ]) !!}  
                    <div class="form-payment col-sm-12">
                        <div class="form-group">
                            <label  class="col-sm-3 control-label required_field">{{ trans('common.Transfer account') }}</label>
                            <div class="col-sm-9">
                                <div class="table-responsive">       
                                <table  class="table table-bank table-gray" id="table-bank">
                                    <thead>
                                        <tr class="text-center">
                                            <th></th>
                                            <th colspan="2">{{ trans('cart.Bank') }}</th>
                                            <th>{{ trans('cart.Account No') }}</th>
                                            <th>{{ trans('cart.Account Name') }}</th>
                                            <th>{{ trans('cart.Branch') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                @foreach ($banks as $key => $bank)
                                
                                        
                                    <tr>
                                        <td>
                                            <div class="radio" ><label><input type="radio" id="bank{{ $key }}" value="{{ $bank->id }}" name="bank_id" ><span></span></label></div>
                                            
                                        </td>
                                        
                                        <td class="img-cart">
                                            <label for="bank{{ $key }}" class="label-bank">
                                            <img class="media-object img-thumbnail" src="<?= url("image/" . imgbank($bank->bank_name)) ?>" alt="<?= $bank->bank_name ?>" style="border-radius: 32px;width: 40px;" >   
                                            </label>
                                        </td>
                                        <td><label for="bank{{ $key }}" class="label-bank">{{ str_replace("ธนาคาร", "ธ.", $bank->bank_name) }}</label></td>
                                        <td class="text-center" ><label for="bank{{ $key }}" class="label-bank">{{ $bank->bank_number }}</label></td>
                                        <td class="text-center" ><label for="bank{{ $key }}" class="label-bank">{{ $bank->ac_name }}</label></td>
                                        <td class="text-center" ><label for="bank{{ $key }}" class="label-bank">{{ $bank->branch }}</label></td>      
                                        
                                    </tr>
                                        
                                   
                                @endforeach
                                    </tbody>
                                </table>
                                </div>     
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label required_field">{{ trans('common.Transfer Date') }}</label>
                            <div class="col-sm-7"> 
                                <div class="input-group date">
                                {!! Form::text('transfer_date', null, ['class' => 'form-control', ]) !!} 
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-horizontal form-group">
                            <label class="col-sm-3 control-label required_field">{{ trans('common.Time_estimated') }}</label>
                            <div class="col-sm-7"> 
                                {!! Form::select('transfer_hour', $hour, null, ['class' => 'form-control', 'style' => 'width: 49%;display: inline-block;']) !!}
                                {!! Form::select('transfer_minute', $minute, null, ['class' => 'form-control', 'style' => 'width: 49%;display: inline-block;']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label required_field">{{ trans('common.Amount') }} (฿)</label>
                            <div class="col-sm-7">      
                                {!! Form::text('transfer_pay', null, ['class' => 'form-control']) !!} 
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label ">{{ trans('common.Transfer proof') }}</label>
                            <div class="col-sm-7">      
                                {!! Form::file('transfer_upload', ['class' => 'filestyle', 'data-buttonText'=>'Select a File']) !!} 
                                <small>[ ไฟล์ jpg,gif,png,pdf ไม่เกิน1MB] การแนบหลักฐานจะช่วยทำให้ตรวจสอบได้เร็วขึ้น</small>
                            </div>
                        </div>                    

                        <div class="form-group" id="table-order">                           
                            <label class="col-sm-3 control-label required_field">{{ trans('cart.paid_order_item') }}</label>
                            <div class="col-sm-9"> 
                                <div class="table-responsive" >
                                    <table class="table table-bordered table-gray">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="50">
                                                    <div class="checkbox" ><label><input type="checkbox" id="all_order" ><span></span></label></div>
                                                </th>
                                                <th width="100">{{ trans('cart.Order number') }}</th>
                                                <th>{{ trans('cart.Product') }}</th>
                                                <th width="180">{{ trans('cart.Order date') }}</th>
                                                <th width="100" class="text-right">{{ trans('cart.Price') }} (฿)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($order as $key => $value) {
                                                    $status = status($value->status);
                                                ?>
                                            <tr>
                                                <td style="text-align: center">
                                                    <div class="checkbox" ><label><input type="checkbox" id="order{{ $key }}" name="order_id[]" class="chk_order_id" value="{{ $value->id }}" ><span></span></label></div>

                                                </td>
                                                <td class="center" style="vertical-align: middle"><a href="{{ url(customer_order_detail($value->order_id)) }}"><span class="badge">{{ $value->order_id }}</span></a></td>
                                                <td>
                                                <?php
                                                $temp = $value->order_detail->groupBy('product_id');                                    
                                                foreach ($temp as $keytmp => $valuetmp) {                                       
                                                    $arrimg = App\Model\Product::find($keytmp)->image_stores()->orderBy('product_images.position', "asc")->first()->toArray();
                                                    if(!empty($arrimg)){?>                                                
                                                        <img src="<?= ImgProduct($arrimg['id'], $arrimg['new_name150'])?>" style="height:50px;width: auto;">
                                                    <?php }                                                                                                                       
                                                }
                                                ?>
                                                </td>
                                                <td class="center" style="vertical-align: middle">{{ DateTime($value->created_at, TRUE) }}</td>
                                                <td class="right" style="vertical-align: middle">{{ number_format($value->final_sum,2) }}</td>

                                            </tr>  
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-3 control-label">{{ trans('common.More detail') }}</label>
                            <div class="col-sm-7">     
                                {!! Form::textarea('transfer_note', null, ['class'=>'form-control','rows'=>'4']) !!}
                            </div>
                        </div>   
                    
                    </div>
                    <div class="row" style="margin-bottom: 35px;">
                        <div class="text-center">
                            <button type="submit" class="btn btn-theme">{{ trans('cart.Payment') }}</button>
                            <button type="reset" class="btn btn-default">{{ trans('common.cancel') }}</button>                          
                        </div>
                    </div>
                    {!! Form::close() !!}
                    
                    
                    
                    
                </div>
                @endif 
            </div>
            

        </div>
        <!-- End My Profile Content -->

    </div>
</div>

@include("partials.confirm-modal")   

@endsection

@section('stylesheet')
<link href="{{ URL::asset('plugins/datepicker/datepicker3.css') }}" rel="stylesheet">
@endsection

@section('script')
<script src="{{ URL::asset('shop/js/bootstrap-filestyle.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset('plugins/datepicker/locales/bootstrap-datepicker.th.js') }}" charset="UTF-8"></script>

@endsection

@section('script-custom')
<script>
   
    $(function(){
        input_number_format('#form-payment input[name=transfer_pay]:text');
        $('input[name=transfer_date]').datepicker({
            format: 'dd/mm/yyyy',
            language: '{{ App::getLocale() }}',
            autoclose: true,
         });
    });
function input_number_format(input, empty_str) {
    var empty_str = empty_str || !1;
    $(input).bind('focus', function() {
        var text = $(this).val();
        if (text.match(/\.00/) || text.match(/,[0-9]{3}/)) {
            text = (parseNumber(text))
        }
        $(this).val(text)
    });
    $(input).bind('blur', function() {
        var text = $(this).val();
        if (text == '') {
            if (!empty_str) {
                text = '0.00'
            }
        } else {
            text = number_format(parseNumber(text), 2)
        }
        $(this).val(text)
    });
    var text = $(input).val();
    if (text == '') {
        if (!empty_str) {
            text = '0.00'
        }
    } else {
        text = number_format(parseNumber(text), 2)
    }
    $(input).val(text)
}

function number_format(number, decimals, dec_point, thousands_sep) {
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k
        };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0')
    }
    return s.join(dec)
}
function parseNumber(str) {
    if (typeof str == 'string') {
        return parseFloat(str.replace(/,/g, ''))
    } else {
        return str
    }
}

function scrollto(target){
    $("html, body").animate({
        scrollTop: $(target).offset().top -15
    }, 600); 
}

function isValidDate(dateString){ console.log(dateString);
    // First check for the pattern
    if(!/^\d{1,2}\/\d{1,2}\/\d{4}$/.test(dateString))
        return false;

    // Parse the date parts to integers
    var parts = dateString.split("/");
    var day = parseInt(parts[1], 10);
    var month = parseInt(parts[0], 10);
    var year = parseInt(parts[2], 10);

    // Check the ranges of month and year
    if(year < 1000 || year > 3000 || month == 0 || month > 12)
        return false;

    var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

    // Adjust for leap years
    if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
        monthLength[1] = 29;

    // Check the range of the day
    return day > 0 && day <= monthLength[month - 1];
}

jQuery("#all_order").change(function () {        
    jQuery(".chk_order_id").prop('checked', this.checked);         
});

jQuery(".chk_order_id").change(function(){
    if(jQuery(".chk_order_id:checked").length === jQuery(".chk_order_id").length){
        jQuery("#all_order").prop('checked', true);  
    }else{
        jQuery("#all_order").prop('checked', false); 
    }
});

/*  validate form  */
$('#form-payment').submit(function(){
    
    if(! $('input:radio[name="bank_id"]:checked').length) {
        alert('กรุณาเลือกบัญชีที่โอนเงินค่ะ');        
        scrollto(`#table-bank`);
        return false;
    }
    let temp = [{target:'transfer_date', msg:'กรุณากรอกวันที่ชำระเงิน'},
                {target:'transfer_hour', msg:'กรุณากรอกเวลา ชั่วโมงที่โอนค่ะ'},
                {target:'transfer_minute', msg:'กรุณากรอกเวลา นาทีที่โอน โอนประมาณค่ะ'},
                {target:'transfer_pay', msg:'กรุณากรอกจำนวนเงินค่ะ'}]
    for(let i = 0;i < temp.length; i++){
        $(`[name="${temp[i].target}"]`).blur();
        if($(`[name="${temp[i].target}"]`).val().length == 0 || $(`[name="${temp[i].target}"]`).val() == "0.00"){  
            alert(`${temp[i].msg}`);            
            scrollto(`[name="${temp[i].target}"]`);
            return false;
        }
    }
    
    if(!/^\d{1,2}\/\d{1,2}\/\d{4}$/.test($('[name="transfer_date"]').val())){
        alert('รูปแบบวันที่ไม่ถูกต้อง กรุณากรอกรูปแบบ mm/dd/yyyy ค่ะ');
        scrollto(`[name="transfer_date"]`);
        return false;
    }
         
    if($(`.chk_order_id:checked`).length === 0){
        alert('กรุณาเลือกรายการสั่งซื้อที่จะชำระเงินค่ะ'); 
        scrollto(`#table-order`);
        return false;
    }
    
    var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
    var transfer_upload = $('[name="transfer_upload"]');
    if(transfer_upload.val().length > 0){
        if ($.inArray(transfer_upload.val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("รูปแบบไฟลืไม่ถูกต้อง รองรับไฟล์ "+fileExtension.join(', ') + " เท่านั้น");
    //        alert("Only formats are allowed : "+fileExtension.join(', '));
            transfer_upload.val('');
            $('.bootstrap-filestyle input').val('');
            scrollto(`[name="transfer_upload"]`);
            return false;
        }
        var picsize = (transfer_upload[0].files[0].size);
        if(picsize > 1048576){
            alert('รองรับไฟล์ไม่เกิน 1MB เท่านั้นค่ะ');
            transfer_upload.val('');
            $('.bootstrap-filestyle input').val('');
            scrollto(`[name="transfer_upload"]`);
            return false;
        }        
    }
//    console.log('submit');
//    return false;
});

</script>
@endsection
