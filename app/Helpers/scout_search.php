<?php

use Laravel\Scout\Searchable;

if (! function_exists('search')) {
    function search(string $model,string $column ,string $search, bool $paginate = false)
    {
        $model = "App\Models\\" . ucfirst($model) ;
        abort_if(
            ! class_exists($model),
            404,
            "Model $model not exists." ,
        );

        throw_if(
            ! in_array(
                Searchable::class,
                class_uses_recursive($model)
            )
        );


        //something wrong ( doesnt search for a specific value )
        $query = $model::search($search)->within($column);


        return $paginate
            ? $query->paginate()
            : $query->get();
    }
}
