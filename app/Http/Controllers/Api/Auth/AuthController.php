<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Transformers\UserTransformer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @module 认证
 * Class AuthController
 * @package App\Http\Controllers\Api\Auth
 */
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     * 要求附带email和password（数据来源users表）
     *
     * @param User $model
     * @param UserTransformer $transformer
     */

    public function __construct(User $model, UserTransformer $transformer)
    {
        parent::__construct($model, $transformer);
        $this->middleware('api.auth', [ 'except' => [ 'login' ] ]);
    }

    /**
     * Get a JWT via given credentials.
     * @permission 登录
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request([ 'email', 'password' ]);

        if ( !$token = auth('api')->attempt($credentials)) {
            return response()->json([ 'error' => 'Unauthorized' ], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     * @permission 用户信息
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     * @permission 登出
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json([ 'message' => 'Successfully logged out' ]);
    }

    /**
     * @permission 刷新token
     * Refresh a token.
     * 刷新token，如果开启黑名单，以前的token便会失效。
     * 值得注意的是用上面的getToken再获取一次Token并不算做刷新，两次获得的Token是并行的，即两个都可用。
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60,
        ]);
    }
}
