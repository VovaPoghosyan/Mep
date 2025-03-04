<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DeviceController extends Controller
{
    /**
     * Get a device by its QR code.
     *
     * @param string $qrCode
     * @return JsonResponse
     */
    public function getByQrCode(string $qrCode): JsonResponse
    {
        $device = Device::byQrCode($qrCode)
            ->with(['product', 'manuals'])
            ->first();

        if (!$device) {
            return response()->json([
                'message' => 'Device not found',
            ], 404);
        }

        // Add warranty status information
        $device->is_under_warranty = $device->isUnderWarranty();
        $device->warranty_expiration_date = $device->warrantyExpirationDate();

        return response()->json($device);
    }
}
