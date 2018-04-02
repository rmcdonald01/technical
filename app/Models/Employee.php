<?php

namespace App\Models;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function branch()
    {
    	return $this->belongsTo(Branch::class);
    }

    public function scopeIT(Builder $builder)
    {
    	return $builder->where('role_id', 1);
    }

    public function scopeLineStaff(Builder $builder)
    {
    	return $builder->where('role_id', 2);
    }

    public function scopeMontegoBayBranch(Builder $builder)
    {
    	return $builder->where('branch_id', 1);
    }

    public function scopeKingstonBranch(Builder $builder)
    {
    	return $builder->where('branch_id', 2);
    }
}
