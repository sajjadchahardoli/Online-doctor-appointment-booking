<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    //برای هدایت به لا گین مربوطه (پزشک یا کاربر عادی) وقتی بدون لاگین می خواهد وارد بخشی شود
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()){
            return response()->json(['error'=>'unauthorized'],401);
        }

        $guard = data_get($exception->guards(),0);
        switch ($guard){
            case 'doctor':
                $login = 'doctor.login';
                break;

            case 'secretary':
                $login = 'secretary.login';
                break;

            default:
                $login = 'login';
                break;

        }
        return redirect()->guest(route($login));

    }


}
