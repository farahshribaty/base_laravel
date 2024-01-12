<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class CrudBaseRepository
{
    protected Model $model;
    protected array $relations = [];
    public array $filterable = [];
    

    public function __construct(Model $model)
    {
        $this->model = $model;
        
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function edit(int $id,  $data)
    {
        $object =$this->findByID($id); 
        $object->update($data);

        return $object;
    }

    public function delete(int $id)
    {
        return (bool) $this->findByID($id)->delete();
    }

    public function getAll($is_pagination  , int $perPage = 8, $search=null )
    {
        $query =$this->applyFilters($search)->with($this->relations); 

        if($is_pagination)$query = $query->paginate($perPage);
        else $query = $query->get();
        
        return  $query;
    }

    public function updateStatus(int $id, bool $newStatus , $status_column_name): bool
    {
        
        return (bool) $this->findByID($id)->fill([$status_column_name => $newStatus])->save();
    }

    public function findByID(int $id) 
    {   
        return $this->model->find($id);
    }

    protected function applyFilters(?string $filters)
    {
        $query = $this->model->newQuery();

            if (array_key_exists('search',$this->filterable)) {
                $this->applySearchCriteria($query, $filters);
            }

            if (array_key_exists('sort' , $this->filterable)) {
                $this->applySorting($query);
            }

            if (array_key_exists('custom' , $this->filterable)) {
                $this->applyCustom($query);
            }
        

        return $query;
    }

    protected function applySearchCriteria($query, ?string $search)
    {
        if ($search) {
            foreach($this->filterable['search'] as $key_name => $key_type){

                if($key_type == 'number'){

                    $query->where($key_name, $search);
                }elseif ($key_type == 'string'){
                    $query->where($key_name, 'LIKE', '%' . $search . '%');

                }
            }
            
        }
    }

    protected function applySorting($query)
    {
        foreach($this->filterable['sort'] as $key => $value){

           
                $query->orderBy($key, $value);
            
        }
    }
    protected function applyCustom($query)
    {

            if (is_callable($this->filterable['custom'])) {
            
                $this->filterable['custom']($query); 
            } 
        
    }
    public function getOneWithRelations($id){

        return $this->model->with($this->relations)->where('id', $id)->first();
    }
}
