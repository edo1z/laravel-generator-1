<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAuthorAPIRequest;
use App\Http\Requests\API\UpdateAuthorAPIRequest;
use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\AuthorResource;

/**
 * Class AuthorController
 */

class AuthorAPIController extends AppBaseController
{
    /**
     * @OA\Get(
     *      path="/authors",
     *      summary="getAuthorList",
     *      tags={"Author"},
     *      description="Get all Authors",
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
     *                  @OA\Items(ref="#/components/schemas/Author")
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
        $query = Author::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $authors = $query->get();

        return $this->sendResponse(
            AuthorResource::collection($authors),
            __('messages.retrieved', ['model' => __('models/authors.plural')])
        );
    }

    /**
     * @OA\Post(
     *      path="/authors",
     *      summary="createAuthor",
     *      tags={"Author"},
     *      description="Create Author",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Author")
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
     *                  ref="#/components/schemas/Author"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAuthorAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Author $author */
        $author = Author::create($input);

        return $this->sendResponse(
            new AuthorResource($author),
            __('messages.saved', ['model' => __('models/authors.singular')])
        );
    }

    /**
     * @OA\Get(
     *      path="/authors/{id}",
     *      summary="getAuthorItem",
     *      tags={"Author"},
     *      description="Get Author",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Author",
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
     *                  ref="#/components/schemas/Author"
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
        /** @var Author $author */
        $author = Author::find($id);

        if (empty($author)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/authors.singular')])
            );
        }

        return $this->sendResponse(
            new AuthorResource($author),
            __('messages.retrieved', ['model' => __('models/authors.singular')])
        );
    }

    /**
     * @OA\Put(
     *      path="/authors/{id}",
     *      summary="updateAuthor",
     *      tags={"Author"},
     *      description="Update Author",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Author",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Author")
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
     *                  ref="#/components/schemas/Author"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAuthorAPIRequest $request): JsonResponse
    {
        /** @var Author $author */
        $author = Author::find($id);

        if (empty($author)) {
        return $this->sendError(
            __('messages.not_found', ['model' => __('models/authors.singular')])
        );
        }

        $author->fill($request->all());
        $author->save();

        return $this->sendResponse(
            new AuthorResource($author),
            __('messages.updated', ['model' => __('models/authors.singular')])
        );
    }

    /**
     * @OA\Delete(
     *      path="/authors/{id}",
     *      summary="deleteAuthor",
     *      tags={"Author"},
     *      description="Delete Author",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Author",
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
        /** @var Author $author */
        $author = Author::find($id);

        if (empty($author)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/authors.singular')])
            );
        }

        $author->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/authors.singular')])
        );
    }
}
