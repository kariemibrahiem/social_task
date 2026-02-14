<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest as ObjRequest;
use App\Models\Project as ObjModel;
use App\Services\Admin\ProjectService as ObjService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function __construct(protected ObjService $objService  , protected ObjModel $objModel) {}

    public function index(Request $request)
    {
        return $this->objService->index($request);
    }

    public function create()
    {
        return $this->objService->create();
    }

    public function store(ObjRequest $data)
    {
        $data = $data->validated();
        return $this->objService->store($data);
    }

    public function edit($id)
    {
        $model = $this->objModel->findOrFail($id);
        return $this->objService->edit($model);
    }


    public function show($id)
    {
        $model = $this->objModel->findOrFail($id);
        return $this->objService->show($model);
    }

    public function update(ObjRequest $request, $id)
    {
        $data = $request->validated();
        return $this->objService->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->objService->delete($id);
    }
        public function updateColumnSelected(Request $request)
    {
        return $this->objService->updateColumnSelected($request,'status');
    }

    public function destroySelected(Request $request){
        return $this->objService->deleteSelected($request);
    }
}