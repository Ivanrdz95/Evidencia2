@extends('layouts.app')

@section('content')
    <h1>Create Order</h1>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <input type="text" name="invoice_number" placeholder="Invoice Number" required>
        <input type="text" name="customer_name" placeholder="Customer Name" required>
        <input type="text" name="customer_number" placeholder="Customer Number" required>
        <textarea name="fiscal_data" placeholder="Fiscal Data" required></textarea>
        <textarea name="delivery_address" placeholder="Delivery Address" required></textarea>
        <textarea name="notes" placeholder="Notes"></textarea>
        <select name="status_id" required>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{ $status->name }}</option>
            @endforeach
        </select>
        <button type="submit">Create</button>
    </form>
@endsection
