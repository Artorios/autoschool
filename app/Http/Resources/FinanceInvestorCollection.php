<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FinanceInvestorCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_map(function ($element) {
            return [
                'AutoSchoolId' => $element['AutoSchoolId'],
                'AutoSchoolTitle' => $element['AutoSchoolTitle'],
                'studentId' => $element['studentId'],
                'studentName' => $element['studentName'],
                'studentSecondName' => $element['studentSecondName'],
                'studentLastName' => $element['studentLastName'],
                'GroupName' => $element['GroupName'],
                'DatePayment' => $element['DatePayment'],
                'CouponID' => $element['CouponID'],
                'payment_option' => $element['payment_option'],
                'amount' => $element['amount'],
                'status' => $element['status'],
                'date' => [
                    'generation' => $element['generation_date'],
                    'activation' => $element['activated_at'],
                    'sale' => $element['sale_date'],
                ],
                'comment' => [
                    'investor' => $element['comment_investor'],
                    'director' => $element['comment_director'],
                    'coupon' => $element['comment_coupon'],
                ],
                'commission' => sumCommission($element['AutoSchoolId'], $element['CouponID'])
            ];

        }, $this->collection->toArray());
    }
}
