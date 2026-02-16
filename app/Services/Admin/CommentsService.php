<?php

namespace App\Services\Admin;

use App\Models\Comment as ObjModel;
use App\Services\BaseService;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CommentsService extends BaseService
{
    protected string $folder = 'content/comments';
    protected string $route = 'comments';

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



                    if ($user && $user->can("comments_delete")) {
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
                ->editColumn("comment_creator", function ($obj) {
                    return $obj->user?->name ?? "-";
                })
                ->editColumn("post_creator", function ($obj) {
                    return $obj->post?->user?->name ?? "-";
                })
                ->editColumn("post_image", function ($obj) {
                    return $this->imageDataTable($obj->post->image);
                })
                ->editColumn("comment_content", function ($obj) {
                    $fullContent = htmlspecialchars($obj->content ?? "", ENT_QUOTES, 'UTF-8');
                    return '<a href="javascript:void(0);" class="text-body view-comment-content" data-content="' . $fullContent . '">' . (Str::limit($obj->content, 50) ?? "-") . '</a>';
                })
                ->editColumn("comment_reply", function ($obj) {
                    $fullContent = htmlspecialchars($obj->reply?->text ?? "", ENT_QUOTES, 'UTF-8');
                    return '<a href="javascript:void(0);" class="text-body view-comment-reply" data-content="' . $fullContent . '">' . (Str::limit($obj->reply?->text, 50) ?? "-") . '</a>';
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
            $data['image'] = $this->handleFile($data['image'], 'Comments');
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
            $data['image'] = $this->handleFile($data['image'], 'Comments');

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
}
