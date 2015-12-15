<?php 

namespace App\GenericRepositories\src\Eloquent;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository {

    /**
     * The model to execute queries on.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Create a new repository instance.
     *
     * @param \Illuminate\Database\Eloquent\Model $model The model to execute queries on
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get a new instance of the model.
     *
     * @param  array  $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getNew(array $attributes = array())
    {
        return $this->model->newInstance($attributes);
    }

    /**
     * Get all assets to be rendered in the datatable
     *
     * @param  
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * find user by id
     * @param  integer $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Create a new data in model
     *
     * @param  array $data
     *
     * @return  \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        $model = $this->getNew();

        try {
            foreach($data as $key => $value)
            {
                $model->$key = ($value != '') ? $value : null;
            }
            $model->save();

            return $model;
        } catch (Exception $e) {

            return $e->getMessage();
        }
    }

    /**
     * Updates a model
     *
     * @param  array  $data
     *
     * @return  \Illuminate\Database\Eloquent\Model
     */
    public function update(array $data, $id)
    {
        $model = $this->findById($id);

        try {
            foreach($data as $key => $value)
            {
                $model->$key = ($value != '') ? $value : null;
            }
            $model->save();

            return $model;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}