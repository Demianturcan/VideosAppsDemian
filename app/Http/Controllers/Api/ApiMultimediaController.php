<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Multimedia;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiMultimediaController extends Controller
{
    public function index(): JsonResponse
    {
        $multimedia = auth()->user()->multimedia()->paginate(10);
        return response()->json(
            $multimedia->map(function ($item) {
                return [
                    'id' => $item->id,
                    'titol' => $item->titol,
                    'descripcio' => $item->descripcio,
                    'ruta_fitxer' => asset('storage/' . $item->ruta_fitxer),
                    'tipus_fitxer' => $item->tipus_fitxer,
                    'user_id' => $item->user_id,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ];
            })
        );
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'titol' => 'required|string|max:255',
            'descripcio' => 'nullable|string',
            'fitxer' => 'required|file|max:20480',
            'tipus_fitxer' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $path = $request->file('fitxer')->store('multimedia', 'public');

        $multimedia = auth()->user()->multimedia()->create([
            'titol' => $request->titol,
            'descripcio' => $request->descripcio,
            'ruta_fitxer' => $path,
            'tipus_fitxer' => $request->tipus_fitxer,
        ]);

        return response()->json([
            'id' => $multimedia->id,
            'titol' => $multimedia->titol,
            'descripcio' => $multimedia->descripcio,
            'ruta_fitxer' => asset('storage/' . $multimedia->ruta_fitxer),
            'tipus_fitxer' => $multimedia->tipus_fitxer,
            'user_id' => $multimedia->user_id,
            'created_at' => $multimedia->created_at,
            'updated_at' => $multimedia->updated_at,
        ], 201);
    }

    public function update(Request $request, Multimedia $multimedia): JsonResponse
    {
        if ($multimedia->user_id !== auth()->id()) {
            return response()->json(['message' => 'No autoritzat.'], 403);
        }

        $rules = [
            'titol' => 'string|max:255',
            'descripcio' => 'nullable|string',
            'tipus_fitxer' => 'string|max:50',
        ];

        if ($request->hasFile('fitxer')) {
            $rules['fitxer'] = 'file|max:20480';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->hasFile('fitxer')) {
            Storage::disk('public')->delete($multimedia->ruta_fitxer);
            $path = $request->file('fitxer')->store('multimedia', 'public');
            $multimedia->ruta_fitxer = $path;
        }

        $multimedia->update($validator->validated());

        return response()->json([
            'id' => $multimedia->id,
            'titol' => $multimedia->titol,
            'descripcio' => $multimedia->descripcio,
            'ruta_fitxer' => asset('storage/' . $multimedia->ruta_fitxer),
            'tipus_fitxer' => $multimedia->tipus_fitxer,
            'user_id' => $multimedia->user_id,
            'created_at' => $multimedia->created_at,
            'updated_at' => $multimedia->updated_at,
        ]);
    }

    public function show(Multimedia $multimedia): JsonResponse
    {
        if ($multimedia->user_id !== auth()->id()) {
            return response()->json(['message' => 'No autoritzat.'], 403);
        }
        return response()->json([
            'id' => $multimedia->id,
            'titol' => $multimedia->titol,
            'descripcio' => $multimedia->descripcio,
            'ruta_fitxer' => asset('storage/' . $multimedia->ruta_fitxer),
            'tipus_fitxer' => $multimedia->tipus_fitxer,
            'user_id' => $multimedia->user_id,
            'created_at' => $multimedia->created_at,
            'updated_at' => $multimedia->updated_at,
        ]);
    }


    public function destroy(Multimedia $multimedia): JsonResponse
    {
        if ($multimedia->user_id !== auth()->id()) {
            return response()->json(['message' => 'No autoritzat.'], 403);
        }

        Storage::disk('public')->delete($multimedia->ruta_fitxer);
        $multimedia->delete();

        return response()->json(null, 204);
    }
}
