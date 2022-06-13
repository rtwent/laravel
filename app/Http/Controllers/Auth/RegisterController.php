<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Dto\CredentialsDto;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Jobs\Email;
use App\Mail\UserRegistered;
use App\Services\Specification\Auth\IRegister;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

final class RegisterController extends Controller
{
    private IRegister $registrar;

    /**
     * @param IRegister $registrar
     */
    public function __construct(IRegister $registrar)
    {
        $this->registrar = $registrar;
    }


    /**
     * Регистрация пользователя
     * В случае успешной регистрации создается ассинхронный job
     * для отправки email
     * Для его прослушивания `php artisan queue:work`
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $credentials = new CredentialsDto($request->get('email', ''), $request->get('password', ''));

        $token = $this->registrar->register($credentials);

        Mail::to($credentials->getEmail())->queue(new UserRegistered());

        return new JsonResponse($token);
    }
}
