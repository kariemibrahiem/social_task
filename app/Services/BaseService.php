<?php

namespace App\Services;

use App\Enums\AdConfirmationEnum;
use App\Traits\PhotoTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

abstract class BaseService
{
    use PhotoTrait;

    public Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function search($query, array $keys, array $values)
    {
        $model = $query->getModel();
        $conditions = [];

        foreach ($keys as $index => $key) {
            $value = $values[$index] ?? null;

            if ($key === 'created_at' && !empty($value)) {
                $conditions[] = function ($q) use ($value) {
                    $q->whereDate('created_at', $value);
                };
            } elseif ($model->isFillable($key) || $model->hasCast($key)) {
                $conditions[] = [$key, 'like', "%$value%"];
            }
        }

        $query->where(function ($q) use ($conditions) {
            foreach ($conditions as $condition) {
                if (is_callable($condition)) {
                    $q->orWhere($condition);
                } else {
                    $q->orWhere(...$condition);
                }
            }
        });

        return $query;
    }

    public function getSelected(...$columns)
    {
        return $this->model->select(...$columns)->get();
    }

    public function getDataTable(): mixed
    {
        return $this->model->latest()->get();
    }

    public function statusDatatable($obj)
    {
        return '
                    <div class="form-check form-switch">
                       <input style="margin-left: 0px;" class="tgl tgl-ios statusBtn form-check-input" data-id="' . $obj->id . '" name="statusBtn" id="statusUser-' . $obj->id . '" type="checkbox" ' . ($obj->status == 1 ? 'checked' : '') . '/>
                       <label class="tgl-btn" dir="ltr" for="statusUser-' . $obj->id . '"></label>
                    </div>';
    }

    public function acceptOrReject($obj, $column = 'ad_confirmation')
    {
        $acceptBtn = "<button class='btn btn-success' data-id='{$obj->id}' name='acceptBtn' id='acceptBtn-{$obj->id}' onclick='changeConfirmation({$obj->id}, \"" . AdConfirmationEnum::CONFIRMED->value . "\")'>
         " . ($obj->{$column} == App\Services\AdConfirmationEnum::CONFIRMED->value ? trns('accepted') : trns('accept')) . "
            </button>";

        $acceptBtnDisabled = "<button disabled class='btn btn-success' data-id='{$obj->id}'>
            " . trns('accepted') . "
               </button>";
        
        $rejectBtn = "<button class='btn btn-danger refuse_reason_btn' data-refuse-id='{$obj->id}' name='rejectBtn'   data-bs-toggle='modal' data-bs-target='#refuse_reason_modal'>
       " . ($obj->{$column} == AdConfirmationEnum::REJECTED->value ? trns('rejected') : trns('reject')) . "
            </button>";

        $rejectBtnDisabled = "<button disabled class='btn btn-danger' data-id='{$obj->id}'>
        " . trns('rejected') . "
            </button>";

        if ($obj->{$column} == AdConfirmationEnum::REQUESTED->value) {
            return "<div class='form-input'>{$acceptBtn} {$rejectBtn}</div>";
        } elseif ($obj->{$column} == AdConfirmationEnum::CONFIRMED->value) {
            return "<div class='form-input'>{$acceptBtnDisabled}</div>";
        } else {
            return "<div class='form-input'>{$rejectBtnDisabled}</div>";
        }
    }

    public function StatusDatatableCustom($obj, $status = 1, $column = 'status')
    {
        return
            '<div class="form-check form-switch">
                <input style="margin-left: 0px;" class="tgl tgl-ios statusBtnOne form-check-input" data-id="' . $obj->id . '" name="statusBtnOne" id="statusBtnOne-' . $obj->id . '" type="checkbox" ' . ($obj->{$column} == $status ? 'checked' : '') . '/>
                <label class="tgl-btn" dir="ltr" for="statusUser-' . $obj->id . '"></label>
                </div>';
    }

    public function getWhere(array $conditions): Collection
    {
        $query = $this->model->query();

        foreach ($conditions as $field => $value) {
            if (is_array($value)) {
                $query->where($field, $value[0], $value[1]);
            } else {
                $query->where($field, $value);
            }
        }

        return $query->get();
    }

    public function firstWhere(array $conditions): ?Model
    {
        $query = $this->model->query();

        foreach ($conditions as $field => $value) {
            if (is_array($value)) {
                $query->where($field, $value[0], $value[1]);
            } else {
                $query->where($field, $value);
            }
        }

        return $query->first();
    }

    public function getById(int $id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    public function getActive($column)
    {
        return $this->model->where($column, 1)->get();
    }

    function handleFile($file, $folder = null, $type = 'image')
    {
        return saveImage($file, $folder, $type);
    }

    public function handleFiles($files, $folder = null)
    {
        $data = [];
        foreach ($files as $file) {
            $data[] = $this->saveImage($file, $folder);
        }

        return $data;
    }

    public function createData(array $data)
    {
        return $this->model->create($data);
    }

    public function uploadImage($image, $folder = null)
    {

        return $image->store('uploads/ ' . $folder, 'public');
    }

    public function updateData(int $id, array $data)
    {
        $model = $this->getById($id);
        return $model->update($data);
    }

    public function delete(int $id): JsonResponse
    {
        $model = $this->getById($id);

        if ($model) {
            
            if (isset($model->image)) {
                $this->deleteFile($model->image);
            }
            if (isset($model->breadcrumb)) {
                $this->deleteFile($model->breadcrumb);
            }
            if (isset($model->not_found_icon)) {
                $this->deleteFile($model->not_found_icon);
            }

            $model->delete();

            return response()->json(['status' => 200, 'message' => trns('deleted successfully')]);
        }
        return response()->json(['status' => 405, 'message' => trns('something went wrong')]);
    }

    public function changeStatus($request)
    {
        $obj = $this->getById($request->id);

        if ($obj) {
            $obj->status = $obj->status == 1 ? 0 : 1;

            $obj->save();
            return response()->json(['status' => 200]);
        }

        return response()->json(['status' => 405]);
    }

    public function updateColumn($id, $column, $value = null)
    {

        $obj = $this->getById($id);
        if ($value) {
            $obj->{$column} = $value;
            $obj->save();
            return true;
        } else {
            $obj->{$column} = !$obj->{$column};
            $obj->save();
            return true;
        }
    }

    protected function deleteAssociatedFiles(Model $model): void
    {
        
        if (!empty($model->image)) {
            $this->deleteFile($model->image);
        }

        $fields = ['images', 'files']; 
        foreach ($fields as $field) {
            if (!empty($model->{$field})) {
                foreach ($model->{$field} as $file) {
                    $this->deleteFile($file);
                }
            }
        }
    }

    protected function deleteFile(string $filePath): void
    {
        if (File::exists(public_path($filePath))) {
            File::delete(public_path($filePath));
        }
    }

    public function getPluckArray(string $keyField, string $valueField): array
    {
        return $this->model->pluck($valueField, $keyField)->toArray();
    }

    function imageDataTable($image): string
    {
        $imagePath = $image ? getFile($image) : getFile('assets/uploads/empty.png');

        return '<img src="' . $imagePath . '" 
                     onclick="window.open(\'' . $imagePath . '\')" 
                     class="avatar avatar-md rounded-circle" 
                     style="cursor:pointer;" 
                     width="100" height="100">';
    }

    public function iamgeFromStorage($image)
    {
        $src = imageFromStorage($image);

        return '<img src="' . $src . '" 
                    onclick="window.open(\'' . $src . '\')" 
                    class="avatar avatar-md rounded-circle" 
                    style="cursor:pointer;" 
                    width="100" 
                    height="100">';
    }

    public function apiValidator($request, $rules, $messages = []): false|JsonResponse
    {
        $validator = Validator::make($request, $rules, $messages = []);

        if ($validator->fails()) {
            return $this->responseMsg($validator->errors()->first(), null, 422);
        }

        return false;
    }

    public function responseMsg($msg, $data = null, int $status = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'msg' => $msg,
            'status' => $status
        ]);
    }

    public function successResponse($data = null): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'msg' => trns('success_fetching_data'),
            'status' => 200
        ]);
    }

    public function errorResponse($data = null): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'msg' => trns('error_fetching_data'),
            'status' => 500
        ]);
    }

    public function validationResponse($data = null): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'msg' => trns('validation_error'),
            'status' => 422
        ]);
    }

    protected function generateCode(): string
    {
        do {
            $code = Str::random(11);
        } while ($this->firstWhere(['code' => $code]));

        return $code;
    }

    public function generateOtp($qty = 6): int
    {
        return random_int(pow(10, $qty - 1), pow(10, $qty) - 1);
    }

    protected function updateEnvVariable($key, $value): void
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            
            $envContent = file_get_contents($path);

            if (strpos($envContent, "{$key}=") !== false) {
                
                $envContent = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $envContent);
            } else {
                
                $envContent .= "\n{$key}={$value}";
            }

            file_put_contents($path, $envContent);
        }
    }

    public function deleteSelected($request)
    {
        try {

            $ids = $request->input('ids');
            if (is_array($ids) && count($ids)) {
                $this->model->whereIn('id', $ids)->delete();
                return response()->json(['status' => 200, 'message' => trns('deleted_successfully')]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => trns('something_went_wrong')]);
        }
    }

    public function updateColumnSelected($request, $column, $values = null)
    {

        try {
        $ids = $request->input('ids');
        if (is_array($ids) && count($ids)) {
            foreach ($ids as $id) {
                $obj = $this->getById($id);
                if (is_array($values)) {
                    $obj->{$column} == $values[0] ? $obj->{$column} = $values[1] : $obj->{$column} = $values[0];
                } else {
                    $obj->{$column} = !$obj->{$column};
                }
                $obj->save();
            }
            return response()->json(['status' => 200, 'message' => trns('updated_successfully')]);
        }
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => trns('something_went_wrong')]);
        }
    }

    public function generateUsername($name)
    {
        return str_replace(' ', '', strtolower($name)) . rand(1000, 9999);
    }

    public function subStrText($text)
    {
        return '
        <span style="
                display: inline-block;max-width: 200px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 3px;transition: max-width 0.3s ease-in-out;position: relative;cursor: pointer;"onmouseover="this.style.maxWidth=\'100%\'; this.style.whiteSpace=\'normal\'; this.style.overflow=\'visible\';                    this.style.background=\'rgba(0, 0, 0, 0.7)\'; this.style.color=\'white\'; this.style.padding=\'8px\';
                this.style.borderRadius=\'5px\'; this.style.position=\'absolute\'; this.style.zIndex=\'1000\';"
                onmouseout="this.style.maxWidth=\'200px\'; this.style.whiteSpace=\'nowrap\'; this.style.overflow=\'hidden\';
                this.style.background=\'transparent\'; this.style.color=\'inherit\'; this.style.padding=\'5px\';
                this.style.borderRadius=\'0px\'; this.style.position=\'relative\'; this.style.zIndex=\'auto\';"
                title="' . e($text) . '">'
            . (!empty($text) ? e($text) : "-") .
            '</span>';
    }

    public function storeMediaLibrary($data, $instance, $inputName = 'file', $collectionName = 'documents', $clearExisting = true)
    {
        if ($clearExisting && $instance->hasMedia($collectionName)) {
            $instance->clearMediaCollection($collectionName);
        }

        $modelType = strtolower(class_basename($instance)); 
        $modelId = $instance->id;
        $basePath = "{$modelType}/{$modelId}/{$collectionName}"; 

        $fullPath = storage_path("app/public/{$basePath}");
        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0777, true);
        }

        if (is_array($data)) {
            foreach ($data as $file) {
                if ($file->isValid()) {
                    $this->saveFileManually($file, $instance, $collectionName, $basePath);
                }
            }
        } elseif ($data && $data->isValid()) {
            $this->saveFileManually($data, $instance, $collectionName, $basePath);
        }
    }

    private function saveFileManually($file, $instance, $collectionName, $basePath)
    {
        $extension = $file->getClientOriginalExtension();
        $uuidFileName = Str::uuid()->toString() . '.' . $extension;
        $file->storeAs("public/{$basePath}", $uuidFileName); 
        
        $instance
            ->copyMedia(storage_path("app/public/{$basePath}/{$uuidFileName}"))
            ->usingFileName($uuidFileName)
            ->withCustomProperties(['manual_path' => $basePath , "admin_id"=>auth()->user()->id])
            ->toMediaCollection($collectionName, 'public');
    }

    protected function processSingleFile($instance, $file, $collectionName, $basePath)
    {
        $media = $instance->addMedia($file)
            ->usingFileName($this->generateSafeFilename($file->getClientOriginalName()))
            ->toMediaCollection($collectionName);

        if (str_starts_with($media->mime_type, 'image/')) {
            $this->optimizeImage($media);
        }
    }

    protected function generateSafeFilename($filename)
    {
        return preg_replace('/[^a-zA-Z0-9\-\._]/', '', $filename);
    }

    protected function optimizeImage($media)
    {
        try {
            $path = $media->getPath();

            if (class_exists(\Intervention\Image\ImageManager::class)) {
                $manager = new \Intervention\Image\ImageManager(['driver' => 'gd']);
                $image = $manager->make($path);

                if ($image->width() > 1920 || $image->height() > 1920) {
                    $image->resize(1920, 1920, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }

                $image->save($path, 80);
            }
        } catch (\Exception $e) {
            
            \Log::error("Image optimization failed: " . $e->getMessage());
        }
    }
}
