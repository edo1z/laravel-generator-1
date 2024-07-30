<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCategoryAPIRequest;
use App\Http\Requests\API\UpdateCategoryAPIRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\CategoryResource;

/**
 * Class CategoryController
 */

class CategoryAPIController extends AppBaseController
{
    /**
     * @OA\Get(
     *      path="/categories",
     *      summary="getCategoryList",
     *      tags={"Category"},
     *      description="Get all Categories",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/Category")
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $query = Category::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $categories = $query->get();

        return $this->sendResponse(
            CategoryResource::collection($categories),
            __('messages.retrieved', ['model' => __('models/categories.plural')])
        );
    }

    /**
     * @OA\Post(
     *      path="/categories",
     *      summary="createCategory",
     *      tags={"Category"},
     *      description="Create Category",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Category")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Category"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Category $category */
        $category = Category::create($input);

        return $this->sendResponse(
            new CategoryResource($category),
            __('messages.saved', ['model' => __('models/categories.singular')])
        );
    }

    /**
     * @OA\Get(
     *      path="/categories/{id}",
     *      summary="getCategoryItem",
     *      tags={"Category"},
     *      description="Get Category",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Category",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Category"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id): JsonResponse
    {
        /** @var Category $category */
        $category = Category::find($id);

        if (empty($category)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/categories.singular')])
            );
        }

        return $this->sendResponse(
            new CategoryResource($category),
            __('messages.retrieved', ['model' => __('models/categories.singular')])
        );
    }

    /**
     * @OA\Put(
     *      path="/categories/{id}",
     *      summary="updateCategory",
     *      tags={"Category"},
     *      description="Update Category",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Category",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Category")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Category"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCategoryAPIRequest $request): JsonResponse
    {
        /** @var Category $category */
        $category = Category::find($id);

        if (empty($category)) {
        return $this->sendError(
            __('messages.not_found', ['model' => __('models/categories.singular')])
        );
        }

        $category->fill($request->all());
        $category->save();

        return $this->sendResponse(
            new CategoryResource($category),
            __('messages.updated', ['model' => __('models/categories.singular')])
        );
    }

    /**
     * @OA\Delete(
     *      path="/categories/{id}",
     *      summary="deleteCategory",
     *      tags={"Category"},
     *      description="Delete Category",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Category",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id): JsonResponse
    {
        /** @var Category $category */
        $category = Category::find($id);

        if (empty($category)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/categories.singular')])
            );
        }

        $category->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/categories.singular')])
        );
    }
}
