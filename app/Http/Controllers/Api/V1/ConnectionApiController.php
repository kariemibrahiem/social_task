<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConnectionRequest as ObjRequest;
use App\Models\Connection as ObjModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConnectionApiController extends Controller
{
    public function __construct(protected ObjModel $objModel) {}
    public function getData()
    {
        try {
            $user = auth("user-api")->user();
            $data = $this->objModel->where('receiver_id', $user->id)->get();
            return $this->successResponse($data, 200, "تمت العملية بنجاح");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, "حدث خطأ ما.");
        }
    }
    public function getById($id)
    {
        try {
            $data = $this->objModel->findOrFail($id);
            return $this->successResponse($data, 200, "تمت العملية بنجاح");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, "حدث خطأ ما.");
        }
    }

    public function store(ObjRequest $request)
    {
        try {
            $data = $request->validated();
            $user = auth(guard: "user")->user();
            $data['sender_id'] = $user->id;

            // simple check to prevent duplicates if database doesn't catch it or for custom error
            $exists = $this->objModel->where('sender_id', $data['sender_id'])
                ->where('receiver_id', $data['receiver_id'])
                ->exists();
            if ($exists) {
                return $this->errorResponse("Connection request already exists.", 409);
            }

            $obj = $this->objModel->create($data);
            return $this->successResponse($obj, 201, "تمت العملية بنجاح");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, "حدث خطأ ما.");
        }
    }

    public function update(ObjRequest $request, $id)
    {
        try {
            $data = $request->validated();
            // User requested to change status "with receiver id".
            // We assume $id could be connection id OR sender_id if we are the receiver.
            // Let's first try to find by ID
            $obj = $this->objModel->find($id);

            if (!$obj) {
                // If not found by ID, try finding a connection where sender is $id and receiver is Auth user
                // Or receiver is $id and sender is Auth user
                $obj = $this->objModel->where(function ($q) use ($id) {
                    $q->where('sender_id', $id)->where('receiver_id', Auth::id());
                })->first();
            }

            if (!$obj) {
                return $this->errorResponse("Connection not found.", 404);
            }

            $obj->update($data);
            return $this->successResponse($obj, 200, "تمت العملية بنجاح");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, "حدث خطأ ما.");
        }
    }

    public function destroy($id)
    {
        try {
            $obj = $this->objModel->find($id);
            if (!$obj) {
                $obj = $this->objModel->where(function ($q) use ($id) {
                    $q->where('sender_id', Auth::id())->where('receiver_id', $id);
                })->orWhere(function ($q) use ($id) {
                    $q->where('sender_id', $id)->where('receiver_id', Auth::id());
                })->firstOrFail();
            }

            $obj->delete();
            return $this->successResponse([], 204, "تمت العملية بنجاح");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, "حدث خطأ ما.");
        }
    }

    private function successResponse($data = [], $status = 200, $message = "تمت العملية بنجاح")
    {
        return response()->json(['status' => $status, 'message' => $message, 'data' => $data]);
    }

    private function errorResponse($message = "حدث خطأ ما.", $status = 500, $error = null)
    {
        return response()->json(['status' => $status, 'message' => $message, 'error' => $error]);
    }
}
