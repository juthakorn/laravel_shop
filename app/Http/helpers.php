<?php

function pr($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}
function prx($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    exit;
}
function message($type,$text){
    session(['message-custom'=>[
        'type'=> $type,
        'text'=> $text
    ]]);
}

function filesize_format($size)
{
//    $size = filesize($path);
    $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $power = $size > 0 ? floor(log($size, 1024)) : 0;
    return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
}

function folder_delete($path) {
    if(!empty($path) && is_dir($path) ){
        $dir  = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS); //upper dirs are not included,otherwise DISASTER HAPPENS :)
        $files = new RecursiveIteratorIterator($dir, RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($files as $f) {if (is_file($f)) {unlink($f);} else {$empty_dirs[] = $f;} } if (!empty($empty_dirs)) {foreach ($empty_dirs as $eachDir) {rmdir($eachDir);}} rmdir($path);
    }
}

function create_slug($string){
    $string = strtolower($string);
    $string = preg_replace("#[^a-zA-Z0-9ก-๙ ]#u", " ", $string);
    $string = preg_replace('!\s+!', ' ', $string);
    $string = str_replace(" ", "-", trim($string));
  return $string;
}

function DateTimeThai($strDate, $time = FALSE){
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("j",strtotime($strDate));
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear".(!$time ? "" : " ".date("h:i:s",strtotime($strDate)));;
}

function DateTimeEng($strDate, $time = FALSE){
    
       return date("j F Y",strtotime($strDate)).(!$time ? "" : " ".date("h:i:s",strtotime($strDate)));
}

function Dateformate($strDate){
       return date("Y-m-d",strtotime($strDate));
}

function DateTime($date, $time = FALSE){
    return App::getLocale() == 'th' ? DateTimeThai($date, $time) : DateTimeEng($date, $time);
}

function DateTimeForum($date){    
    return App::getLocale() == 'th' ? DateTimeThai($date).date(", h:i:s",strtotime($date)) : date("j F Y, h:i:s",strtotime($date));
}

function dateyyyymmdd($date){
    $part = explode("/", $date);
    $redate = "$part[2]" . "-" . "$part[1]" . "-" . "$part[0]";
    return $redate;
}


function get_content($url) {
    $userAgent = random_user();

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 600);
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    if (preg_match('/https:/i', $url)) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    }
    
    $contentUrl = curl_exec($ch);
    
    if (!$contentUrl) {
        echo "<br />cURL error number:" . curl_errno($ch);
        echo "<br />cURL error:" . curl_error($ch);
        $contentUrl = 'error';
    }

    return $contentUrl;
}

function random_user() {
    $selc = rand(1, 13);
    if ($selc % 3 == 0) {
        $userAgent = 'Opera/9.00 (Windows NT 5.1; U; en)';
    } elseif ($selc % 5 == 0) {
        $userAgent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6';
    } elseif ($selc % 7 == 0) {
        $userAgent = 'Mozilla/5.0 (compatible; Yahoo! Slurp; http://help.yahoo.com/help/us/ysearch/slurp)';
    } elseif ($selc % 11 == 0) {
        $userAgent = 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X; en) AppleWebKit/522.11 (KHTML, like Gecko) Safari/3.0.2';
    } elseif ($selc % 13 == 0) {
        $userAgent = 'Googlebot-Image/1.0 ( http://www.googlebot.com/bot.html)';
    } else {
        $userAgent = 'Googlebot/2.1 (http://www.googlebot.com/bot.html)';
    }
    return $userAgent;
    /*

      Google � Googlebot/2.1 ( http://www.googlebot.com/bot.html)
      Google Image � Googlebot-Image/1.0 ( http://www.googlebot.com/bot.html)
      MSN Live � msnbot-Products/1.0 (+http://search.msn.com/msnbot.htm)
      Yahoo � Mozilla/5.0 (compatible; Yahoo! Slurp; http://help.yahoo.com/help/us/ysearch/slurp)
      ask

      Browser User Agents

      Firefox (WindowsXP) � Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6
      IE 7 � Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30)
      IE 6 � Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)
      Safari � Mozilla/5.0 (Macintosh; U; Intel Mac OS X; en) AppleWebKit/522.11 (KHTML, like Gecko) Safari/3.0.2
      Opera � Opera/9.00 (Windows NT 5.1; U; en)

     */
}
/*
 * Check in Cookie 
 * if have Order Save To DB
 */
function CheckCookieCart(){
    if (Cookie::get('cart') !== null){ 
            $data = Cookie::get('cart');
            $user_id = Auth::user()->id;
            $cart_info = [];
            if (Cookie::get('cart_info') !== null){ 
                $cart_info = Cookie::get('cart_info');
                Cookie::queue(Cookie::forget('cart_info'));
            }
            $arr = [
                'user_id' => $user_id,
                'data' => serialize($data),
                'payment_id' => !empty($cart_info['payment_id']) ? $cart_info['payment_id'] : NULL,
                'delivery_id' => !empty($cart_info['delivery_id']) ? $cart_info['delivery_id'] : NULL,
                'note' => !empty($cart_info['note']) ? $cart_info['note'] : NULL,
                'code_discount' => !empty($cart_info['code_discount']) ? $cart_info['code_discount'] : NULL
            ];
            DB::table('order_temps')->where('user_id', '=', $user_id)->delete();
            App\Model\OrderTemp::create($arr); 
//            Cookie::forget('cart');
            Cookie::queue(Cookie::forget('cart'));
    }
    
//    if (Cookie::get('redirect_stap2') !== null){
//        Cookie::queue(Cookie::forget('redirect_stap2'));
//        return redirect(url(UrlCheckoutAddress()));
//        
//    }
}

function check_active_discounts() {
    $code_discount = DB::table('code_discounts')->where([            
        ['status', '=', 1],
        ])->get();
    foreach ($code_discount as $key => $value) {
        $start = strtotime($value->start);
        $end = strtotime($value->end);
        $today = strtotime(date('Y-m-d'));
        if($start < $today && $end > $today){            
        } else {
            DB::table('code_discounts')
                ->where('id', $value->id)
                ->update(['status' => 0]);
        }

    }

}

function _get_payment(){        
    return  [
        '' => '--- '.trans('cart.Select Payment').' ---',
        '1'=> trans('cart.Transfer money'), 
        '2' => trans('cart.Cash on Delivery')
    ];
}

function _get_payment_value($payment_id, $price){     
    $percen = 3; //เก็บปลายทางเคอรี่คิด 3% จากราคาทั้งหมด
    $destination_fee = 0;   
    if($payment_id === 2){
        $destination_fee = round(($price*$percen/100), -1);
    }
    return $destination_fee;
}

function cal_price($order){
    $sum = 0;
    $sum_product_delivery = 0;
    $subtotal = 0;
    $sumqty = 0;
    $data = unserialize($order->data);
    $delivery = $order->delivery;
    $delivery_price = $delivery->price;
    
    $payment = _get_payment();
    $discount = NULL; //%
    $discount_price = NULL;
    foreach ($data as $key => $value) {
        $product_attr = App\Model\ProductAttribute::find($value['attr_id']);   
        if(empty($product_attr)){
            continue;
        }
        $price = $value['qty'] * $product_attr->p_price;        
        $subtotal += $price;
        $sumqty += $value['qty'];        
    }
    $sum_product_delivery = $subtotal+$delivery_price;
    
    $payment_price = _get_payment_value($order->payment_id, $sum_product_delivery);
    $sum_product_delivery += $payment_price;
    
    $sum = $sum_product_delivery;
    //discount
    if(!empty($order->code_discount)){
        check_active_discounts();
        $code_discount = DB::table('code_discounts')->where([
            ['start', '<=', date("Y-m-d")],
            ['end', '>=', date("Y-m-d")],['status', '=', 1],
            ['code', '=', $order->code_discount]])->first();
        if(!empty($code_discount)){            
            $discount = $code_discount->discount;                        
            $discount_price = $sum * $discount/100;
            $sum = $sum-$discount_price;
        }
    }
    return ['sum' => $sum,
            'sum_product_delivery' => $sum_product_delivery,
            'subtotal' => $subtotal,
            'sumqty' => $sumqty,
            'delivery_price' => $delivery_price,
            'delivery_name' => $delivery->name,
            'payment_name' => ($order->payment_id !== 0 ? $payment[$order->payment_id] : ""),
            'payment_price' => $payment_price,
            'data' => $data,
            'discount' => $discount,
            'discount_price' => $discount_price
            ];
    
}

function imgbank($name){
    $image = "nopicture.png";
    switch ($name) {
        case "ธนาคารกรุงศรีอยุธยา":
            $image = "BAY.gif";
            break;
        case "ธนาคารกรุงเทพ":
            $image = "BBL.gif";
            break;
        case "ธนาคารกสิกรไทย":
            $image = "KBANK.gif";
            break;
        case "ธนาคารกรุงไทย":
            $image = "KTB.gif";
            break;
        case "ธนาคารไทยพาณิชย์":
            $image = "SCB.gif";
            break;
    }
    
    return $image;
}

function status($status){
    $result['class'] = "";
    $result['text'] = "";
    switch ($status){
        case "0":
            $result['text'] = "รอชำระเงิน";
            $result['class'] = "warning";
            break;
        case "1":
            $result['text'] = "หมดเวลาการชำระเงิน";
            $result['class'] = "default";
            break;
        case "2":
            $result['text'] = "ยกเลิกการสั่งซื้อ";
            $result['class'] = "danger";
            break;
        case "3":
            $result['text'] = "รอยืนยันการชำระเงิน";
            $result['style'] = "background-color: #4267b2;";
            break;
        case "4":
            $result['text'] = "รอจัดส่ง";
            $result['class'] = "warning";
            break;
        case "5":
            $result['text'] = "ยกเลิกการสั่งซื้อ โดยเจ้าของร้าน";
            $result['class'] = "danger";
            break;
        case "9":
            $result['text'] = "จัดส่งแล้ว";
            $result['class'] = "success";
            break;
        
    }
    return $result;
}

function listStatus(){
    return ["all" => "------ เลือกทั้งหมด ------",
            "0" => "รอชำระเงิน",
            "1" => "หมดเวลาการชำระเงิน",
            "2" => "ยกเลิกการสั่งซื้อ",
            "3" => "รอยืนยันการชำระเงิน",
            "4" => "รอจัดส่ง",
            "5" => "ยกเลิกการสั่งซื้อ โดยเจ้าของร้าน",];
}


function statuspay($status){
    $result['class'] = "";
    $result['text'] = "";
    switch ($status){
        case "0":
            $result['text'] = "รอการตรวจสอบ";
            $result['class'] = "default";
            break;
        case "1":
            $result['text'] = "ยืนยันการชำระเงิน";
            $result['class'] = "success";
            break;
        case "2":
            $result['text'] = "ไม่อนุมัติการชำระเงิน";
            $result['class'] = "danger";
            break;
        
    }
    return $result;
}

function check_province($province){
                    
        $txttombon = "ตำบล";
        $txtumpher = "อำเภอ";
        if(preg_match("/กรุงเทพ/i", $province)){
            $txttombon = "แขวง";
            $txtumpher = "เขต";
        }
        
        return array('txttombon' => $txttombon, 'txtumpher' => $txtumpher);                
}




/* URL helper */
function ImgProduct($id,$nameImg){
    return url('/uploads/image_store/'.$id."/".$nameImg);
}
function ImgNoProduct(){
    return url('/image/nopicture350px.png');
}
function UrlProduct($id,$name){
    return url('/product/'.$id."/".$name);
}
function UrlCategoryProduct($id,$name){
    return '/category/'.$id."/".$name;
}
function UrlproductAll(){
    return 'products';
}
function Tagproduct($tag){
    return '/product/tag/'.trim($tag);
}
function register(){
    return 'register';
}
function login(){
    return 'login';
}
function customer(){
    return 'customer';
}
function customer_address(){
    return 'customer/address';
}
function customer_order(){
    return 'customer/order';
}
function customer_order_detail($id){
    return 'customer/order/'.$id;
}
function customer_track($track){
    return 'customer/track/'.$track;
}
function change_password(){
    return 'customer/password';
}
function customer_address_edit($id){
    return 'customer/address_edit/'.$id;
}
function UrlArticle(){
    return 'article';
}
function UrlArticleShow($id,$name){
    return 'article/'.$id."/".$name;
}
function Tagarticle($tag){
    return '/article/tag/'.trim($tag);
}
function grouparticle($date){
    return '/article/date/'.trim($date);
}
function UrlContactUs(){
    return 'contactus';
}
function Urlforums(){
    return 'forums';
}
function UrlforumNewthread(){
    return 'forums/new_thread';
}
function UrlforumEditthread($id){
    return 'forums/edit_thread/'.$id;
}
function UrlforumShowthread($id){
    return 'forums/show_thread/'.$id;
}
function UrlproductNew(){
    return 'products/new';
}
function UrlproductBestSell(){
    return 'products/hot';
}
function UrlproductRecommend(){
    return 'products/recommend';
}
function UrlforumReplythread($id){
    return 'forums/new_reply/'.$id;
}
function UrlforumEditReplythread($id){
    return 'forums/edit_reply/'.$id;
}
function UrlAddToCart(){
    return 'product/add_to_cart/';
}
function UrlRemoveCart($id=null){
    return 'product/remove_cart/'.(!empty($id) ? $id : "");
}
function UrlCheckoutCart(){
    return 'checkout/cart';
}
function UrlCheckoutAddress(){
    return 'checkout/address';
}
function UrlCheckoutSaveAddress(){
    return 'checkout/save_address';
}
function UrlCheckoutVerify(){
    return 'checkout/verify';
}
function UrlCheckoutSuccess(){
    return 'checkout/success';
}
function UrlCheckoutRemoveAddress($id){
    return 'checkout/remove_address/'.$id;
}
function UrlPayment(){
    return 'payment';
}
function UrlPaymentinfo($id){
    return 'payment/info/'.$id;
}
function admin_order_detail($id){
    return 'admin/order/detail/'.$id;
}
function UrlAdminPaymentinfo($id){
    return 'admin/payment/info/'.$id;
}
function UrlAdminOrder(){
    return 'admin/order';
}
