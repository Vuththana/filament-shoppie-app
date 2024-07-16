@extends('layouts.app')

@section('content')
<div class="flex justify-center">
@foreach ($products as $product)
<div class="relative m-10 flex w-[300px] flex-col overflow-hidden rounded-lg border border-gray-100 bg-white shadow-md hover:shadow-lg hover:scale-110 duration-300">
  <a class="relative mx-3 mt-3 flex h-60 overflow-hidden rounded-xl" href="{{ url('product/' .$product->id) }}">
    <img class="object-cover w-full" src="{{ asset('storage/'.$product->image) }}" alt="product image" />
  </a>
  <div class="mt-4 px-5 pb-5">
    <a href="{{ url('product/' .$product->id) }}">
      <h5 class="text-xl tracking-tight text-slate-900">{{ $product->product_name }}</h5>
    </a>
    <a href="{{ url('product/' .$product->id) }}">
      <h5 class="text-sm tracking-tight text-gray-500">{{ Str::limit($product->product_description, 50 ) }}</h5>
    </a>
    <a href="{{ url('product/' .$product->id) }}">
    @if($product->stock_left <= 0)
      <h5 class="text-sm tracking-tight text-red-500">Out Of Stock!!</h5>
    </a>
    @else
      <h5 class="text-sm tracking-tight text-gray-700">Stocks Left: {{$product->stock_left}}</h5>
    @endif
    <div class="mt-2 mb-5 flex items-center justify-between">
      <p>
        <span class="text-3xl font-bold text-slate-900">${{ $product->price }}</span>
      </p>
    </div>
    <a href="{{ url('product/' .$product->id) }}" class="flex items-center justify-center rounded-md bg-slate-900 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
      </svg>
      Add to cart</a
    >
    
  </div>
</div>
@endforeach
</div>
</div>
@endsection