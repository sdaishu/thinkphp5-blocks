<?php

namespace app\api\controller;

/**
 * Class Complete 测试
 * @package app\user\controller
 */
class Cms extends BaseApi
{
    protected $cms;
    protected $cmsValidate;
    protected $request;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);

    }

    /**
     * @SWG\Get(
     *     path="/api/cms/pets",
     *     summary="List all pets",
     *     operationId="listPets",
     *     tags={"pets"},
     *     @SWG\Parameter(
     *         name="limit",
     *         in="query",
     *         description="How many items to return at one time (max 100)",
     *         required=false,
     *         type="integer",
     *         format="int32"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="An paged array of pets",
     *         @SWG\Schema(ref="#/definitions/Pets"),
     *         @SWG\Header(header="x-next", type="string", description="A link to the next page of responses")
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="unexpected error",
     *         @SWG\Schema(
     *             ref="#/definitions/Error"
     *         )
     *     )
     * )
     */
    public function pets()
    {

    }

}
