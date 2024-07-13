<?php

namespace App\Kernel\Container;

use App\Kernel\Services\Config\Config;
use App\Kernel\Services\Config\ConfigInterface;
use App\Kernel\Services\Http\Request;
use App\Kernel\Services\Http\RequestInterface;
use App\Kernel\Services\Redirect\Redirect;
use App\Kernel\Services\Redirect\RedirectInterface;
use App\Kernel\Services\Router\Router;
use App\Kernel\Services\Router\RouterInterface;
use App\Kernel\Services\Session\Session;
use App\Kernel\Services\Session\SessionInterface;
use App\Kernel\Services\Validator\Validator;
use App\Kernel\Services\Validator\ValidatorInterface;
use App\Kernel\Services\View\View;
use App\Kernel\Services\View\ViewInterface;

class Container implements ContainerInterface
{
    private RouterInterface $router;
    private RequestInterface $request;
    private RedirectInterface $redirect;
    private SessionInterface $session;
    private ValidatorInterface $validator;
    private ViewInterface $view;
    private ConfigInterface $config;

    public function __construct()
    {
        $this->request = Request::createFromGlobals();
        $this->redirect = new Redirect();
        $this->session = new Session();
        $this->validator = new Validator();
        $this->view = new View();

        $this->router = new Router(
            $this->view,
            $this->request,
            $this->validator,
            $this->redirect,
            $this->session,
            $this->config,
        );
    }

    public function getRouter(): RouterInterface
    {
        return $this->router;
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getRedirect(): RedirectInterface
    {
        return $this->redirect;
    }

    public function getSession(): SessionInterface
    {
        return $this->session;
    }

    public function getValidator(): ValidatorInterface
    {
        return $this->validator;
    }

    public function getView(): ViewInterface
    {
        return $this->view;
    }
    public function getConfig(): ConfigInterface
    {
        return $this->config;
    }
}

