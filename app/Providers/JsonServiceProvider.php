<?php


namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class JsonServiceProvider
{
    /**
     * @param array $resource
     * @param int $code
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function success($resource=[], $code=Response::HTTP_OK,$additionalMeta = []){

        return $this->putAdditionalMeta($resource,'success',$additionalMeta)
            ->response()
            ->setStatusCode($code);
    }

    /**
     * @param array $resource
     * @param int $code
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function fail($resource=[], $code=422){
        return $this->putAdditionalMeta(["error" => $resource],'fail')
            ->response()
            ->setStatusCode($code);
    }

    /**
     * @param string $resource
     * @param int $code
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function unauthorized($resource = "", $code=401){
        empty($resource) ? $resource = "Unauthorized Login!" : '';
        return $this->putAdditionalMeta($resource,"Unauthorized Login!")
            ->response()
            ->setStatusCode($code);
    }

    /**
     * @param string $resource
     * @param int $code
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function permissionDenied($resource = "", $code=403){
        empty($resource) ? $resource = "Permission Denied!" : '';
        return $this->putAdditionalMeta($resource,"Permission Denied!")
            ->response()
            ->setStatusCode($code);
    }

    /**
     * @param $resource
     * @param $status
     * @return JsonResource
     */
    private function putAdditionalMeta($resource, $status,$additionalMeta = []){
        $meta = [
            "ip_address" => $_SERVER["REMOTE_ADDR"],
            "status" => $status,
            "execution_time" => number_format(microtime(true) - LARAVEL_START, 4)
        ];


        $merged = array_merge($resource->additional ?? [],$meta);
        $merged = array_merge($additionalMeta ?? [],$merged);

        if($resource instanceof JsonResource){
            return $resource->additional($merged);
        }

        if(is_array($resource)){
            return (new JsonResource(collect($resource)))->additional($merged);
        }

        if(is_string($resource)){
            return (new JsonResource(collect($resource)))->additional($merged);
        }

        throw new Exception('Invalid type of resource');
    }
}
