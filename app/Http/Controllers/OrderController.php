<?php

// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Obtener todas las órdenes con su estado, ordenadas por fecha de creación
        $orders = Order::with('status')->orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        // Obtener todos los estados disponibles para el formulario de creación
        $statuses = Status::all();
        return view('orders.create', compact('statuses'));
    }

    public function store(Request $request)
    {
        // Validar la entrada del formulario
        $request->validate([
            'invoice_number' => 'required|string|unique:orders',
            'customer_name' => 'required|string',
            'customer_number' => 'required|string|unique:orders',
            'fiscal_data' => 'required|string',
            'delivery_address' => 'required|string',
            'notes' => 'nullable|string',
            'status_id' => 'required|exists:statuses,id',
        ]);

        // Crear la nueva orden
        Order::create($request->all());
        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function edit(Order $order)
    {
        // Obtener todos los estados y la orden específica para editar
        $statuses = Status::all();
        return view('orders.edit', compact('order', 'statuses'));
    }

    public function update(Request $request, Order $order)
    {
        // Validar la entrada del formulario
        $request->validate([
            'status_id' => 'required|exists:statuses,id',
            'notes' => 'nullable|string',
            // Agrega más validaciones según sea necesario
        ]);

        // Actualizar la orden existente
        $order->update($request->all());
        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        // Eliminar la orden lógicamente (puedes usar soft deletes si lo has habilitado)
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    public function addPhoto(Request $request, Order $order)
    {
        // Validar la entrada para la foto
        $request->validate([
            'photo' => 'required|image|max:2048', // Ajusta las restricciones según sea necesario
        ]);

        // Guardar la foto (asegúrate de que hayas configurado el almacenamiento)
        $path = $request->file('photo')->store('photos', 'public');

        // Asociar la foto a la orden (puedes crear un modelo Photo si es necesario)
        $order->photos()->create(['path' => $path, 'is_delivered' => $request->input('is_delivered', false)]);

        return redirect()->route('orders.index')->with('success', 'Photo added successfully.');
    }
}
