<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $table = 'portfolios';
    protected $fillable = [
        'title',
        'description',
        'url',
        'image',
        'category',
        'sort_order',
        'partner_id'
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
    public function collaborators()
    {
        return $this->belongsToMany(Collaborator::class, 'collaborator_project', 'project_id', 'collaborator_id');
    }
}
