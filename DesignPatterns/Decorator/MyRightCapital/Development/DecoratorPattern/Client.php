<?php
/**
 * Created by PhpStorm.
 * User: tanjibo
 * Date: 16/12/6
 * Time: 下午2:52
 */
namespace MyRightCapital\Development\DecoratorPattern;

class Client
{
    /**
     * @var \MyRightCapital\Development\DecoratorPattern\Request
     */
    protected $request;

    /**
     * @var \MyRightCapital\Development\DecoratorPattern\IMiddleware
     */
    protected $response;

    public function __construct()
    {
        // Component
        $this->request = new Request(new Kernel());

        // Decorate the Component
        $this->response = $this->wrapDecorator($this->request);
    }

    /**
     * @param \MyRightCapital\Development\DecoratorPattern\IMiddleware $decorator
     *
     * @return \MyRightCapital\Development\DecoratorPattern\IMiddleware
     */
    public function wrapDecorator(IMiddleware $decorator)
    {
        $decorator = new VerifyCsrfToken($decorator);
        $decorator = new ShareErrorsFromSession($decorator);
        $decorator = new StartSession($decorator);
        $decorator = new AddQueuedCookiesToResponse($decorator);
        $response  = new CheckForMaintenanceMode($decorator);

        return $response;
    }

    /**
     * @return \MyRightCapital\Development\DecoratorPattern\IMiddleware
     */
    public function getResponse()
    {
        return $this->response->handle();
    }
}