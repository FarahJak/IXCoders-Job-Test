<?php

namespace App\Services;

use App\Models\Task;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TaskService
{
    use FileTrait;

    protected Task $model;

    public function __construct(Task $model)
    {
        $this->model = $model;
    }
    public function indexHandler()
    {
        $results = $this->model::query()->with(['user'])
            ->when(request('title '), function ($query, $title) {
                return $query->where('title ', 'like', "%" . $title  . "%");
            })
            ->when(request('status'), function ($query, $status) {
                return $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(request('per_page') ?? 10);
        return $results;
    }

    public function showHandler($id)
    {
        $result = $this->model::with('taskImages')->find($id);

        if (!$result)
            throw new NotFoundHttpException();

        return $result;
    }

    public function storeHandler(array $data)
    {
        DB::beginTransaction();
        try {
            $result = $this->model::create(array_merge($data, ['user_id' => auth('users')->user()->id]));

            $this->storeImages($result, $data);

            DB::commit();
            return true;
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            return false;
        }
    }

    public function updateHandler($data, $id)
    {
        DB::beginTransaction();
        try {
            $result = $this->model::find($id);

            $result->update($data);

            if (array_key_exists('images_ids', $data)) {
                $this->deleteImages($result, $data);
            }
            if (array_key_exists('images', $data)) {
                $this->storeImages($result, $data);
            }

            DB::commit();
            return true;
        } catch (Exception) {

            DB::rollBack();
            return false;
        }
    }

    public function destroyHandler($id)
    {
        $result = $this->model::find($id);

        if (!$result)
            throw new NotFoundHttpException();

        return $result->delete();
    }

    /**_______________________________________________ */
    public function storeImages($task, $data): void
    {
        $mediaData = [];
        if (isset($data['images'])) {
            foreach ($data['images'] as $media) {
                $mediaData[] = [
                    'file_name' => $this->uploadImage($media, 'images/tasks'),
                    'type'      => $media->extension()
                ];
            }
        }
        $task->taskImages()->createMany($mediaData);
    }

    public function deleteImages($task, $data): void
    {
        if (isset($data['images_ids'])) {

            $oldImages = $task->taskImages()->whereIn('id', $data['images_ids'])->get();

            if ($oldImages->isEmpty())
                throw new NotFoundHttpException();

            foreach ($oldImages as $oldImage) {
                // dd($oldImage->file_name);
                $this->deleteImage($oldImage->file_name);
                $oldImage->delete();
            }

            $task->taskImages()->whereIn('id', $data['images_ids'])->delete();
        }
    }
}
