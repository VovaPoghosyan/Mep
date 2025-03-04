<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Device;
use App\Models\TicketAttachment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    /**
     * Create a new ticket.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'device_id' => 'required|exists:devices,id',
            'reporter_name' => 'required|string|max:255',
            'reporter_email' => 'required|email|max:255',
            'reporter_phone' => 'required|string|max:20',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'availability_time' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $device = Device::find($request->device_id);
        if (!$device) {
            return response()->json([
                'success' => false,
                'message' => 'Device not found',
            ], 404);
        }

        $ticket = new Ticket();
        $ticket->device_id = $request->device_id;
        $ticket->customer_id = $device->customer_id; // Set customer_id from the device
        $ticket->reporter_name = $request->reporter_name;
        $ticket->reporter_email = $request->reporter_email;
        $ticket->reporter_phone = $request->reporter_phone;
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->availability_time = $request->availability_time;
        $ticket->status = 'open';
        $ticket->save();

        // Handle file upload if present
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $path = $file->store('ticket_attachments', 'public');
            
            $attachment = new TicketAttachment();
            $attachment->ticket_id = $ticket->id;
            $attachment->file_path = $path;
            $attachment->file_name = $file->getClientOriginalName();
            $attachment->file_type = $file->getMimeType();
            $attachment->file_size = $file->getSize();
            $attachment->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Ticket created successfully',
            'ticket_id' => $ticket->id,
        ], 201);
    }
}
