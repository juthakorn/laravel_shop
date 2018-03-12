
class Cart{
    constructor(){
        let temp = {};
        $('[name="data_product"]').each(function(event){   
            var key = $(this).attr('data-attr-id');
            temp[key] = {
                limit : $(this).attr('data-limit'),
                id : $(this).attr('data-id'),
                attr_id : key,
            };
        });
        console.log(temp);
        this.product_data = temp;
        this.url_action_cart = "";
        this.url_set_delivery = "";
        this.url_set_payment = "";
        this.url_check_discounts = "";
        this.url_remove_cart = "";
    }
    set_url_action_cart(url){
        this.url_action_cart = url;
    }
    set_url_set_delivery(url){
        this.url_set_delivery = url;
    }
    set_url_set_payment(url){
        this.url_set_payment = url;
    }
    set_url_check_discounts(url){
        this.url_check_discounts = url;
    }
    set_url_remove_cart(url){
        this.url_remove_cart = url;
    }
    actionItem(target,quantity){
        
        let product_attr_id = target.closest('tr').find('[name="data_product"]').attr('data-attr-id'); 
        
        if(product_attr_id !== undefined){
            let product = this.product_data[product_attr_id];
            let chk = Cart.check_stock(target,quantity,product);
            quantity = quantity > product.limit ? product.limit : quantity;
            if(chk){
                $.ajax({
                    url: this.url_action_cart,
                    type: "post",
//                    dataType: "json",
                    data : {'attr_id':product.attr_id,'quantity':quantity,'_token':$('input[name="_token"]').val() },
                    success: function(res)
                    {
//                        if(res.status === "success"){
                            Cart.update_cart();
                            $('#dropdown-cart').empty().html(res);
//                        }
                    }
                });             

            }
            
        }
    }
    delivery(delivery_id){
        $.ajax({
            url: this.url_set_delivery,
            type: "post",
            dataType: "json",
            data : {'delivery_id':delivery_id,'_token':$('input[name="_token"]').val() },
            success: function(res)
            {
                if(res.status === "success"){
                    $('#delivery-price').text((res.price === 0) ? "-" : res.price.format(2)).attr('data-value',res.price);     
                }
                Cart.update_cart();
            }
        }); 
    }
    payment(payment_id){
        $.ajax({
            url: this.url_set_payment,
            type: "post",
            dataType: "json",
            data : {'payment_id':payment_id,'_token':$('input[name="_token"]').val() },
            success: function(res)
            {
                if(res.status === "success"){
                    //code...
                }
                Cart.update_cart();
            }
        });
    }
    static check_payment(price){
        let payment_price = 0;
        if ($('select[name="payment"]').val().length > 0 && $('select[name="delivery"]').val().length > 0) {    
            if($('select[name="payment"]').val() === '2'){
                let percen = 3; //เก็บปลายทางเคอรี่คิด 3% จากราคาทั้งหมด
                let temp_result =  price * percen/100;
                let scrap = temp_result%10;

                let result = temp_result- scrap;
                if(scrap > 5){ 
                 result = result + 10;
                }

                $('#payment-price').text(result.format(2));     
                $('.payment-row').show();
                payment_price = result;
            }else{
                $('.payment-row').hide();
            }              
            
        }else{
            $('.payment-row').hide();
        }
        return payment_price;
    }
    discounts(code){
        $.ajax({
            url: this.url_check_discounts,
            type: "post",
            dataType: "json",
            data : {'code':code,'_token':$('input[name="_token"]').val() },
            success: function(res)
            {
                $('#discount').attr('data-value',"");
                $('#res_discount').text("");
                $('#wrap-discount').hide();
                if(res.status === "success"){
                    console.log(res);
                    $('#res_discount').text(res.discount + " %");
                    $('#discount').attr('data-value',res.discount);
                    $('#wrap-discount').show();
                }else{
                    alert('รหัสส่วนลดไม่ถูกต้อง หรือ หมดอายุแล้วค่ะ')
                }
                
//                if(res.status === "success"){
//                    $('#delivery-price').text((res.price === 0) ? "-" : res.price.format(2)).attr('data-value',res.price);     
//                    
//                }
                Cart.update_cart();
            }
        });  
        
    }
    remove_cart(target){
        let main_tr = target.closest('tr');
        let product_attr_id = target.closest('tr').find('[name="data_product"]').attr('data-attr-id'); 
        $.ajax({
            url: this.url_remove_cart + "/" + product_attr_id,
            
            success: function(ret)
            {
                 main_tr.fadeOut(500,function(){
                    $(this).remove();
                    Cart.update_cart();
                });
                $('#dropdown-cart').empty().html(ret);
                    
                
            }
        });
    }
    static chkdelivery(){
        if($('[name="delivery"]').val() == ""){
            alert('กรุณาเลือกการจัดส่ง');
            $('[name="delivery"]').css({'border-color':'red'});
            return false;
        }else{
            $('#cartform').submit();
        }
    }
    static check_stock(target,quantity,product){
        console.log(quantity);
         console.log(product);
        let main = target.closest('.main-form-num');
        main.find('.msg-error').remove();
        if(product.limit >= quantity){
            target.val(quantity);
            return true;
        }else if (quantity < 1) {
            return false;
        }else{
            main.append('<div class="msg-error">*สินค้านี้มีจำนวน '+ product.limit+' ชิ้นเท่านั้น</div>');
            target.val(product.limit);
            return true;
        }
    }
    static update_cart(){
        var Total = 0;
        var SubTotal = 0;
        var delivery = parseInt($('#delivery-price').attr("data-value"));
        var discount = parseInt($('#discount').attr("data-value")); 
        
//       
        $('#table-cart tbody tr').each(function(event){ 
            let temp_price = $(this).find(".item_price").attr("data-value");
            let qty = $(this).find('input[name="data_atrr_qty"]').val();
            let Total_item_price = temp_price*qty;
            if(!isNaN(Total_item_price)){
                SubTotal += Total_item_price;
            }            
            $(this).find(".total_item_price").attr("data-value",Total_item_price).text(Total_item_price.format(2));
        });
        $("#subtotal").text(SubTotal.format(2));
        Total = delivery + SubTotal;
        
        //ถ้าเก็บปลายทางบวกเพิ่ม
        var destination_fee = Cart.check_payment(Total);
        console.log(destination_fee);
        Total = Total + destination_fee;
        
        
        if(!isNaN(discount)){
            let num_discount = (Total*discount/100);
            $('#discount').text("-"+num_discount.format(2));
            Total = Total - num_discount;
        }
        $("#sumtotal").text(Total.format(2));
        if(SubTotal === 0){
            location.reload();
        }
    }
    
    
}

