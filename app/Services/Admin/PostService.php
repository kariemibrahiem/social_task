<?php

namespace App\Services\Admin;

use App\Models\Post as ObjModel;
use App\Services\BaseService;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class PostService extends BaseService
{
    protected string $folder = 'content/post';
    protected string $route = 'posts';

    public function __construct(ObjModel $objModel)
    {
        parent::__construct($objModel);
    }

    public function index($request)
    {
        if ($request->ajax()) {
            $obj = $this->getDataTable();
            return DataTables::of($obj)
                ->addColumn('action', function ($obj) {
                    $user = Auth::guard('admin')->user();
                    $buttons = '';

                    // if ($user && $user->can("posts_edit")) {
                    //             $buttons .= '
                    //                 <a href="' . route($this->route . '.edit', $obj->id) . '" 
                    //                 class="btn btn-sm btn-primary me-1" 
                    //                 title="Edit">
                    //                     <i class="fas fa-pencil-alt"></i>
                    //                 </a>';
                    //         }

                    if ($user && $user->can("posts_delete")) {
                        $buttons .= '
                                    <button type="button" 
                                            class="btn btn-sm btn-danger delete-confirm" 
                                            data-url="' . route($this->route . '.destroy', $obj->id) . '" 
                                            title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>';
                    }

                    return $buttons;
                })
                ->editColumn("user", function ($obj) {
                    return $obj->user?->name ?? "";
                })
                ->editColumn("image", function ($obj) {
                    return $this->imageDataTable($obj->image);
                })
                ->editColumn("likes_count", function ($obj) {
                    $count = $obj->likes_count ?? 0;
                    return '<a href="javascript:void(0);" class="text-primary show-likes-btn" data-id="' . $obj->id . '" data-url="' . route('posts.likes', $obj->id) . '">' . $count . '</a>';
                })
                ->editColumn("created_at", function ($obj) {
                    return $obj->created_at->diffForHumans();
                })
                ->addIndexColumn()
                ->escapeColumns([])
                ->make(true);
        } else {
            return view($this->folder . '/index', [
                'createRoute' => route($this->route . '.create'),
                'bladeName' => "",
                'route' => $this->route,
            ]);
        }
    }

    public function create()
    {
        return view("{$this->folder}/partials/create", [
            'storeRoute' => route("{$this->route}.store"),
            "route" => $this->route,
        ]);
    }

    public function store($data)
    {
        if (isset($data['image'])) {
            $data['image'] = $this->handleFile($data['image'], 'Post');
        }

        try {
            $this->createData($data);
            return redirect()->route("{$this->route}.index")->with(['success' => trns('The operation was successful.')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => trns('An error occurred.') . ' ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($obj)
    {
        return view("{$this->folder}/partials/edit", [
            'obj' => $obj,
            "route" => $this->route,
            'updateRoute' => route("{$this->route}.update", (int)$obj->id),
        ]);
    }

    public function update($data, $id)
    {
        $oldObj = $this->getById($id);

        if (isset($data['image'])) {
            $data['image'] = $this->handleFile($data['image'], 'Post');

            if ($oldObj->image) {
                $this->deleteFile($oldObj->image);
            }
        }

        try {
            $oldObj->update($data);
            return redirect()->route("{$this->route}.index")->with(['success' => trns('The operation was successful.')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => trns('An error occurred.') . ' ' . $e->getMessage()])->withInput();
        }
    }
    public function getLikes($id)
    {
        $obj = $this->getById($id);
        $users = $obj->likes()->with('user')->get()->pluck('user');
        return view($this->folder . '.partials.likes', compact('users'))->render();
    }
}
