<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCommentAPIRequest;
use App\Http\Requests\API\UpdateCommentAPIRequest;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\CommentResource;

/**
 * Class CommentController
 */

class CommentAPIController extends AppBaseController
{
    /**
     * @OA\Get(
     *      path="/comments",
     *      summary="getCommentList",
     *      tags={"Comment"},
     *      description="Get all Comments",
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
     *                  @OA\Items(ref="#/components/schemas/Comment")
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
        $query = Comment::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $comments = $query->get();

        return $this->sendResponse(
            CommentResource::collection($comments),
            __('messages.retrieved', ['model' => __('models/comments.plural')])
        );
    }

    /**
     * @OA\Post(
     *      path="/comments",
     *      summary="createComment",
     *      tags={"Comment"},
     *      description="Create Comment",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Comment")
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
     *                  ref="#/components/schemas/Comment"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCommentAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Comment $comment */
        $comment = Comment::create($input);

        return $this->sendResponse(
            new CommentResource($comment),
            __('messages.saved', ['model' => __('models/comments.singular')])
        );
    }

    /**
     * @OA\Get(
     *      path="/comments/{id}",
     *      summary="getCommentItem",
     *      tags={"Comment"},
     *      description="Get Comment",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Comment",
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
     *                  ref="#/components/schemas/Comment"
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
        /** @var Comment $comment */
        $comment = Comment::find($id);

        if (empty($comment)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/comments.singular')])
            );
        }

        return $this->sendResponse(
            new CommentResource($comment),
            __('messages.retrieved', ['model' => __('models/comments.singular')])
        );
    }

    /**
     * @OA\Put(
     *      path="/comments/{id}",
     *      summary="updateComment",
     *      tags={"Comment"},
     *      description="Update Comment",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Comment",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Comment")
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
     *                  ref="#/components/schemas/Comment"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCommentAPIRequest $request): JsonResponse
    {
        /** @var Comment $comment */
        $comment = Comment::find($id);

        if (empty($comment)) {
        return $this->sendError(
            __('messages.not_found', ['model' => __('models/comments.singular')])
        );
        }

        $comment->fill($request->all());
        $comment->save();

        return $this->sendResponse(
            new CommentResource($comment),
            __('messages.updated', ['model' => __('models/comments.singular')])
        );
    }

    /**
     * @OA\Delete(
     *      path="/comments/{id}",
     *      summary="deleteComment",
     *      tags={"Comment"},
     *      description="Delete Comment",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Comment",
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
        /** @var Comment $comment */
        $comment = Comment::find($id);

        if (empty($comment)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/comments.singular')])
            );
        }

        $comment->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/comments.singular')])
        );
    }
}
