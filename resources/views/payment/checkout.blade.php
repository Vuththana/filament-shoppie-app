@extends('layouts.app')

@section('content')
<div class="g-screen-container max-w-[1200px] mx-auto">
    <div class="g-alert-box min-h-[34px] p-[16px] border rounded-lg bg-[#448aff]" style="z-index: 1;">
        <div class="flex">
            <i class="fa fa-info-circle text-2xl self-start col-auto text-white" aria-hidden="true"></i>
            <div class="col text-white ml-3">
                <div class="min-h-[34px]">
                    <div class="col text-xl">
                        <p>Please complete the payment for your order</p>
                    </div>
                    Order will be cancelled automatically if no payment is made within 1 hour 50 minutes.
                </div>
            </div>
        </div>
    </div>

    <div class="border rounded-lg mt-[10px]">
        <div class="grid grid-cols-3 gap-4 p-[16px] text-sm text-gray-500">
            <div class="text-left">Item</div>
            <div class="text-center">Quantity</div>
            <div class="text-right">Amount</div>
        </div>
        <div class="grid grid-cols-3 gap-4 p-[16px] my-[16px]">
            <div class="text-left text-sm font-semibold">
                {{$getRecord->product_name}}
            </div>
            <div class="text-center">1</div>
            <div class="text-right">
                {{$getRecord->price}} <span class="text-[0.7em]">USD</span>
            </div>  
        </div>
        <div class="border-t mx-auto"></div>
        <div class="grid grid-cols-3 gap-4 p-[16px] my-[16px]">
            <div class="text-left"></div>
            <div class="text-center font-semibold">Order Amount</div>
            <div class="text-right">
                {{$getRecord->price}} <span class="text-[0.7em]">USD</span>
            </div>
        </div>
        <div class="border-t mx-auto max-w-[90%]"></div>
        <div class="grid grid-cols-3 gap-4 p-[16px] my-[16px]">
            <div class="text-left"></div>
            <div class="text-center font-semibold">Total Amount</div>
            <div class="text-right">
                {{$getRecord->price}} <span class="text-[0.7em]">USD</span>
            </div>
        </div>
    </div>
    <div class="flex gap-4 justify-end">
        <div class="pm-method  mt-[10px]">
            <div class="fee"></div>
            <ul class="cc-pm">
                <li class="flex gap-2">
                    <input type="radio" name="pmlist">
                    <div>Credit & Card</div>
                </li>
            </ul>
            <ul class="ew-pm">
                <li class="flex gap-2">
                    <input type="radio" name="pmlist">
                    <div>E-Wallet</div>
                </li>
            </ul>
        </div>
        <div class="btn-checkout-wrapper mt-[10px] justify-end">
            <form action="{{ route('checkout.session', ['id' => $getRecord->id]) }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="total" value="{{ $getRecord->price * 100 }}">
                <input type="hidden" name="product_name" value="{{ $getRecord->product_name }}">
                <input type="hidden" name="product_id" value="{{ $getRecord->id }}">
                <button class="border bg-red-500 text-white rounded-lg p-1 mt-2" type="submit" id="checkout-live-button">
                    <span class="text-xl mx-2">Pay Now</span>
                </button>
            </form>
        </div>
        
        
    </div>
</div>
@endsection
