<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Dto\CredentialsDto;
use App\Dto\ErrorDto;
use App\Exceptions\Unauthorized;
use App\Http\Requests\Auth\AuthRequest;
use App\Http\Controllers\Controller;
use App\Services\Specification\Auth\ILogin;
use App\Services\Specification\Auth\IRegister;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class AuthController extends Controller
{
    private ILogin $loginProcessor;

    /**
     * @param ILogin $loginProcessor
     */
    public function __construct(ILogin $loginProcessor)
    {
        $this->loginProcessor = $loginProcessor;
    }


    public function auth(AuthRequest $request): JsonResponse
    {
        $credentials = new CredentialsDto($request->get('email', ''), $request->get('password', ''));

        try {
            $token = $this->loginProcessor->auth($credentials);
        } catch (Unauthorized $e) {
            return new JsonResponse(new ErrorDto($e->getMessage(), Response::HTTP_UNAUTHORIZED, ''), Response::HTTP_UNAUTHORIZED);
        }

        return new JsonResponse($token);
    }
}
