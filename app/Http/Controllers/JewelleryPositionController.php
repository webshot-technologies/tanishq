<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JewelleryPositionController extends Controller
{
    private $positionsFile = 'data/label-positions.json';

    public function savePositions(Request $request)
    {
        try {
            $modelImage = $request->input('model_image');
            $positions = $request->input('positions');
            $deviceType = $request->input('device_type', 'desktop'); // new parameter
            
            // Get existing positions
            $existingPositions = [];
            if (file_exists(public_path($this->positionsFile))) {
                $existingPositions = json_decode(file_get_contents(public_path($this->positionsFile)), true) ?: [];
            }
            
            // Initialize structure if doesn't exist
            if (!isset($existingPositions[$modelImage])) {
                $existingPositions[$modelImage] = [];
            }
            
            // Update positions for this model and device type
            $existingPositions[$modelImage][$deviceType] = $positions;
            
            // Save back to file
            file_put_contents(
                public_path($this->positionsFile), 
                json_encode($existingPositions, JSON_PRETTY_PRINT)
            );
            
            return response()->json(['success' => true, 'message' => 'Positions saved successfully']);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to save positions: ' . $e->getMessage()]);
        }
    }
    
    public function loadPositions()
    {
        try {
            if (file_exists(public_path($this->positionsFile))) {
                $positions = json_decode(file_get_contents(public_path($this->positionsFile)), true) ?: [];
                return response()->json(['success' => true, 'positions' => $positions]);
            }
            
            return response()->json(['success' => true, 'positions' => []]);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to load positions: ' . $e->getMessage()]);
        }
    }
}
