<?php

// <!-- <div class="text-center" id="flutterwave-payment-form" style="display: {{ env('DEFAULT_PAYMENT','cod')=='flutterwave'?'block':'none'}};">
//     <form>
//         <script src="https://checkout.flutterwave.com/v3.js"></script>
//         <button v-if="totalPrice" type="submit" class="btn btn-success mt-4 paymentbutton" onClick="makePayment()">{{ __('Pay Now')__ }}</button>
//     </form>

// </div> -->

// <form>
//             <script src=\"https://checkout.flutterwave.com/v3.js\"></script>
//             <button v-if=\"totalPrice\" type=\"submit\" class=\"btn btn-success mt-4 paymentbutton\" onClick=\"makePayment()\">Pay Now</button>
//         </form>

//         </div>

$display = env('DEFAULT_PAYMENT','cod') == "flutterwave"?"block":"none";

echo "<div class=\"text-center\" id=\"flutterwave-payment-form\" style=\"display: " . $display . ";\">" . "
        <form>
            <script src=\"https://checkout.flutterwave.com/v3.js\"></script>
            <button v-if=\"totalPrice\" type=\"submit\" class=\"btn btn-success mt-4 paymentbutton\" onClick=\"{{'this.disabled=true;makePayment(event, this.form, {email:\'' . (auth()->user()?auth()->user()->email:env('MAIL_FROM_ADDRESS')) . '\'})'}}\">Pay Now</button>
        </form>
</div>";

?>