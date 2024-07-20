<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;

trait HasSearch
{
    protected string|Model $model;
    protected array $searchable;
    protected string|JsonResource $resource_callback = '';
    protected array $makeHidden;

    public function search(Request $request): array|Collection|AnonymousResourceCollection|JsonResponse
    {
        $validated = Validator::make($request->all(), [
            'search' => ['required', 'string', 'max:255'],
        ]);

        if ($validated->fails()) {
            return response()->json($validated->messages(), 422);
        }

        $query = $request->get('query');

        $result = $this->makeSearch($query);

        $result->makeHidden($this->makeHidden);

        return $this->resource($result);
    }

    private function makeSearch(string $search_text): Collection|array
    {
        $query = $this->model::query();

        foreach ($this->searchable as $searchable) {
            $query->orWhere(
                $searchable, 'like', "%$search_text%");
        }

        return $query->get();
    }

    private function resource(Collection|array $data): Collection|AnonymousResourceCollection|array
    {
        if ($this->resource_callback) {
            return $this->resource_callback::collection($data);
        }

        return $data;
    }
}
