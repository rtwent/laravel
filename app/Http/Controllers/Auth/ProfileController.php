<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Enums\LanguagesIso;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ProfileRequest;
use App\Http\Resources\UserResource;
use App\Rules\Timezones;

final class ProfileController extends Controller
{

    /**
     * Здесь я отошел от стиля написания, который был в других контроллерах
     * Данный стиль более типичный (ИМХО) для ларавель
     * Он легкий, но как по мне имеет ряд недостатков:
     *  - вся логика перемещена в контроллер. Вынести ее отдельно можно, но все равно идет зависимость от реквеста
     *  - жесткая привязка к реквесту
     *  - жесткая привязка к AR
     *  - тяжелое написание юнит тестов
     *  - при генерации OpenApi docs нам придется писать ее с нуля, т.к. все входящие и выходящие данные контроллера оформлены не объектами, а массивами
     *  - OpenApi docs будет параллельным куском работы, не зависящим от кода
     *
     * Я его показал, если у Вас возникли сомнения в том, что в других контроллерах я усложнил легкие задачи.
     *
     * @param ProfileRequest $request
     * @return UserResource
     */
    public function change(ProfileRequest $request): UserResource
    {
        $profile = $request->user()->profile;
        $profile->lang = $request->get('language', LanguagesIso::DEFAULT_LANG);
        $profile->timezone = $request->get('timezone', Timezones::DEFAULT_TIMEZONE);
        $profile->save();

        return new UserResource($request->user());
    }
}
