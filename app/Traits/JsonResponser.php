<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait JsonResponser
{
    public function success($data = null, $message = '', $code = 200, $isPaginated = false): JsonResponse
    {
        $pagination = null;
        $items = $data;

        if ($isPaginated) {
            list($items, $pagination) = $this->paginate($data);
        }

        return response()->json([
            'data'       => $items,
            'message'    => __($message),
            'status'     => true,
            'pagination' => $pagination
        ], $code);
    }

    public function error($message = '', $code = 400): JsonResponse
    {
        return response()->json([
            'message' => __($message),
            'status'  => false,
        ], $code);
    }

    private function paginate($data)
    {
        if (collect($data)->isEmpty()) {
            return [[], [
                'current_page'   => null,
                'total'          => 0,
                'number_pages'   => 0,
                'items_per_page' => 0
            ]];
        }

        $total   = $data->total();
        $perPage = $data->perPage();
        $pages   = ceil($total / $perPage);
        $perPage = $perPage > $total ? $total : $perPage;
        $items   = $data->items();

        $pagination = [
            'current_page'   => $data?->currentPage(),
            'total'          => $total,
            'number_pages'   => $pages,
            'items_per_page' => $perPage
        ];

        return [$items, $pagination];
    }
}
