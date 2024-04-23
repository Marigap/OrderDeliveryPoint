<?php

namespace App\Http\ApiV1\Modules\OrderDeliveries\Controllers;

use App\Actions\AddNewDeliveryAction;
use App\Actions\DeleteDeliveryAction;
use App\Actions\GetAllDeliveriesAction;
use App\Actions\GetDeliveryAction;
use App\Actions\SendStatusUpdateNotificationAction;
use App\Actions\UpdateDeliveryStatusAction;
use App\Http\ApiV1\Modules\OrderDeliveries\Responses\DeliveryApiResponse;
use App\Http\Requests\PostDeliveryRequest;
use App\Http\Requests\UpdateDeliveryRequest;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class DeliveryInfosController
{
    public function index(): DeliveryApiResponse
    {
        try {
            $data = GetAllDeliveriesAction::run();
        } catch (Exception $ex) {
            return new DeliveryApiResponse(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                null,
                "Unexpected error"
            );
        }

        return new DeliveryApiResponse(Response::HTTP_OK, $data, "Successfully get all order deliveries");
    }

    public function post(PostDeliveryRequest $request): DeliveryApiResponse
    {
        $responseCode = Response::HTTP_CREATED;
        $postedDelivery = null;
        $msg = "Successfully add new order delivery";

        try {
            $data = $request->validated();
            $postedDelivery = AddNewDeliveryAction::run($data);
        } catch (ValidationException $ex) {
            $responseCode = Response::HTTP_BAD_REQUEST;
            $msg = "Bad request from client received";
        } catch (Exception $ex) {
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $msg = "Unexpected error";
        }

        return new DeliveryApiResponse($responseCode, $postedDelivery, $msg);
    }

    public function get(int $deliveryId): DeliveryApiResponse
    {
        $responseCode = Response::HTTP_OK;
        $foundDelivery = null;
        $msg = "Successfully get the order delivery";

        try {
            $foundDelivery = GetDeliveryAction::run($deliveryId);
        } catch (ModelNotFoundException $ex) {
            $responseCode = Response::HTTP_NOT_FOUND;
            $msg = "Order delivery with such id doesn't exist";
        } catch (Exception $ex) {
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $msg = "Unexpected error";
        }

        return new DeliveryApiResponse($responseCode, $foundDelivery, $msg);
    }

    public function update(int $deliveryId, UpdateDeliveryRequest $request): DeliveryApiResponse
    {
        $responseCode = Response::HTTP_OK;
        $updatedDelivery = null;
        $msg = "Successfully updated the order delivery";

        try {
            $data = $request->validated();
            $updatedDelivery = UpdateDeliveryStatusAction::run($data, $deliveryId);
            SendStatusUpdateNotificationAction::run($updatedDelivery);
        } catch (ValidationException $ex) {
            $responseCode = Response::HTTP_BAD_REQUEST;
            $msg = "Bad request from client received";
        } catch (ModelNotFoundException $ex) {
            $responseCode = Response::HTTP_NOT_FOUND;
            $msg = "Order delivery with such id doesn't exist";
        } catch (Exception $ex) {
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $msg = "Unexpected error";
        }

        return new DeliveryApiResponse($responseCode, $updatedDelivery, $msg);
    }

    public function delete(int $deliveryId): DeliveryApiResponse
    {
        $responseCode = Response::HTTP_OK;
        $deletedDelivery = null;
        $msg = "Successfully deleted the order delivery";

        try {
            $deletedDelivery = DeleteDeliveryAction::run($deliveryId);
        } catch (ModelNotFoundException $ex) {
            $responseCode = Response::HTTP_NOT_FOUND;
            $msg = "Order delivery with such id doesn't exist";
        } catch (Exception $ex) {
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $msg = "Unexpected error";
        }

        return new DeliveryApiResponse($responseCode, $deletedDelivery, $msg);
    }
}
