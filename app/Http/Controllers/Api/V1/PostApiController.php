<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest as ObjRequest;
use App\Http\Resources\PostResource;
use App\Http\Traits\ApiTrait;
use App\Models\Post as ObjModel;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
        use ApiTrait;

    public function __construct(protected ObjModel $objModel){}
    public function getData()
    {
        try{
            $user = auth("user-api")->user();
            $data = $this->objModel->where("user_id", $user->id)->paginate();
            return $this->successResponse(PostResource::collection($data), 200, "تمت العملية بنجاح");
        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage(), 500, "حدث خطأ ما.");
        }
    }
    public function getById($id)
    {
        try{
            $data = $this->objModel->findOrFail($id);
            return $this->successResponse(new PostResource($data), 200, "تمت العملية بنجاح");
        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage(), 500, "حدث خطأ ما.");
        }
    }

    public function store(ObjRequest $request)
    {
        try{
            $data = $request->validated();
            if (isset($data['file'])) {
                $data['file'] = $this->handleFile($data['file'], 'Post');
            }
            $obj = $this->objModel->create($data);
            return $this->successResponse(new PostResource($obj), 201, "تمت العملية بنجاح");
        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage(), 500, "حدث خطأ ما.");
        }
    }

    public function update(ObjRequest $request, $id)
    {
        try{
            $data = $request->validated();
            $obj = $this->objModel->findOrFail($id);
            if (isset($data['file'])) {
                $data['file'] = $this->handleFile($data['file'], 'Post');
                if ($obj->file) {
                    $this->deleteFile($obj->file);
                }
            }
            $obj->update($data);
            return $this->successResponse(new PostResource($obj), 200, "تمت العملية بنجاح");
        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage(), 500, "حدث خطأ ما.");
        }
    }

    public function destroy($id)
    {
        try{
            $obj = $this->objModel->findOrFail($id);
            $obj->delete();
            return $this->successResponse([], 204, "تمت العملية بنجاح");
        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage(), 500, "حدث خطأ ما.");
        }
    }


}
