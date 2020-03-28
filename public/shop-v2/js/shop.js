/**
 * Uses a function to construct the object of dialog-download.
 * 
 * @author Juthakorn
 */
var hidden = $('.hidden-shop').text().trim();
var shop;
$(document).ready(function(){
    shop = new shopping(hidden,$('#wrapper-option tbody'));
    shop.init();
});

$('body').on('change', '#optionData1', function(event) {    
      shop.optionData1_change($(this));        
});

$('body').on('change', '#optionData2', function(event) {
    if($(this).val() !== ""){
        shop.gen_result_option($('#optionData1').val(),$(this).val());
        $(this).val('');
    }
});

$('body').on('click', '.btn-remove-option', function(event) {
    $(this).closest('tr').remove();
    shop.update_sum();
});
$('body').on('click', '#btn-add-to-cart', function(event) {    
    shop.add_to_cart($(this));
});


$('body').on('click', '.delete-item', function(event) {
    $input_num = $(this).parent().find('input');
    var quantity = parseInt($input_num.val()) - 1;
    quantity > 1 ? $input_num.val(quantity) : $input_num.val(1);
    shop.update_sum();
    shop.check_stock($input_num);
});

$('body').on('click', '.add-item', function(event) {
    $input_num = $(this).parent().find('input');
    var quantity = parseInt($input_num.val()) + 1;
    $input_num.val(quantity);    
    shop.update_sum();
    shop.check_stock($input_num);
});

$('body').on('change', '.input-qty', function(event) {
    var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
    if ($(this).val().length > 0) {
        if (!numberRegex.test($(this).val()) || $(this).val() === '0') {
            $(this).val(1);
            return false;
        }
    }
    shop.update_sum();
    shop.check_stock($(this));
});



var shopping = function (hidden_data, main_option){    
    var obj = jQuery.parseJSON(hidden_data);
    console.log(obj);
    this.product = obj.product;
    this.product_attr = obj.product_attr; 
    this.main_option = main_option;
    this.global_option1 = null;
    this.global_option2 = null;
    this.have_option = true;
}

shopping.prototype = {
    constructor: shopping,
    init : function () {
    
       
        //check has product_attr
        if(this.product_attr.length === 1){
            if((this.product_attr[0].option1 == null || this.product_attr[0].option1 == '') &&
                   (this.product_attr[0].option2 == null || this.product_attr[0].option2 == '') ){
                this.have_option = false;
            }
        }

        if(this.have_option){

            this.global_option1 = removeDuplicates(this.product_attr, "option1");
            this.global_option2 = removeDuplicates(this.product_attr, "option2");
            
            this.main_option.append(this.html_option(this.product.name_option1,this.global_option1,1));

            if(this.global_option2.length > 0){
                this.main_option.append(this.html_option(this.product.name_option2,[],2));            
            }
        }else{
            this.main_option.append(
                       '<tr>'+
                            '<td>'+
                                '<input type="hidden" name="data_atrr[]" value="'+this.product_attr[0].id+'" >'+
                                '<input type="hidden" name="data_atrr_price[]" value="'+this.product_attr[0].p_price+'" >'+                             
                                '<span class="txt-title">จำนวน</span>'+
                            '</td>'+
                            '<td>'+
                                '<span class="qty-option">'+                    
                                    '<div class="form-num">'+
                                        '<div class="btn-num-l delete-item">-</div>'+
                                        '<input type="text" class="input-qty" name="data_atrr_qty[]" value="1" title="จำนวน">'+
                                        '<div class="btn-num-r add-item">+</div>'+
                                    '</div>'+
                                '</span>'+
                            '</td>'+
                        '</tr>'); 
                
                        

        }
        this.update_sum();
    },
    html_option : function (title,optionArray,main_option){
            var option_select = "";

            var name_option = (main_option === 1) ? 'option1' : 'option2';

            for (i = 0; i < optionArray.length; i++) {
                if(main_option === 1){
                    txt_out_stock = (optionArray[i].p_quantity === 0 && this.global_option2.length === 0) ? " (สินค้าหมด)" : "";
                }else if(main_option === 2){
                    txt_out_stock = (optionArray[i].p_quantity === 0) ? " (สินค้าหมด)" : "";
                }
                option_select += '<option value="'+optionArray[i][name_option]+'">'+optionArray[i][name_option]+txt_out_stock+'</option>';
            }  

            //clear
            $('#optionData'+main_option).closest('tr').remove();
                    
            return  '<tr>'+
                        '<td class="align-middle" title="'+title+'">'+title+'</span>'+
                        '<td>'+
                                '<select name="optionData'+main_option+'" id="optionData'+main_option+'">'+
                                    '<option value="">เลือกตัวเลือก</option>'+      
                                     option_select+
                                 '</select>'+
                        '</td>'+
                    '</tr>'; 
    },
    gen_result_option : function(optionData1,optionData2){
    
        var title = optionData1 + ((optionData2 !== '') ? ', ' + optionData2 : '');
        var data_arr = [];    
        $("input[name='data_atrr[]']").each(function() {data_arr.push($(this).val());}).get().join(","); 

        var data_find = null;
        for (i = 0; i < this.product_attr.length; i++) { 
            if(this.product_attr[i].option1 == optionData1 && this.product_attr[i].option2 == optionData2){
                if(this.product_attr[i].p_quantity > 0){                
                    data_find = this.product_attr[i];
                }
            }
        }

        if(data_find !== null){
            if(data_arr.indexOf(String(data_find.id)) === -1){
                 $('#result-option tbody').append(
                    '<tr>'+
                        '<td>'+
                            '<input type="hidden" name="data_atrr[]" value="'+data_find.id+'"  >'+
                            '<input type="hidden" name="data_atrr_price[]" value="'+data_find.p_price+'"  >'+
                            '<span class="txt-title" name="data_atrr_name[]" title="'+title+'">'+title+'</span>'+
                        '</td>'+
                        '<td>'+
                            '<span class="qty-option">'+                    
                                '<div class="form-num">'+
                                    '<div class="btn-num-l delete-item">-</div>'+
                                    '<input type="text" class="input-qty" name="data_atrr_qty[]" value="1" title="จำนวน">'+
                                    '<div class="btn-num-r add-item">+</div>'+
                                '</div>'+
                            '</span>'+
                        '</td>'+
                        '<td>'+
                            '<span class="price-option" ><span>'+data_find.p_price+' บาท</span> '+
                                '<a href="javascript:void(0);" class="btn btn-danger btn-circle btn-remove-option"><i class="material-icons">clear</i></a></a>'+
                            '</span>'+
                        '</td>'+
                    '</tr>');   
            }else{
                alert('คุณได้เลือก '+title+' แล้วค่ะ');
            }
        }else{
            alert('สินค้า '+title+' หมดค่ะ');
        }
        this.update_sum();
    },
    update_sum : function (){
        var sumprice = 0;
        $("input[name='data_atrr_price[]']").each(function() {
            data_qty = $(this).closest('tr').find('.input-qty').val();
            temp_price = Number($(this).val()) * Number(data_qty);
            sumprice = sumprice + temp_price;
            $(this).closest('tr').find('.price-option span').text(temp_price + " บาท");
        });
        $('.sum-price-option').text(sumprice + ' บาท');
        if(sumprice === 0){
            $('#sum-price').hide();
        }else{
            $('#sum-price').show();
        }
        if(!this.have_option){
            $('#sum-price').hide();
        }
    },
    check_stock : function (target){
        
        var data_atrr_id = target.closest('tr').find('input[name="data_atrr[]"]').val();

        var quantity = parseInt(target.val());
        $main = $(target).closest('.qty-option');
        $main.find('.msg-error').remove();
        for (i = 0; i < this.product_attr.length; i++) { 
            if(this.product_attr[i].id == data_atrr_id){ 
                if(this.product_attr[i].p_quantity < quantity){    
                    target.val(this.product_attr[i].p_quantity); 
                    $main.append('<div class="msg-error">*สินค้านี้มีจำนวน '+ this.product_attr[i].p_quantity +' ชิ้นเท่านั้น</div>');
                }
            }
        }
        this.update_sum();
    },
    
    optionData1_change : function (target){
        var val_option1 = target.val();
        if(this.global_option2.length > 0){
            var arr_option2 = [];        

            for (i = 0; i < this.product_attr.length; i++) {
                if(this.product_attr[i].option1 == val_option1){
                    arr_option2.push(this.product_attr[i]);
                }
            }
            this.main_option.append(this.html_option(this.product.name_option2,arr_option2,2));         

        }else{
            if(val_option1 !== ""){
                this.gen_result_option(target.val(),'');
                target.val('');
            }
        }
    },add_to_cart : function(e){
        
        var data_arr = [];    
        $("input[name='data_atrr[]']").each(function() {
            data_arr.push($(this).val());
        });
        var data_atrr_qty = [];    
        $("input[name='data_atrr_qty[]']").each(function() {
            data_atrr_qty.push($(this).val());
        });
        var data_atrr_name = [];    
        $("[name='data_atrr_name[]']").each(function() {
            data_atrr_name.push($(this).text().trim());
        });
        
        var data_json = [];
//        console.log(data_atrr_qty);
        for (i = 0; i < data_arr.length; i++) {
            data_json.push({'attr_id':data_arr[i],'qty':data_atrr_qty[i],'name':data_atrr_name[i]});
        }
//        console.log(data_json);
        if(data_json.length > 0){
            $('.overlay').show();
            $.ajax({
                url: e.attr('data-href'),
                type: "post",
                data : {'data':data_json,'_token':$('input[name="_token"]').val() },
                success: function(ret)
                {
                    $('#dropdown-cart').empty().html(ret);
                    $('#result-option tbody').empty();
                    $('#sum-price').hide();
                    $('.overlay').hide();
                }
            });     
        }else{
            alert('กรุณาเลือกตัวเลือกสินค้าก่อนค่ะ');
        }
    }
}

 function madal_add_to_cart(json){    
    $('#modal-option').empty();
    var txtqty = 0,txtprice = 0;


    for (var i = 0; i < json.length; i++) {
        var price = parseInt(json[i].qty) * parseFloat(json[i].price);
        txtprice += price;        
        txtqty += parseInt(json[i].qty);
        if(json[i].name === undefined){
            $('#modal-option').append('<p>จำนวน ' + json[i].qty +' ชิ้น</p>');
        }else{
            $('#modal-option').append('<p>' + json[i].name + ' จำนวน ' + json[i].qty + ' ชิ้น <span class="price">ราคา ' + price.format(2) + ' บาท</span></p>');
        }
    }
    $('#modal-price').text(txtprice.format(2) +' บาท');
    $('#modal-title').text('เพิ่มสินค้า '+ txtqty +' ชิ้น');    
    $('.madal-add-to-cart').modal();
}



function removeDuplicates(originalArray, prop) {
    var newArray = [];
    var lookupObject  = {};
    for (i = 0; i < originalArray.length; i++) { 
        if(originalArray[i][prop] != ''){
            lookupObject[originalArray[i][prop]] = originalArray[i];
        }
    }
    for(i in lookupObject) {
        newArray.push(lookupObject[i]);
    }
    return newArray;
}