<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTagAPIRequest;
use App\Http\Requests\API\UpdateTagAPIRequest;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\TagResource;

/**
 * Class TagController
 */

class TagAPIController extends AppBaseController
{
    /**
     * @OA\Get(
     *      path="/tags",
     *      summary="getTagList",
     *      tags={"Tag"},
     *      description="Get all Tags",
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
     *                  @OA\Items(ref="#/components/schemas/Tag")
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
        $query = Tag::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $tags = $query->get();

        return $this->sendResponse(
            TagResource::collection($tags),
            __('messages.retrieved', ['model' => __('models/tags.plural')])
        );
    }

    /**
     * @OA\Post(
     *      path="/tags",
     *      summary="createTag",
     *      tags={"Tag"},
     *      description="Create Tag",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Tag")
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
     *                  ref="#/components/schemas/Tag"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTagAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Tag $tag */
        $tag = Tag::create($input);

        return $this->sendResponse(
            new TagResource($tag),
            __('messages.saved', ['model' => __('models/tags.singular')])
        );
    }

    /**
     * @OA\Get(
     *      path="/tags/{id}",
     *      summary="getTagItem",
     *      tags={"Tag"},
     *      description="Get Tag",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Tag",
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
     *                  ref="#/components/schemas/Tag"
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
        /** @var Tag $tag */
        $tag = Tag::find($id);

        if (empty($tag)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/tags.singular')])
            );
        }

        return $this->sendResponse(
            new TagResource($tag),
            __('messages.retrieved', ['model' => __('models/tags.singular')])
        );
    }

    /**
     * @OA\Put(
     *      path="/tags/{id}",
     *      summary="updateTag",
     *      tags={"Tag"},
     *      description="Update Tag",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Tag",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Tag")
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
     *                  ref="#/components/schemas/Tag"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTagAPIRequest $request): JsonResponse
    {
        /** @var Tag $tag */
        $tag = Tag::find($id);

        if (empty($tag)) {
        return $this->sendError(
            __('messages.not_found', ['model' => __('models/tags.singular')])
        );
        }

        $tag->fill($request->all());
        $tag->save();

        return $this->sendResponse(
            new TagResource($tag),
            __('messages.updated', ['model' => __('models/tags.singular')])
        );
    }

    /**
     * @OA\Delete(
     *      path="/tags/{id}",
     *      summary="deleteTag",
     *      tags={"Tag"},
     *      description="Delete Tag",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Tag",
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
        /** @var Tag $tag */
        $tag = Tag::find($id);

        if (empty($tag)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/tags.singular')])
            );
        }

        $tag->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/tags.singular')])
        );
    }
}
