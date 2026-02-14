<?php

namespace App\Services\Admin;

use App\Models\Portfolio as ObjModel;
use App\Services\BaseService;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

use App\Models\Collaborator;
use App\Models\Partner;
use Illuminate\Support\Str;

class ProjectService extends BaseService
{
    protected string $folder = 'content/project';
    protected string $route = 'Backprojects';

    public function __construct(ObjModel $objModel)
    {
        parent::__construct($objModel);
    }

    public function index($request)
    {
        if ($request->ajax()) {
            $obj = $this->getDataTable();
            return DataTables::of($obj)
            ->editColumn('image', function ($obj) {
                return $this->imageDataTable($obj->image);
            })
            ->editColumn('partner_id', function ($obj) {
                return $obj->partner?->name ?? "";
            })
            ->editColumn('description', function ($obj) {
                return Str::limit(strip_tags($obj->description), 50);
            })
            ->editColumn('url', function ($obj) {
                return '<a href="' . $obj->url . '" target="_blank" class="btn btn-sm btn-primary">' . trns("Visit") . '</a>';
            })
                ->addColumn('action', function ($obj) {
                    $user = Auth::guard('admin')->user();
                    $buttons = '';

                    if ($user && $user->can("projects_edit")) {
                        $buttons .= '
                                    <a href="' . route($this->route . '.edit', $obj->id) . '" 
                                    class="btn btn-sm btn-primary me-1" 
                                    title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>';
                    }

                    if ($user && $user->can("projects_delete")) {
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
                ->addIndexColumn()
                ->escapeColumns([])
                ->make(true);
        } else {
            return view($this->folder . '/index', [
                'createRoute' => route($this->route . '.create'),
                'bladeName' => trns("Projects"),
                'route' => $this->route,
            ]);
        }
    }

    public function create()
    {
        $collaborations = Collaborator::all();
        $partners = Partner::all();
        return view("{$this->folder}/partials/create", [
            'storeRoute' => route("{$this->route}.store"),
            "route" => $this->route,
            'collaborations' => $collaborations,
            'partners' => $partners,
        ]);
    }

    public function store($data)
    {
        if (isset($data['image'])) {
            $data['image'] = $this->handleFile($data['image'], 'Project');
        }

        try {
            $project = $this->createData($data);
            if (isset($data['collaborator_ids'])) {
                $project->collaborators()->sync($data['collaborator_ids']);
            }
            return redirect()->route("{$this->route}.index")->with(['success' => trns('The operation was successful.')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => trns('An error occurred.') . ' ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($obj)
    {
        $collaborations = Collaborator::all();
        $partners = Partner::all();
        return view("{$this->folder}/partials/edit", [
            'obj' => $obj,
            "route" => $this->route,
            'updateRoute' => route("{$this->route}.update", (int)$obj->id),
            'collaborations' => $collaborations,
            'partners' => $partners,
        ]);
    }

    public function show($obj)
    {
        return view("{$this->folder}/partials/show", [
            'obj' => $obj,
            "route" => $this->route,
            'updateRoute' => route("{$this->route}.update", (int)$obj->id),
        ]);
    }


    public function update($data, $id)
    {
        $oldObj = $this->getById($id);

        if (isset($data['image'])) {
            $data['image'] = $this->handleFile($data['image'], 'Project');

            if ($oldObj->image) {
                $this->deleteFile($oldObj->image);
            }
        }

        try {
            $oldObj->update($data);
            if (isset($data['collaborator_ids'])) {
                $oldObj->collaborators()->sync($data['collaborator_ids']);
            }
            return redirect()->route("{$this->route}.index")->with(['success' => trns('The operation was successful.')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => trns('An error occurred.') . ' ' . $e->getMessage()])->withInput();
        }
    }
}
