<?php

namespace App\Traits;

/**
 * This Traits For General Button Action
 */
trait ActionButtonTrait
{
    /**
     * @return string
     */
    public function getViewButtonAttribute()
    {
        if(isset($this->routeView)){
            return '<a href="'.route($this->routeView['name'], [$this->routeView['paramName'] => $this]).'" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Lihat"><i class="fa fa-eye"></i></a> &nbsp;';
        }
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if(isset($this->routeEdit)){
            return '<a href="'.route($this->routeEdit['name'], [$this->routeEdit['paramName'] => $this]).'" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a> &nbsp;';
        }
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<button onclick="deleteData('."'".$this->id."'".')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button> &nbsp;';
    }

}

