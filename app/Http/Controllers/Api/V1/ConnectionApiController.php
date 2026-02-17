<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConnectionRequest as ObjRequest;
use App\Http\Resources\ConnectionResource;
use App\Models\Connection as ObjModel;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConnectionApiController extends Controller
{
    use ApiTrait;
    public function __construct(protected ObjModel $objModel) {}
    public function getData()
    {
        try {
            $user = auth("user-api")->user();
            $data = $this->objModel->where('receiver_id', $user->id)->get();
            return $this->successResponse(ConnectionResource::collection($data), 200, "تمت العملية بنجاح");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, "حدث خطأ ما.");
        }
    }
    public function getById($id)
    {
        try {
            $data = $this->objModel->findOrFail($id);
            return $this->successResponse(new ConnectionResource($data), 200, "تمت العملية بنجاح");
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

            $exists = $this->objModel->where('sender_id', $data['sender_id'])
                ->where('receiver_id', $data['receiver_id'])
                ->exists();
            if ($exists) {
                return $this->errorResponse("Connection request already exists.", 409);
            }

            $obj = $this->objModel->create($data);
            return $this->successResponse(new ConnectionResource($obj), 201, "تمت العملية بنجاح");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, "حدث خطأ ما.");
        }
    }

    public function update(ObjRequest $request, $id)
    {
        try {
            $data = $request->validated();
            
            $obj = $this->objModel->find($id);

            if (!$obj) {
                
                $obj = $this->objModel->where(function ($q) use ($id) {
                    $q->where('sender_id', $id)->where('receiver_id', Auth::id());
                })->first();
            }

            if (!$obj) {
                return $this->errorResponse("Connection not found.", 404);
            }

            $obj->update($data);
            return $this->successResponse(new ConnectionResource($obj), 200, "تمت العملية بنجاح");
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

    public function myConnections()
    {
        try {
            $user_id = auth("user-api")->id();
            if(!$user_id){
                return $this->errorResponse("user not found ", 404);
            }
            $connections = $this->objModel->where('sender_id', $user_id)->orWhere('receiver_id', $user_id)->get();
            return $this->successResponse(ConnectionResource::collection($connections), 200, "تمت العملية بنجاح");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, "حدث خطأ ما.");
        }
    }

    public function accept($id)
    {
        try {
            $user_id = auth("user-api")->id();

            $connection = $this->objModel->find($id);

            if (!$connection) {
                $connection = $this->objModel->where('sender_id', $id)
                    ->where('receiver_id', $user_id)
                    ->first();
            }

            if (!$connection) {
                return $this->errorResponse("Connection request not found.", 404);
            }

            if ($connection->receiver_id !== $user_id) {
                return $this->errorResponse("Unauthorized. Only the receiver can accept this request.", 403);
            }

            $connection->update(['status' => 'accepted']);
            return $this->successResponse(new ConnectionResource($connection), 200, "Connection accepted.");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function reject($id)
    {
        try {
            $user_id = auth("user-api")->id();

            $connection = $this->objModel->find($id);

            if (!$connection) {
                $connection = $this->objModel->where('sender_id', $id)
                    ->where('receiver_id', $user_id)
                    ->first();
            }

            if (!$connection) {
                return $this->errorResponse("Connection request not found.", 404);
            }

            if ($connection->receiver_id !== $user_id) {
                return $this->errorResponse("Unauthorized. Only the receiver can reject this request.", 403);
            }

            $connection->update(['status' => 'rejected']);
            return $this->successResponse(new ConnectionResource($connection), 200, "Connection rejected.");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }


}
